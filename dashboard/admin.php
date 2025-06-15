<?php
session_start();
if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] !== 'admin') {
    header('Location: ../auth/login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Panel de Administrador</title>
  <link rel="stylesheet" href="../assets/styles.css"> <!-- Usa tu CSS si tienes -->
</head>
<body>
  <h1>Bienvenido, <?= $_SESSION['nombre'] ?> (Administrador)</h1>

  <p>Desde aquí puedes gestionar usuarios, proveedores y servicios.</p>

  <a href="../auth/logout.php" class="cerrar-sesion">Cerrar sesión</a>
</body>
</html>


