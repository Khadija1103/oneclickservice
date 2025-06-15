<?php
session_start();
session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Sesión cerrada</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f4f4;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    .mensaje {
      background: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      text-align: center;
    }
    .mensaje h1 {
      color: #28a745;
    }
    .mensaje a {
      display: inline-block;
      margin-top: 15px;
      padding: 10px 20px;
      background-color: #007bff;
      color: white;
      text-decoration: none;
      border-radius: 5px;
    }
    .mensaje a:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>
  <div class="mensaje">
    <h1>✅ Sesión cerrada exitosamente</h1>
    <a href="login.php">Volver a iniciar sesión</a>
  </div>
</body>
</html>
