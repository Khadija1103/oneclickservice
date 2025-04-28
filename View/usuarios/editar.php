<?php
// View/usuarios/editar.php

require_once __DIR__ . '/../../Controllers/UsuariosControllers.php';
$ctrl = new UsuariosControllers();

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if (!$id) { echo "ID inválido."; exit; }

$ctrl->editarUsuario($id);
$data = $ctrl->datosParaEditar($id);
if (!$data) { echo "Usuario no encontrado."; exit; }
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Usuario</title>
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
    input[type="email"] {
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
      background-color: #28a745;
      border: none;
      color: white;
      font-size: 16px;
      border-radius: 4px;
      cursor: pointer;
    }
    button:hover {
      background-color: #218838;
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
  <h1>Editar Usuario #<?= $id ?></h1>
  <form method="POST" action="">
    <label>Nombre:</label>
    <input type="text" name="nombre" value="<?= htmlspecialchars($data['nombre']) ?>" required>

    <label>Correo:</label>
    <input type="email" name="correo" value="<?= htmlspecialchars($data['correo']) ?>" required>

    <button type="submit">Actualizar</button>
  </form>
  <a href="index.php">← Volver a Usuarios</a>
</body>
</html>
