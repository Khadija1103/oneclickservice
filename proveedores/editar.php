<?php
include '../conexion.php';
if (!isset($_GET['id'])) exit("ID no especificado.");
$id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nombre        = $_POST['nombre'];
  $correo        = $_POST['correo'];
  $telefono      = $_POST['telefono'];
  $direccion     = $_POST['direccion'];
  $tipo_servicio = $_POST['tipo_servicio'];

  $sql = "UPDATE proveedores
          SET nombre='$nombre',
              correo='$correo',
              telefono='$telefono',
              direccion='$direccion',
              tipo_servicio='$tipo_servicio'
          WHERE id=$id";
  if ($conn->query($sql) === TRUE) {
    header("Location: index.php"); exit;
  } else {
    echo "Error: " . $conn->error;
  }
} else {
  $res = $conn->query("SELECT * FROM proveedores WHERE id=$id");
  if ($res->num_rows == 0) exit("Proveedor no encontrado.");
  $p = $res->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Proveedor</title>
  <style>
    body{font-family:Arial;margin:0;padding:0;background:#f4f4f4;display:flex;justify-content:center;align-items:center;height:100vh;}
    .form-container{background:#fff;padding:30px;border-radius:8px;box-shadow:0 0 10px rgba(0,0,0,0.1);width:90%;max-width:500px;}
    h1{text-align:center;color:#007bff;}
    label{display:block;margin-top:15px;font-weight:bold;}
    input{width:100%;padding:10px;margin-top:5px;border:1px solid #ccc;border-radius:5px;}
    input[type=submit]{background:#007bff;color:#fff;border:none;padding:12px;margin-top:20px;border-radius:5px;cursor:pointer;font-size:16px;width:100%;}
    input[type=submit]:hover{background:#0069d9;}
    .back-link{text-align:center;margin-top:15px;}
    .back-link a{color:#007bff;text-decoration:none;}
    .back-link a:hover{text-decoration:underline;}
  </style>
</head>
<body>
  <div class="form-container">
    <h1>Editar Proveedor</h1>
    <form method="POST">
      <label>Nombre:</label>
      <input type="text" name="nombre" value="<?=htmlspecialchars($p['nombre'])?>" required>
      <label>Correo:</label>
      <input type="email" name="correo" value="<?=htmlspecialchars($p['correo'])?>" required>
      <label>Teléfono:</label>
      <input type="text" name="telefono" value="<?=htmlspecialchars($p['telefono'])?>">
      <label>Dirección:</label>
      <input type="text" name="direccion" value="<?=htmlspecialchars($p['direccion'])?>">
      <label>Tipo de Servicio:</label>
      <input type="text" name="tipo_servicio" value="<?=htmlspecialchars($p['tipo_servicio'])?>">
      <input type="submit" value="Actualizar">
    </form>
    <div class="back-link">
      <a href="index.php">← Volver a la lista</a>
    </div>
  </div>
</body>
</html>
