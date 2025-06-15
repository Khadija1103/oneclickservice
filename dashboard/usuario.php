<?php
session_start();
if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] !== 'usuario') {
    header('Location: ../auth/login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Panel del Usuario</title>
  <link rel="stylesheet" href="../assets/styles.css">
</head>
<body>
  <h1>Bienvenido, <?= $_SESSION['nombre'] ?> (Usuario)</h1>

  <p>Puedes explorar y contratar servicios desde aquí.</p>

  <a href="../auth/logout.php" class="cerrar-sesion">Cerrar sesión</a>
</body>
</html>
