<?php
include '../conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nombre        = $_POST['nombre'];
  $correo        = $_POST['correo'];
  $telefono      = $_POST['telefono'];
  $direccion     = $_POST['direccion'];
  $tipo_servicio = $_POST['tipo_servicio'];

  $sql = "INSERT INTO proveedores 
          (nombre, correo, telefono, direccion, tipo_servicio)
          VALUES 
          ('$nombre','$correo','$telefono','$direccion','$tipo_servicio')";
  if ($conn->query($sql) === TRUE) {
    header("Location: index.php");
    exit;
  } else {
    echo "Error: " . $conn->error;
  }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Crear Proveedor</title>
  <style>
    body{font-family:Arial;margin:0;padding:0;background:#f4f4f4;display:flex;justify-content:center;align-items:center;height:100vh;}
    .form-container{background:#fff;padding:30px;border-radius:8px;box-shadow:0 0 10px rgba(0,0,0,0.1);width:90%;max-width:500px;}
    h1{text-align:center;color:#28a745;}
    label{display:block;margin-top:15px;font-weight:bold;}
    input{width:100%;padding:10px;margin-top:5px;border:1px solid #ccc;border-radius:5px;}
    input[type=submit]{background:#28a745;color:#fff;border:none;padding:12px;margin-top:20px;border-radius:5px;cursor:pointer;font-size:16px;width:100%;}
    input[type=submit]:hover{background:#218838;}
    .back-link{text-align:center;margin-top:15px;}
    .back-link a{color:#007bff;text-decoration:none;}
    .back-link a:hover{text-decoration:underline;}
  </style>
</head>
<body>
  <div class="form-container">
    <h1>Crear Proveedor</h1>
    <form method="POST">
      <label>Nombre:</label>
      <input type="text" name="nombre" required>
      <label>Correo:</label>
      <input type="email" name="correo" required>
      <label>Teléfono:</label>
      <input type="text" name="telefono">
      <label>Dirección:</label>
      <input type="text" name="direccion">
      <label>Tipo de Servicio:</label>
      <input type="text" name="tipo_servicio">
      <input type="submit" value="Guardar">
    </form>
    <div class="back-link">
      <a href="index.php">← Volver a la lista</a>
    </div>
  </div>
</body>
</html>
