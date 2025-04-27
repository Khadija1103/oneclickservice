<?php
include '../conexion.php';

// Validar que venga el ID
if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = (int)$_GET['id'];

// Obtener datos de la reserva
$result = $conn->query("SELECT * FROM reservas WHERE id = $id");
if ($result->num_rows === 0) {
    echo "Reserva no encontrada.";
    exit;
}
$reserva = $result->fetch_assoc();

// Procesar envío del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario_id    = (int)$_POST['usuario_id'];
    $servicio_id   = (int)$_POST['servicio_id'];
    $fecha_reserva = $conn->real_escape_string($_POST['fecha_reserva']);
    $estado        = $conn->real_escape_string($_POST['estado']);

    $sql = "
      UPDATE reservas
         SET usuario_id    = $usuario_id,
             servicio_id   = $servicio_id,
             fecha_reserva = '$fecha_reserva',
             estado        = '$estado'
       WHERE id = $id
    ";
    if ($conn->query($sql) === TRUE) {
        header('Location: index.php');
        exit;
    } else {
        echo "Error al actualizar: " . $conn->error;
    }
}

// Obtener opciones para los selects
$usuarios  = $conn->query("SELECT id, nombre FROM usuarios");
$servicios = $conn->query("SELECT id, nombre_servicio FROM servicios");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>Editar Reserva</title>
  <style>
    body { font-family: Arial, sans-serif; margin:0; background:#f4f6f8; display:flex; justify-content:center; align-items:center; height:100vh; }
    .form-container { background:#fff; padding:30px; border-radius:8px; box-shadow:0 2px 10px rgba(0,0,0,0.1); width:90%; max-width:500px; }
    h2 { color:#007bff; text-align:center; margin-top:0; }
    label { display:block; margin-top:15px; font-weight:bold; }
    select, input { width:100%; padding:10px; margin-top:5px; border:1px solid #ccc; border-radius:4px; }
    button { background:#007bff; color:#fff; padding:10px; border:none; border-radius:4px; cursor:pointer; width:100%; margin-top:20px; }
    button:hover { background:#0056b3; }
    .back { margin-top:15px; text-align:center; }
    .back a { color:#007bff; text-decoration:none; }
    .back a:hover { text-decoration:underline; }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>Editar Reserva</h2>
    <form method="POST">
      <label>Usuario:</label>
      <select name="usuario_id" required>
        <?php while ($u = $usuarios->fetch_assoc()): ?>
          <option value="<?= $u['id'] ?>" <?= $u['id'] == $reserva['usuario_id'] ? 'selected' : '' ?>>
            <?= htmlspecialchars($u['nombre']) ?>
          </option>
        <?php endwhile; ?>
      </select>

      <label>Servicio:</label>
      <select name="servicio_id" required>
        <?php while ($s = $servicios->fetch_assoc()): ?>
          <option value="<?= $s['id'] ?>" <?= $s['id'] == $reserva['servicio_id'] ? 'selected' : '' ?>>
            <?= htmlspecialchars($s['nombre_servicio']) ?>
          </option>
        <?php endwhile; ?>
      </select>

      <label>Fecha de Reserva:</label>
      <input type="date" name="fecha_reserva" value="<?= $reserva['fecha_reserva'] ?>" required>

      <label>Estado:</label>
      <select name="estado" required>
        <option value="Pendiente" <?= $reserva['estado'] == 'Pendiente' ? 'selected' : '' ?>>Pendiente</option>
        <option value="Confirmada" <?= $reserva['estado'] == 'Confirmada' ? 'selected' : '' ?>>Confirmada</option>
        <option value="Cancelada" <?= $reserva['estado'] == 'Cancelada' ? 'selected' : '' ?>>Cancelada</option>
      </select>

      <button type="submit">Actualizar Reserva</button>
    </form>
    <div class="back"><a href="index.php">← Volver a Reservas</a></div>
  </div>
</body>
</html>
