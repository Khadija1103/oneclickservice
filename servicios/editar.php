<?php
include '../conexion.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$row = $conn->query("SELECT * FROM servicios WHERE id=$id")->fetch_assoc();
if (!$row) die('Servicio no encontrado.');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ns  = $conn->real_escape_string($_POST['nombre_servicio']);
    $desc= $conn->real_escape_string($_POST['descripcion']);
    $pr  = $conn->real_escape_string($_POST['precio']);
    $pid = (int)$_POST['proveedor_id'];

    $sql = "UPDATE servicios
             SET nombre_servicio='$ns',
                 descripcion='$desc',
                 precio=$pr,
                 proveedor_id=$pid
           WHERE id=$id";
    if ($conn->query($sql)) {
        header('Location: index.php');
        exit;
    } else {
        die("Error: " . $conn->error);
    }
}

$prov = $conn->query("SELECT id,nombre FROM proveedores");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>Editar Servicio – One Click Service</title>
  <style>
    /* mismos estilos que crear.php */
    body { font-family:Arial; margin:0; background:#f4f6f8; display:flex; justify-content:center; align-items:center; height:100vh; }
    .form-container { background:#fff; padding:30px; border-radius:8px; box-shadow:0 2px 10px rgba(0,0,0,0.1); width:90%; max-width:500px; }
    h2 { color:#007bff; text-align:center; }
    label { display:block; margin-top:15px; font-weight:bold; }
    input, textarea, select { width:100%; padding:10px; margin-top:5px; border:1px solid #ccc; border-radius:4px; }
    button { background:#007bff; color:#fff; padding:10px; border:none; border-radius:4px; cursor:pointer; width:100%; font-size:16px; margin-top:20px; }
    button:hover { background:#0069d9; }
    .back { text-align:center; margin-top:15px; }
    .back a { color:#007bff; text-decoration:none; }
    .back a:hover { text-decoration:underline; }
  </style>
</head>
<body>

  <div class="form-container">
    <h2>Editar Servicio</h2>
    <form method="POST">
      <label>Nombre del servicio:</label>
      <input type="text" name="nombre_servicio" value="<?=htmlspecialchars($row['nombre_servicio'])?>" required>

      <label>Descripción:</label>
      <textarea name="descripcion" required><?=htmlspecialchars($row['descripcion'])?></textarea>

      <label>Precio:</label>
      <input type="number" name="precio" step="0.01" value="<?=$row['precio']?>" required>

      <label>Proveedor:</label>
      <select name="proveedor_id" required>
        <?php while($p = $prov->fetch_assoc()): ?>
          <option value="<?=$p['id']?>" <?=$p['id']==$row['proveedor_id']?'selected':''?>>
            <?=htmlspecialchars($p['nombre'])?>
          </option>
        <?php endwhile; ?>
      </select>

      <button type="submit">Actualizar Servicio</button>
    </form>
    <div class="back">
      <a href="index.php">← Volver a Servicios</a>
    </div>
  </div>

</body>
</html>
