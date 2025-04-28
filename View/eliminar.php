<?php
// View/eliminar.php

require_once __DIR__ . '/../Controllers/ProveedoresControllers.php';
$ctrl = new ProveedoresControllers();

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if (!$id) { echo "ID inválido."; exit; }

// Si recibimos POST, eliminamos y redirigimos
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ctrl->eliminarProveedor($id);
    // ya redirige dentro del método
}

// Obtener datos para mostrar el nombre
$datos = $ctrl->datosParaEditar($id);
if (!$datos) { echo "Proveedor no encontrado."; exit; }
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Eliminar Proveedor</title>
  <style>
    body { font-family: Arial; background:#f4f4f4; padding:20px; }
    .confirm-box {
      background:#fff;
      padding:20px;
      border-radius:8px;
      max-width:400px;
      margin:auto;
      text-align:center;
      box-shadow:0 0 10px rgba(0,0,0,0.1);
    }
    button, .cancel {
      margin:10px 5px;
      padding:10px 20px;
      border:none;
      cursor:pointer;
      border-radius:4px;
      color:#fff;
      text-decoration:none;
    }
    button { background:#dc3545; }
    button:hover { background:#c82333; }
    .cancel { background:#6c757d; }
    .cancel:hover { background:#5a6268; }
  </style>
</head>
<body>
  <div class="confirm-box">
    <h2>¿Está seguro de eliminar?</h2>
    <p><strong><?= htmlspecialchars($datos['nombre']) ?></strong></p>
    <form method="POST" action="">
      <button type="submit">Sí, eliminar</button>
      <a href="../index.php" class="cancel">No, cancelar</a>
    </form>
  </div>
</body>
</html>
