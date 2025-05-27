<?php
// View/reservas/editar.php
require_once __DIR__ . '/../../Controllers/ReservasControllers.php';
$ctrl = new ReservasControllers();

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if (!$id) { echo "ID inválido."; exit; }

$ctrl->editarReserva($id);  // procesará el POST y redirigirá

// datos para precargar:
$data = $ctrl->datosParaEditar($id);
if (!$data) { echo "Reserva no encontrada."; exit; }

// listas:
require_once __DIR__ . '/../../conexion.php';
$usuarios  = $conn->query("SELECT id, nombre FROM usuarios");
$servicios = $conn->query("SELECT id, nombre_servicio FROM servicios");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>Editar Reserva</title>
  <style>
    body{font-family:Arial;margin:0;background:#f4f6f8;display:flex;justify-content:center;align-items:center;height:100vh;}
    .form-container{background:#fff;padding:30px;border-radius:8px;box-shadow:0 2px 10px rgba(0,0,0,0.1);width:90%;max-width:500px;}
    h2{text-align:center;color:#007bff;margin-top:0;}
    label{display:block;margin-top:15px;font-weight:bold;}
    select,input{width:100%;padding:10px;margin-top:5px;border:1px solid #ccc;border-radius:4px;}
    button{background:#007bff;color:#fff;padding:10px;border:none;border-radius:4px;cursor:pointer;width:100%;margin-top:20px;}
    button:hover{background:#0056b3;}
    .back{margin-top:15px;text-align:center;}
    .back a{color:#007bff;text-decoration:none;}
    .back a:hover{text-decoration:underline;}
  </style>
</head>
<body>
  <div class="form-container">
    <h2>Editar Reserva #<?=$id?></h2>
    <form method="POST" action="">
      <label>Usuario:</label>
      <select name="usuario_id" required>
        <?php while($u=$usuarios->fetch_assoc()): ?>
        <option value="<?=$u['id']?>" <?= $u['id']==$data['usuario_id']?'selected':'' ?>>
          <?=htmlspecialchars($u['nombre'])?>
        </option>
        <?php endwhile;?>
      </select>
      <label>Servicio:</label>
      <select name="servicio_id" required>
        <?php while($s=$servicios->fetch_assoc()): ?>
        <option value="<?=$s['id']?>" <?= $s['id']==$data['servicio_id']?'selected':'' ?>>
          <?=htmlspecialchars($s['nombre_servicio'])?>
        </option>
        <?php endwhile;?>
      </select>
      <label>Fecha de Reserva:</label>
      <input type="date" name="fecha_reserva" value="<?=$data['fecha_reserva']?>" required>
      <label>Estado:</label>
      <select name="estado" required>
        <option value="Pendiente"  <?=$data['estado']=='Pendiente' ? 'selected':''?>>Pendiente</option>
        <option value="Confirmada" <?=$data['estado']=='Confirmada'?'selected':''?>>Confirmada</option>
        <option value="Cancelada" <?=$data['estado']=='Cancelada'?'selected':''?>>Cancelada</option>
      </select>
      <button type="submit">Actualizar Reserva</button>
    </form>
    <div class="back"><a href="index.php">← Volver a Reservas</a></div>
  </div>
</body>
</html>
