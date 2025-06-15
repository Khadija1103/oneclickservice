<?php
session_start();
if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] !== 'proveedor') {
    header('Location: ../auth/login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Panel del Proveedor</title>
  <link rel="stylesheet" href="../assets/styles.css">
</head>
<body>
  <h1>Bienvenido, <?= $_SESSION['nombre'] ?> (Proveedor)</h1>

  <p>Aquí puedes ver y gestionar los servicios que ofreces.</p>

  <a href="../auth/logout.php" class="cerrar-sesion">Cerrar sesión</a>
</body>
</html>
