<?php
// View/servicios/index.php

require_once __DIR__ . '/../../Controllers/ServiciosControllers.php';
$ctrl = new ServiciosControllers();
$busqueda = $_GET['buscar'] ?? '';
$result = $ctrl->listar($busqueda);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>Servicios – One Click Service</title>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    body { font-family: Arial; margin:0; background:#f4f6f8; }
    header, footer { background:#1e88e5; color:#fff; text-align:center; padding:20px; }
    .navbar { background:#007bff; overflow:hidden; }
    .navbar a { float:left; display:block; color:#fff; padding:14px 20px; text-decoration:none; }
    .navbar a:hover { background:#0056b3; }
    .container {
      max-width:1000px; margin:60px auto 80px; background:#fff;
      padding:20px; border-radius:8px; box-shadow:0 2px 10px rgba(0,0,0,0.1);
    }
    .buscar { display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; }
    .buscar input { padding:8px; width:250px; border:1px solid #ccc; border-radius:4px; }
    .buscar button, .buscar a.btn-create {
      padding:8px 16px; border:none; border-radius:6px; color:#fff;
      text-decoration:none; font-weight:bold; cursor:pointer;
    }
    .buscar button { background:#007bff; }
    .buscar a.btn-create { background:#43a047; }
    table { width:100%; border-collapse:collapse; margin-top:10px; }
    th, td { padding:12px; border-bottom:1px solid #ddd; text-align:center; }
    th { background:#1e88e5; color:#fff; }
    a.btn-edit, button.btn-delete {
      padding:6px 12px; border:none; border-radius:4px; color:#fff;
      text-decoration:none; margin:0 4px; cursor:pointer;
    }
    a.btn-edit { background:#007bff; }
    button.btn-delete { background:#dc3545; }
  </style>
</head>
<body>
  <div class="navbar">
    <a href="../../index.php">Inicio</a>
    <a href="../proveedores/index.php">Proveedores</a>
    <a href="../usuarios/index.php">Usuarios</a>
    <a href="../reservas/index.php">Reservas</a>
    <a href="#">Servicios</a>
  </div>

  <header><h1>One Click Service – Servicios</h1></header>
  <div class="container">
    <h2>Listado de Servicios</h2>
    <div class="buscar">
      <form method="GET">
        <input type="text" name="buscar" placeholder="Buscar servicio o proveedor" value="<?=htmlspecialchars($busqueda)?>">
        <button type="submit">Buscar</button>
        <a href="index.php">Limpiar</a>
      </form>
      <a href="crear.php" class="btn-create">+ Crear Servicio</a>
    </div>
    <table>
      <tr>
        <th>ID</th><th>Servicio</th><th>Descripción</th><th>Precio</th><th>Proveedor</th><th>Acciones</th>
      </tr>
      <?php if($result && $result->num_rows): while($fila = $result->fetch_assoc()): ?>
      <tr>
        <td><?=$fila['id']?></td>
        <td><?=htmlspecialchars($fila['nombre_servicio'])?></td>
        <td><?=htmlspecialchars($fila['descripcion'])?></td>
        <td><?=$fila['precio']?></td>
        <td><?=htmlspecialchars($fila['proveedor'])?></td>
        <td>
          <a href="editar.php?id=<?=$fila['id']?>" class="btn-edit">Editar</a>
          <button class="btn-delete" onclick="confirmarEliminar(<?=$fila['id']?>)">Eliminar</button>
        </td>
      </tr>
      <?php endwhile; else: ?>
        <tr><td colspan="6">No hay servicios registrados.</td></tr>
      <?php endif; ?>
    </table>
  </div>
  <footer><p>© <?=date("Y")?> One Click Service</p></footer>

  <script>
  function confirmarEliminar(id) {
    Swal.fire({
      title: '¿Estás seguro?',
      text: "¡Esta acción no se puede deshacer!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#dc3545',
      cancelButtonColor: '#6c757d',
      confirmButtonText: 'Sí, eliminar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = 'eliminar.php?id=' + id;
      }
    });
  }
  </script>
</body>
</html>
