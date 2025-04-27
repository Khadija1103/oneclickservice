<?php 
include '../conexion.php';

$busqueda = $_GET['buscar'] ?? '';
$sql = "
  SELECT s.id,
         s.nombre_servicio,
         s.descripcion,
         s.precio,
         p.nombre AS proveedor
    FROM servicios s
    JOIN proveedores p ON s.proveedor_id = p.id
   WHERE s.nombre_servicio LIKE '%$busqueda%'
      OR p.nombre            LIKE '%$busqueda%'
";
$resultado = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>Servicios – One Click Service</title>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    body { font-family: Arial, sans-serif; margin:0; background:#f4f6f8; }
    header, footer {
      background:#1e88e5; color:#fff; text-align:center; padding:20px;
    }
    header img { height:40px; vertical-align:middle; margin-right:10px; }
    header h1 { display:inline; font-size:24px; vertical-align:middle; }
    .navbar {
      background-color: #007bff;
      overflow: hidden;
    }
    .navbar a {
      float: left;
      display: block;
      color: white;
      text-align: center;
      padding: 14px 20px;
      text-decoration: none;
    }
    .navbar a:hover {
      background-color: #ddd;
      color: black;
    }
    .container {
      max-width:1000px; margin:60px auto 80px; background:#fff;
      padding:20px; border-radius:8px; box-shadow:0 2px 10px rgba(0,0,0,0.1);
    }
    .buscar {
      display:flex; justify-content:space-between; align-items:center;
      margin-bottom:20px;
    }
    .buscar input[type="text"] {
      padding:8px; width:250px; border:1px solid #ccc; border-radius:4px;
    }
    .buscar button, .buscar a.btn-create {
      padding:8px 16px; border:none; border-radius:6px;
      color:#fff; text-decoration:none; font-weight:bold; cursor:pointer;
      transition:opacity .2s;
    }
    .buscar button { background:#007bff; }
    .buscar button:hover { opacity:.8; }
    .buscar a.btn-create { background:#43a047; }
    .buscar a.btn-create:hover { opacity:.8; }
    table {
      width:100%; border-collapse:collapse; margin-top:10px;
    }
    th, td {
      padding:12px; border-bottom:1px solid #ddd; text-align:center;
    }
    th { background:#1e88e5; color:#fff; }
    a.btn-edit, button.btn-delete {
      padding:6px 12px; border:none; border-radius:4px; color:#fff;
      text-decoration:none; font-weight:bold; cursor:pointer;
      margin:0 4px; transition:opacity .2s;
    }
    a.btn-edit { background:#007bff; }
    a.btn-edit:hover { opacity:.8; }
    button.btn-delete { background:#dc3545; }
    button.btn-delete:hover { opacity:.8; }
    @media (max-width:600px){
      .buscar { flex-direction:column; align-items:stretch; }
      .buscar input { width:100%; margin-bottom:10px; }
      .buscar button, .buscar a { width:100%; margin:5px 0; }
    }
  </style>
</head>
<body>

<!-- Navbar -->
<div class="navbar">
  <a href="http://localhost/oneclickservice/index.php">Inicio</a>
  <a href="http://localhost/oneclickservice/proveedores/index.php">Proveedores</a>
  <a href="http://localhost/oneclickservice/usuarios/index.php">Usuarios</a>
  <a href="http://localhost/oneclickservice/reservas/index.php">Reservas</a>
  <a href="http://localhost/oneclickservice/contactos/index.php">Contactos</a>
</div>

<header>
  <img src="https://cdn-icons-png.flaticon.com/512/684/684908.png" alt="Logo">
  <h1>One Click Service</h1>
</header>

<div class="container">
  <h2>Servicios</h2>
  <div class="buscar">
    <form method="GET" action="index.php">
      <input type="text" name="buscar" placeholder="Buscar servicio o proveedor" value="<?=htmlspecialchars($busqueda)?>">
      <button type="submit">Buscar</button>
      <a href="index.php">Limpiar</a>
    </form>
    <a href="crear.php" class="btn-create">+ Crear Servicio</a>
  </div>

  <table>
    <tr>
      <th>ID</th>
      <th>Servicio</th>
      <th>Descripción</th>
      <th>Precio</th>
      <th>Proveedor</th>
      <th>Acciones</th>
    </tr>
    <?php while($fila = $resultado->fetch_assoc()): ?>
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
    <?php endwhile; ?>
  </table>
</div>

<footer>
  <p>Tu servicio a un clic – © <?=date("Y")?> One Click Service</p>
</footer>

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
      window.location = 'eliminar.php?id=' + id;
    }
  });
}
</script>

</body>
</html>

