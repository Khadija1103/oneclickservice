<?php
// View/crear.php

require_once __DIR__ . '/../Controllers/ProveedoresControllers.php';

$controller = new ProveedoresControllers();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->crearProveedor();
    header("Location: ../index.php");  // Redirige a la lista
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Crear Proveedor</title>
  <style>
    body { font-family: Arial; background:#f4f4f4; display:flex; justify-content:center; align-items:center; height:100vh; margin:0; }
    .form-container { background:#fff; padding:30px; border-radius:8px; box-shadow:0 0 10px rgba(0,0,0,0.1); width:90%; max-width:500px; }
    h1 { text-align:center; color:#28a745; }
    label { display:block; margin-top:15px; font-weight:bold; }
    input { width:100%; padding:10px; margin-top:5px; border:1px solid #ccc; border-radius:5px; }
    input[type="submit"] { background:#28a745; color:#fff; border:none; padding:12px; margin-top:20px; border-radius:5px; cursor:pointer; width:100%; }
    input[type="submit"]:hover { background:#218838; }
    .back-link { text-align:center; margin-top:15px; }
    .back-link a { color:#007bff; text-decoration:none; }
    .back-link a:hover { text-decoration:underline; }
  </style>
</head>
<body>
  <div class="form-container">
    <h1>Crear Proveedor</h1>
    <form method="POST" action="">
      <label>Nombre:</label>
      <input type="text" name="nombre" required pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]{3,}" title="Mínimo 3 letras. Solo letras y espacios.">

      <label>Correo:</label>
      <input type="email" name="correo" required>

      <label>Teléfono:</label>
      <input type="text" name="telefono" required pattern="[0-9]{7,15}" title="Solo números. Mínimo 7 y máximo 15 dígitos.">

      <label>Dirección:</label>
      <input type="text" name="direccion" required pattern="^[A-Za-z0-9ÁÉÍÓÚáéíóúÑñ\s\.,#\-]{5,100}$" title="Dirección válida: letras, números, espacios, comas, puntos, guiones y #. Mínimo 5 caracteres.">

      <label>Tipo de Servicio:</label>
      <input type="text" name="tipo_servicio" required pattern=".{4,}" title="Mínimo 4 caracteres.">

      <input type="submit" value="Guardar">
    </form>
    <div class="back-link">
      <a href="../index.php">← Volver a la lista</a>
    </div>
  </div>
</body>
</html>
