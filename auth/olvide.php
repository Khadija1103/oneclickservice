<?php
require_once '../conexion.php';
require_once '../correo/enviar.php';

$mensaje = "";
$tipoMensaje = ""; // 'exito' o 'error'

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $correo = trim($_POST["correo"]);

    $stmt = $conn->prepare("SELECT id, nombre FROM usuarios WHERE correo = ?");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();
        $token = bin2hex(random_bytes(16));

        $stmtUpdate = $conn->prepare("UPDATE usuarios SET token_password = ? WHERE correo = ?");
        $stmtUpdate->bind_param("ss", $token, $correo);
        $stmtUpdate->execute();

        if (enviarCorreoRecuperacion($correo, $usuario["nombre"], $token)) {
            $mensaje = "✅ Revisa tu correo para restablecer tu contraseña.";
            $tipoMensaje = "exito";
        } else {
            $mensaje = "❌ Error al enviar el correo. Verifica el archivo <code>correo/enviar.php</code>.";
            $tipoMensaje = "error";
        }
    } else {
        $mensaje = "❌ El correo no está registrado.";
        $tipoMensaje = "error";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Recuperar contraseña</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f0f2f5;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    .form-container {
      background: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      width: 90%;
      max-width: 400px;
    }
    h2 {
      text-align: center;
      color: #333;
    }
    input[type="email"],
    input[type="submit"] {
      width: 100%;
      padding: 10px;
      margin-top: 15px;
      border-radius: 5px;
      border: 1px solid #ccc;
    }
    input[type="submit"] {
      background-color: #007bff;
      color: white;
      cursor: pointer;
    }
    input[type="submit"]:hover {
      background-color: #0056b3;
    }
    .mensaje {
      margin-top: 15px;
      text-align: center;
      font-weight: bold;
      padding: 10px;
      border-radius: 5px;
    }
    .mensaje.exito {
      color: #155724;
      background-color: #d4edda;
      border: 1px solid #c3e6cb;
    }
    .mensaje.error {
      color: #721c24;
      background-color: #f8d7da;
      border: 1px solid #f5c6cb;
    }
    .link-volver {
      text-align: center;
      margin-top: 15px;
    }
    .link-volver a {
      color: #007bff;
      text-decoration: none;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>¿Olvidaste tu contraseña?</h2>
    <form method="POST" action="">
      <label>Correo electrónico:</label>
      <input type="email" name="correo" required>
      <input type="submit" value="Enviar enlace">
    </form>

    <?php if (!empty($mensaje)): ?>
      <div class="mensaje <?= $tipoMensaje ?>"><?= $mensaje ?></div>
    <?php endif; ?>

    <div class="link-volver">
      <a href="login.php">← Volver al inicio de sesión</a>
    </div>
  </div>
</body>
</html>
