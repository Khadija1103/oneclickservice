<?php
// index.php

require_once __DIR__ . '/Controllers/ProveedoresControllers.php';
$ctrl   = new ProveedoresControllers();
$filtro = $_GET['buscar'] ?? '';
$result = $ctrl->listar($filtro);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Lista de Proveedores</title>
  <style>
    body {
      font-family: Arial;
      padding: 20px;
      background: #f4f4f4;
      margin: 0;
    }
    .navbar {
      background-color: #007bff;
      overflow: hidden;
      padding: 10px 20px;
    }
    .navbar a {
      float: left;
      display: block;
      color: #f8f9fa;
      text-align: center;
      padding: 10px 16px;
      text-decoration: none;
    }
    .navbar a:hover {
      background-color:rgb(149, 196, 244);
      color: white;
    }
    .btn {
      padding: 10px 20px;
      background: #007bff;
      color: #fff;
      text-decoration: none;
      border-radius: 5px;
    }
    .btn:hover {
      background:rgb(136, 182, 231);
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
      background-color: #fff;
    }
    th, td {
      padding: 8px;
      border: 1px solid #ddd;
      text-align: left;
    }
    th {
      background: #007bff;
      color: #fff;
    }
    form {
      margin-bottom: 10px;
      display: inline-block;
    }
  </style>
</head>
<body>

  <div class="navbar">
    <a href="http://localhost/oneclickservice-master/main.php">Inicio</a>
    <a href="http://localhost/oneclickservice-master/View/usuarios/index.php">Usuarios</a>
    <a href="http://localhost/oneclickservice-master/View/reservas/index.php">Reservas</a>
    <a href="http://localhost/oneclickservice-master/View/servicios/index.php">Servicios</a>
  </div>

  <h1>Proveedores</h1>

  <a href="View/crear.php" class="btn">Crear Proveedor</a>

  <form method="GET">
    <input type="text" name="buscar" value="<?= htmlspecialchars($filtro) ?>" placeholder="Buscar por nombre">
    <button type="submit">Buscar</button>
  </form>

  <table>
    <tr><th>ID</th><th>Nombre</th><th>Correo</th><th>Teléfono</th><th>Dirección</th><th>Tipo</th><th>Acciones</th></tr>
    <?php if ($result && $result->num_rows): ?>
      <?php while ($p = $result->fetch_assoc()): ?>
        <tr>
          <td><?= $p['id'] ?></td>
          <td><?= htmlspecialchars($p['nombre']) ?></td>
          <td><?= htmlspecialchars($p['correo']) ?></td>
          <td><?= htmlspecialchars($p['telefono']) ?></td>
          <td><?= htmlspecialchars($p['direccion']) ?></td>
          <td><?= htmlspecialchars($p['tipo_servicio']) ?></td>
          <td>
            <a href="View/editar.php?id=<?= $p['id'] ?>" class="btn">Editar</a>
            <a href="View/eliminar.php?id=<?= $p['id'] ?>" class="btn" style="background:#dc3545;">Eliminar</a>
          </td>
        </tr>
      <?php endwhile; ?>
    <?php else: ?>
      <tr><td colspan="7">No hay proveedores registrados.</td></tr>
    <?php endif; ?>
  </table>

</body>
</html>
