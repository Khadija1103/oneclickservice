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
    body { font-family: Arial; padding:20px; background:#f4f4f4; }
    .btn { padding:10px 20px; background:#28a745; color:#fff; text-decoration:none; border-radius:5px; }
    .btn:hover { background:#218838; }
    table { width:100%; border-collapse:collapse; margin-top:10px; }
    th, td { padding:8px; border:1px solid #ddd; text-align:left; }
    th { background:#28a745; color:#fff; }
    form { margin-bottom:10px; display:inline-block; }
  </style>
</head>
<body>
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

