<?php
require_once __DIR__ . '/../../Controllers/ReservasControllers.php';
$ctrl = new ReservasControllers();

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if (!$id) {
    echo "ID inválido.";
    exit;
}

// Procesar eliminación si se confirma
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ctrl->eliminarReserva($id);
    header("Location: index.php?msg=eliminado");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Eliminar Reserva</title>
  <style>
    body{font-family:Arial;margin:0;background:#f4f6f8;display:flex;justify-content:center;align-items:center;height:100vh;}
    .confirm-box{background:#fff;padding:30px;border-radius:8px;max-width:400px;text-align:center;box-shadow:0 0 10px rgba(0,0,0,0.1);}
    button,.cancel{margin:10px;padding:10px 20px;border:none;cursor:pointer;border-radius:4px;color:#fff;}
    button{background:#dc3545;}button:hover{background:#c82333;}
    .cancel{background:#6c757d;text-decoration:none;display:inline-block;line-height:34px;} .cancel:hover{background:#5a6268;}
  </style>
</head>
<body>
  <div class="confirm-box">
    <h2>¿Estás segura de eliminar la reserva #<?= $id ?>?</h2>
    <form method="POST">
      <button type="submit">Sí, eliminar</button>
      <a href="index.php" class="cancel">Cancelar</a>
    </form>
  </div>
</body>
</html>
