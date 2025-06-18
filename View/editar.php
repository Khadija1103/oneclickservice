<?php
// View/editar.php

require_once __DIR__ . '/../Controllers/ProveedoresControllers.php';
$ctrl = new ProveedoresControllers();

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if (!$id) { echo "ID inválido."; exit; }

// Procesa el POST de actualización
$ctrl->editarProveedor($id);

// Carga datos actuales
$datos = $ctrl->datosParaEditar($id);
if (!$datos) { echo "Proveedor no encontrado."; exit; }
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Proveedor</title>
  <style>
    body {
      font-family: Arial;
      background: #f4f4f4;
      padding: 20px;
      margin: 0;
      display: flex;
      justify-content: center;
    }
    .form-container {
      background: #fff;
      padding: 30px;
      border-radius: 8px;
      max-width: 800px;
      width: 90%;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      margin-top: 40px;
    }
    h1 {
      text-align: center;
      color: #28a745;
      margin-top: 0;
    }
    label {
      display: block;
      margin-top: 15px;
      font-weight: bold;
    }
    input {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    .actions {
      margin-top: 20px;
      text-align: center;
    }
    button,
    .cancel {
      margin: 0 10px;
      padding: 10px 20px;
      border: none;
      cursor: pointer;
      border-radius: 5px;
      color: #fff;
      text-decoration: none;
      font-size: 16px;
    }
    button {
      background: #28a745;
    }
    button:hover {
      background: #218838;
    }
    .cancel {
      background: #6c757d;
    }
    .cancel:hover {
      background: #5a6268;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h1>Editar Proveedor #<?= (int)$id ?></h1>
    <form method="POST" action="">
      <label for="nombre">Nombre:</label>
      <input
        type="text"
        id="nombre"
        name="nombre"
        value="<?= htmlspecialchars($datos['nombre']) ?>"
        required
        pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]{3,}"
        title="Mínimo 3 letras. Solo letras y espacios.">

      <label for="correo">Correo:</label>
      <input
        type="email"
        id="correo"
        name="correo"
        value="<?= htmlspecialchars($datos['correo']) ?>"
        required>

      <label for="telefono">Teléfono:</label>
      <input
        type="text"
        id="telefono"
        name="telefono"
        value="<?= htmlspecialchars($datos['telefono']) ?>"
        required
        pattern="[0-9]{7,15}"
        title="Solo números. Entre 7 y 15 dígitos.">

      <label for="direccion">Dirección:</label>
      <input
        type="text"
        id="direccion"
        name="direccion"
        value="<?= htmlspecialchars($datos['direccion']) ?>"
        required
        pattern="^[A-Za-z0-9ÁÉÍÓÚáéíóúÑñ\s\.,#\-]{5,100}$"
        title="Letras, números, espacios, comas, puntos, guiones y #. Mínimo 5 caracteres.">

      <label for="tipo_servicio">Tipo de Servicio:</label>
      <input
        type="text"
        id="tipo_servicio"
        name="tipo_servicio"
        value="<?= htmlspecialchars($datos['tipo_servicio']) ?>"
        required
        pattern=".{4,}"
        title="Mínimo 4 caracteres.">

      <div class="actions">
        <button type="submit">Actualizar</button>
        <a href="../index.php" class="cancel">Cancelar</a>
      </div>
    </form>
  </div>
</body>
</html>



