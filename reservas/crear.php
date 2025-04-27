<?php
include '../conexion.php';

// Crear nueva reserva
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uid = (int) $_POST['usuario_id'];
    $sid = (int) $_POST['servicio_id'];
    $fr  = $conn->real_escape_string($_POST['fecha_reserva']);
    $est = $conn->real_escape_string($_POST['estado']);

    $sql = "INSERT INTO reservas (usuario_id, servicio_id, fecha_reserva, estado) VALUES ($uid, $sid, '$fr', '$est')";
    if ($conn->query($sql)) {
        header('Location: index.php');
        exit;
    } else {
        die("Error al crear reserva: " . $conn->error);
    }
}

// Obtener lista de usuarios y servicios para el formulario
$users = $conn->query('SELECT id, nombre FROM usuarios');
$servs = $conn->query('SELECT id, nombre_servicio FROM servicios');
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>Crear Reserva – One Click Service</title>
  <style>
    body { font-family: Arial, sans-serif; margin:0; background:#f4f6f8; display:flex; justify-content:center; align-items:center; height:100vh; }
    .form-container { background:#fff; padding:30px; border-radius:8px; box-shadow:0 2px 10px rgba(0,0,0,0.1); width:90%;max-width:500px; }
    .form-container h2 { margin-top:0; color:#007bff; text-align:center; }
    label { display:block; margin-top:15px; font-weight:bold; }
    select, input { width:100%; padding:10px; margin-top:5px; border:1px solid #ccc; border-radius:4px; }
    button { background:#43a047; color:#fff; padding:10px; border:none; border-radius:4px; cursor:pointer; width:100%; font-size:16px; margin-top:20px; }
    button:hover { background:#388e3c; }
    .back { margin-top:15px; text-align:center; }
    .back a { color:#007bff; text-decoration:none; }
    .back a:hover { text-decoration:underline; }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>Crear Reserva</h2>
    <form method="POST" action="crear.php">
      <label for="usuario_id">Usuario:</label>
      <select name="usuario_id" id="usuario_id" required>
        <?php while ($u = $users->fetch_assoc()): ?>
          <option value="<?= $u['id'] ?>"><?= htmlspecialchars($u['nombre']) ?></option>
        <?php endwhile; ?>
      </select>

      <label for="servicio_id">Servicio:</label>
      <select name="servicio_id" id="servicio_id" required>
        <?php while ($s = $servs->fetch_assoc()): ?>
          <option value="<?= $s['id'] ?>"><?= htmlspecialchars($s['nombre_servicio']) ?></option>
        <?php endwhile; ?>
      </select>

      <label for="fecha_reserva">Fecha de Reserva:</label>
      <input type="date" name="fecha_reserva" id="fecha_reserva" required>

      <label for="estado">Estado:</label>
      <select name="estado" id="estado" required>
        <option value="Pendiente">Pendiente</option>
        <option value="Confirmada">Confirmada</option>
        <option value="Cancelada">Cancelada</option>
      </select>

      <button type="submit">Guardar Reserva</button>
    </form>
    <div class="back"><a href="index.php">← Volver a Reservas</a></div>
  </div>
</body>
</html>
