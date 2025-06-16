<?php
require_once '../conexion.php';
session_start();

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = trim($_POST["correo"]);
    $contrasena = $_POST["contrasena"];

    $stmt = $conn->prepare("SELECT id, nombre, rol, contraseña FROM usuarios WHERE correo = ?");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($id, $nombre, $rol, $hash);
        $stmt->fetch();

        if (password_verify($contrasena, $hash)) {
            $_SESSION["usuario_id"] = $id;
            $_SESSION["nombre"] = $nombre;
            $_SESSION["rol"] = $rol;

            // Redirigir según el rol
            switch ($rol) {
                case 'admin':
                    header("Location: ../dashboard/admin.php");
                    break;
                case 'proveedor':
                    header("Location: ../dashboard/proveedor.php");
                    break;
                case 'cliente':
                    header("Location: ../dashboard/usuario.php");
                    break;
                default:
                    header("Location: ../index.php"); // Rol desconocido
                    break;
            }
            exit;
        } else {
            $error = "Contraseña incorrecta.";
        }
    } else {
        $error = "Correo no registrado.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Iniciar sesión - One Click Service</title>

  <!-- Enlace al archivo de estilos -->
  <link rel="stylesheet" href="../assets/styles.css">

  <!-- Estilos internos de respaldo -->
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
    h1 {
      color: #333;
      margin-bottom: 20px;
      text-align: center;
    }
    label {
      display: block;
      margin: 10px 0 5px;
    }
    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border-radius: 5px;
      border: 1px solid #ccc;
    }
    input[type="submit"] {
      width: 100%;
      padding: 12px;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    input[type="submit"]:hover {
      background-color: #0056b3;
    }
    .error {
      color: red;
      margin-top: 10px;
      font-size: 0.9em;
      text-align: center;
    }
    .back-link {
      text-align: center;
      margin-top: 15px;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h1>Iniciar sesión</h1>

    <?php if (!empty($error)): ?>
      <p class="error"><?= $error ?></p>
    <?php endif; ?>

    <form method="POST" action="" autocomplete="off">
      <label for="correo">Correo:</label>
      <input type="email" name="correo" id="correo" required autocomplete="username">

      <label for="contrasena">Contraseña:</label>
      <input type="password" name="contrasena" id="contrasena" required autocomplete="new-password">

      <input type="submit" value="Ingresar">
    </form>

    <div class="back-link">
      <a href="register.php">¿No tienes cuenta? Regístrate</a><br>
      <a href="http://localhost/oneclickservice-master/main.php">← Volver al inicio</a>
    </div>
  </div>
</body>
</html>
