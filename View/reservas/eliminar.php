<?php
<<<<<<< HEAD
// View/reservas/eliminar.php
=======
>>>>>>> main
require_once __DIR__ . '/../../Controllers/ReservasControllers.php';
$ctrl = new ReservasControllers();

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
<<<<<<< HEAD
if (!$id) { echo "ID inválido."; exit; }

// Mostrar confirmación y procesar
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ctrl->eliminarReserva($id);
}

// obtener nombre para mensaje
$data = $ctrl->datosParaEditar($id);
if (!$data) { echo "Reserva no encontrada."; exit; }
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>Eliminar Reserva</title>
  <style>
    body{font-family:Arial;margin:0;background:#f4f6f8;display:flex;justify-content:center;align-items:center;height:100vh;}
    .confirm-box{background:#fff;padding:30px;border-radius:8px;max-width:400px;margin:auto;text-align:center;box-shadow:0 0 10px rgba(0,0,0,0.1);}
    button,.cancel{margin:10px;padding:10px 20px;border:none;cursor:pointer;border-radius:4px;color:#fff;}
    button{background:#dc3545;}button:hover{background:#c82333;}
    .cancel{background:#6c757d;} .cancel:hover{background:#5a6268;}
=======
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
>>>>>>> main
  </style>
</head>
<body>
  <div class="confirm-box">
<<<<<<< HEAD
    <h2>¿Eliminar reserva #<?=$id?>?</h2>
    <p><strong>Cliente:</strong> <?=htmlspecialchars($data['cliente'])?></p>
    <p><strong>Servicio:</strong> <?=htmlspecialchars($data['servicio'])?></p>
    <form method="POST" action="">
      <button type="submit">Sí, eliminar</button>
      <a href="index.php" class="cancel">No, cancelar</a>
=======
    <h2>¿Estás segura de eliminar la reserva #<?= $id ?>?</h2>
    <form method="POST">
      <button type="submit">Sí, eliminar</button>
      <a href="index.php" class="cancel">Cancelar</a>
>>>>>>> main
    </form>
  </div>
</body>
</html>
