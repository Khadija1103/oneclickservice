<?php
require_once '../conexion.php';

$mensaje = "";
$token = $_GET['token'] ?? '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $token = $_POST["token"] ?? '';
    $nueva = password_hash($_POST["contrasena"], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("UPDATE usuarios SET contraseña = ?, token_password = NULL WHERE token_password = ?");
    $stmt->bind_param("ss", $nueva, $token);
    $stmt->execute();

    if ($stmt->affected_rows === 1) {
        $mensaje = "✅ Contraseña actualizada. Ya puedes iniciar sesión.";
    } else {
        $mensaje = "❌ El token no es válido o ya expiró.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Restablecer contraseña</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f0f2f5;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    .form-container {
      background-color: #fff;
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
    input[type="password"],
    input[type="submit"] {
      width: 100%;
      padding: 10px;
      margin-top: 15px;
      border-radius: 5px;
      border: 1px solid #ccc;
    }
    input[type="submit"] {
      background-color: #28a745;
      color: white;
      cursor: pointer;
    }
    input[type="submit"]:hover {
      background-color: #218838;
    }
    .mensaje {
      margin-top: 15px;
      text-align: center;
      font-weight: bold;
      color: #333;
    }
    .volver {
      text-align: center;
      margin-top: 15px;
    }
    .volver a {
      text-decoration: none;
      color: #007bff;
    }
    .volver a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>Crear nueva contraseña</h2>

    <form method="POST" action="">
      <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

      <label>Nueva contraseña:</label>
      <input type="password" name="contrasena" required pattern=".{6,}" title="Debe tener al menos 6 caracteres">

      <input type="submit" value="Actualizar">
    </form>

    <?php if (!empty($mensaje)): ?>
      <div class="mensaje"><?= htmlspecialchars($mensaje) ?></div>
    <?php endif; ?>

    <div class="volver">
      <a href="login.php">← Volver al inicio de sesión</a>
    </div>
  </div>
</body>
</html>
