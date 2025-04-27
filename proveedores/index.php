<?php 
include '../conexion.php';

$busqueda = $_GET['buscar'] ?? '';
$sql = "SELECT * FROM proveedores
        WHERE nombre LIKE '%$busqueda%' 
           OR correo LIKE '%$busqueda%' 
           OR tipo_servicio LIKE '%$busqueda%'";
$resultado = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Proveedores – One Click Service</title>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    body { font-family: Arial, sans-serif; margin:0; background:#f4f4f4; }
    header, footer { background: #00a884; color:#fff; text-align:center; padding:15px; }
    nav { background:#333; padding:10px; text-align:center; }
    nav a { color:white; margin:0 15px; text-decoration:none; font-weight:bold; }
    nav a:hover { text-decoration:underline; }
    .container { max-width:900px; margin:60px auto 100px; background:#fff; padding:20px; border-radius:8px; box-shadow:0 0 10px rgba(0,0,0,0.1); }
    .buscar { display:flex; justify-content:space-between; margin-bottom:20px; }
    input[type=text] { padding:8px; width:250px; }
    .btn { padding:8px 16px; border:none; border-radius:6px; color:#fff; cursor:pointer; font-weight:bold; }
    .btn-create { background:#28a745; }
    .btn-edit   { background:#007bff; }
    .btn-delete { background:#dc3545; }
    table { width:100%; border-collapse:collapse; }
    th, td { padding:12px; border-bottom:1px solid #ddd; text-align:center; }
    th { background:#00a884; color:#fff; }
    @media (max-width:600px){ table, tr, td, th{display:block;} td{text-align:right;} td::before{content:attr(data-label);float:left;font-weight:bold;} }
  </style>
</head>
<body>
<header>
  <h1>One Click Service</h1>
  <p>Gestión de Proveedores</p>
</header>

<!-- NAVBAR agregado -->
<nav>
  <a href="../index.php">Inicio</a>
  <a href="../reservas/index.php">Reservas</a>
  <a href="../usuarios/index.php">Usuarios</a>
  <a href="../contactos/index.php">Contactos</a>
</nav>

<div class="container">
  <div class="buscar">
    <form method="GET">
      <input type="text" name="buscar" placeholder="Buscar proveedor..." value="<?=htmlspecialchars($busqueda)?>">
      <button type="submit" class="btn btn-edit">Buscar</button>
    </form>
    <a href="crear.php" class="btn btn-create">+ Crear Proveedor</a>
  </div>
  <table>
    <tr>
      <th>ID</th>
      <th>Nombre</th>
      <th>Correo</th>
      <th>Teléfono</th>
      <th>Dirección</th>
      <th>Tipo Servicio</th>
      <th>Acciones</th>
    </tr>
    <?php while($fila = $resultado->fetch_assoc()): ?>
    <tr>
      <td data-label="ID"><?=$fila['id']?></td>
      <td data-label="Nombre"><?=htmlspecialchars($fila['nombre'])?></td>
      <td data-label="Correo"><?=htmlspecialchars($fila['correo'])?></td>
      <td data-label="Teléfono"><?=htmlspecialchars($fila['telefono'])?></td>
      <td data-label="Dirección"><?=htmlspecialchars($fila['direccion'])?></td>
      <td data-label="Tipo Servicio"><?=htmlspecialchars($fila['tipo_servicio'])?></td>
      <td data-label="Acciones">
        <a href="editar.php?id=<?=$fila['id']?>" class="btn btn-edit">Editar</a>
        <button class="btn btn-delete" onclick="confirmarEliminar(<?=$fila['id']?>)">Eliminar</button>
      </td>
    </tr>
    <?php endwhile; ?>
  </table>
</div>

<footer>
  <p>Tu servicio a un click – © <?=date("Y")?> One Click Service</p>
</footer>

<script>
function confirmarEliminar(id){
  Swal.fire({
    title: '¿Estás seguro?',
    text: "¡No podrás revertir esto!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#dc3545',
    cancelButtonColor: '#6c757d',
    confirmButtonText: 'Sí, eliminar',
    cancelButtonText: 'Cancelar'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location = 'eliminar.php?id='+id;
    }
  });
}
</script>
</body>
</html>
