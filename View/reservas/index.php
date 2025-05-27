<?php
// View/reservas/index.php
require_once __DIR__ . '/../../Controllers/ReservasControllers.php';
$ctrl    = new ReservasControllers();
$busqueda = $_GET['buscar'] ?? '';
$result  = $ctrl->listar($busqueda);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>Reservas – One Click Service</title>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    body{font-family:Arial;margin:0;background:#f4f6f8;}
    header,footer{background:#1e88e5;color:#fff;text-align:center;padding:20px;}
    nav{background:#1565c0;padding:10px;text-align:center;}
    nav a{color:#fff;margin:0 15px;text-decoration:none;font-weight:bold;}
    .container{max-width:1000px;margin:60px auto;background:#fff;padding:20px;border-radius:8px;box-shadow:0 2px 10px rgba(0,0,0,0.1);}
    .search{display:flex;justify-content:space-between;margin-bottom:20px;}
    .search input{padding:8px;width:300px;border:1px solid #ccc;border-radius:4px;}
    .search button,.search a.btn-create{padding:8px 16px;border:none;border-radius:4px;color:#fff;text-decoration:none;cursor:pointer;}
    .search button{background:#007bff;} .search a.btn-create{background:#43a047;}
    table{width:100%;border-collapse:collapse;}
    th,td{padding:12px;border:1px solid #ddd;text-align:center;}
    th{background:#1e88e5;color:#fff;}
    a.btn-edit,button.btn-delete{padding:6px 12px;border:none;border-radius:4px;color:#fff;text-decoration:none;margin:0 4px;cursor:pointer;}
    a.btn-edit{background:#ffc107;} button.btn-delete{background:#dc3545;}
  </style>
</head>
<body>
<header><h1>One Click Service - Reservas</h1></header>
<nav>
<div class="navbar">
    <a href="http://localhost/oneclickservice-master/main.php">Inicio</a>
    <a href="http://localhost/oneclickservice-master/index.php">Proveedores</a>
    <a href="http://localhost/oneclickservice-master/View/usuarios/index.php">Usuarios</a>
    <a href="http://localhost/oneclickservice-master/View/servicios/index.php">Servicios</a>
  </div>

</nav>
<div class="container">
  <h2>Listado de Reservas</h2>
  <div class="search">
    <form method="GET">
      <input type="text" name="buscar" placeholder="Buscar cliente o servicio" value="<?=htmlspecialchars($busqueda)?>">
      <button type="submit">Buscar</button>
    </form>
    <a href="crear.php" class="btn-create">+ Crear Reserva</a>
  </div>
  <table>
    <tr><th>ID</th><th>Cliente</th><th>Servicio</th><th>Fecha</th><th>Estado</th><th>Acciones</th></tr>
    <?php if($result && $result->num_rows): while($f = $result->fetch_assoc()): ?>
    <tr>
      <td><?=$f['id']?></td>
      <td><?=htmlspecialchars($f['cliente'])?></td>
      <td><?=htmlspecialchars($f['servicio'])?></td>
      <td><?=$f['fecha_reserva']?></td>
      <td><?=htmlspecialchars($f['estado'])?></td>
      <td>
        <a href="editar.php?id=<?=$f['id']?>" class="btn-edit">Editar</a>
        <button class="btn-delete" onclick="confirmarEliminar(<?=$f['id']?>)">Eliminar</button>
      </td>
    </tr>
    <?php endwhile; else: ?>
      <tr><td colspan="6">No hay reservas.</td></tr>
    <?php endif; ?>
  </table>
</div>
<footer><p>© <?=date('Y')?> One Click Service</p></footer>
<script>
function confirmarEliminar(id) {
  Swal.fire({
    title: '¿Estás seguro?',
    text: 'Esta acción no se puede deshacer.',
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
