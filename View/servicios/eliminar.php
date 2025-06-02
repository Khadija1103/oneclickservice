<?php
<<<<<<< HEAD
// View/servicios/eliminar.php
require_once __DIR__ . '/../../Controllers/ServiciosControllers.php';
$ctrl = new ServiciosControllers();

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if (!$id) { echo "ID inválido."; exit; }

// Si viene POST, elimina y redirige
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ctrl->eliminarServicio($id);
}

// Obtiene datos para confirmar
$data = $ctrl->datosParaEditar($id);
if (!$data) { echo "Servicio no encontrado."; exit; }
=======
// View/reservas/eliminar.php

require_once __DIR__ . '/../../Controllers/ReservasControllers.php';
$ctrl = new ReservasControllers();

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if (!$id) {
    echo "ID inválido.";
    exit;
}

// Si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ctrl->eliminarReserva($id);
    echo "<script>alert('Reserva eliminada correctamente.'); window.location.href = '../index.php';</script>";
    exit;
}

// Obtener datos para mostrar en la vista
$datos = $ctrl->datosParaEditar($id);
if (!$datos) {
    echo "Reserva no encontrada.";
    exit;
}
>>>>>>> main
?>
<!DOCTYPE html>
<html lang="es">
<head>
<<<<<<< HEAD
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>Eliminar Servicio – One Click Service</title>
  <style>
    body{font-family:Arial;margin:0;background:#f4f6f8;display:flex;justify-content:center;align-items:center;height:100vh;}
    .confirm-box{background:#fff;padding:30px;border-radius:8px;max-width:400px;margin:auto;text-align:center;box-shadow:0 0 10px rgba(0,0,0,0.1);}
    button,.cancel{margin:10px;padding:10px 20px;border:none;cursor:pointer;border-radius:4px;color:#fff;}
    button{background:#dc3545;}button:hover{background:#c82333;}
    .cancel{background:#6c757d;} .cancel:hover{background:#5a6268;}
=======
  <meta charset="UTF-8">
  <title>Eliminar Reserva</title>
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
>>>>>>> main
  </style>
</head>
<body>
  <div class="confirm-box">
<<<<<<< HEAD
    <h2>¿Eliminar servicio #<?=$id?>?</h2>
    <p><strong><?=htmlspecialchars($data['nombre_servicio'])?></strong></p>
    <form method="POST" action="">
      <button type="submit">Sí, eliminar</button>
      <a href="index.php" class="cancel">No, cancelar</a>
=======
    <h2>¿Está seguro de eliminar?</h2>
    <p><strong><?= htmlspecialchars($datos['nombre']) ?></strong></p>
    <form method="POST">
      <button type="submit">Sí, eliminar</button>
      <a href="../index.php" class="cancel">No, cancelar</a>
>>>>>>> main
    </form>
  </div>
</body>
</html>
<<<<<<< HEAD
=======



>>>>>>> main
