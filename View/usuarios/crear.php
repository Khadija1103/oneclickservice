<?php
// View/usuarios/crear.php

require_once __DIR__ . '/../../Controllers/UsuariosControllers.php';
$ctrl = new UsuariosControllers();
$ctrl->crearUsuario();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Crear Usuario</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f8f9fa;
      margin: 0;
      padding: 20px;
    }
    h1 {
      color: #333;
      text-align: center;
      margin-bottom: 20px;
    }
    form {
      max-width: 400px;
      margin: 0 auto;
      padding: 20px;
      background-color: #fff;
      border: 1px solid #ddd;
      border-radius: 8px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    label {
      display: block;
      margin-top: 10px;
      font-weight: bold;
    }
    input[type="text"],
    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 8px;
      margin-top: 5px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    button {
      width: 100%;
      padding: 10px;
      background-color: #007bff;
      border: none;
      color: white;
      font-size: 16px;
      border-radius: 4px;
      cursor: pointer;
    }
    button:hover {
      background-color: #0056b3;
    }
    a {
      display: block;
      text-align: center;
      margin-top: 20px;
      color: #007bff;
      text-decoration: none;
    }
    a:hover {
      text-decoration: underline;
    }
  </style>
</head> 
<body>
<<<<<<< HEAD
  <h1>Crear Usuario</h1>
  <form method="POST" action="">
    <label>Nombre:</label>
    <input type="text" name="nombre" required>
=======
<h1>Crear Usuario</h1>
  <form method="POST" action="" onsubmit="return validarFormulario()">
    <label>Nombre:</label>
    <input type="text" name="nombre" required pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]{3,}" title="Mínimo 3 letras. Solo se permiten letras y espacios.">
>>>>>>> main

    <label>Correo:</label>
    <input type="email" name="correo" required>

    <label>Contraseña:</label>
<<<<<<< HEAD
    <input type="password" name="contrasena" required>
=======
    <input type="password" name="contrasena" required pattern="(?=.*[A-Za-z])(?=.*\d).{6,}" title="Mínimo 6 caracteres. Debe contener al menos una letra y un número.">

>>>>>>> main

    <button type="submit">Guardar</button>
  </form>
  <a href="index.php">← Volver a Usuarios</a>
</body>
<<<<<<< HEAD
</html>

=======
</html>
>>>>>>> main
