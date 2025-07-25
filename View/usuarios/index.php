<?php
// View/usuarios/index.php

require_once __DIR__ . '/../../Controllers/UsuariosControllers.php';
$ctrl  = new UsuariosControllers();
$result = $ctrl->listar();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Usuarios – One Click Service</title>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f8f9fa;
      margin: 0;
      padding: 0;
    }
    nav {
      background-color: #1565c0;
      padding: 10px;
      text-align: center;
    }
    nav a {
      color: white;
      margin: 0 15px;
      text-decoration: none;
      font-weight: bold;
    }
    nav a:hover {
      text-decoration: underline;
    }
    h1 {
      text-align: center;
      color: #333;
      margin-top: 30px;
    }
    .crear-btn {
      display: block;
      width: 200px;
      margin: 20px auto;
      padding: 10px;
      background-color: #007bff;
      color: white;
      text-align: center;
      text-decoration: none;
      border-radius: 5px;
      font-weight: bold;
    }
    .crear-btn:hover {
      background-color: #0056b3;
    }
    table {
      width: 90%;
      margin: 0 auto 50px auto;
      border-collapse: collapse;
      background-color: #fff;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    th, td {
      border: 1px solid #ddd;
      padding: 12px;
      text-align: center;
    }
    th {
      background-color: #1e88e5;
      color: white;
    }
    tr:nth-child(even) {
      background-color: #f2f2f2;
    }
    tr:hover {
      background-color: #e9ecef;
    }
    .btn-editar, .btn-eliminar {
      padding: 6px 12px;
      margin: 2px;
      font-size: 14px;
      border: none;
      border-radius: 4px;
      text-decoration: none;
      cursor: pointer;
    }
    .btn-editar {
      background-color: #ffc107;
      color: #212529;
    }
    .btn-editar:hover {
      background-color: #e0a800;
    }
    .btn-eliminar {
      background-color: #dc3545;
      color: white;
    }
    .btn-eliminar:hover {
      background-color: #c82333;
    }
  </style>
</head>
<body>

<nav>
  <a href="../../main.php">Inicio</a>
  <a href="../../index.php">Proveedores</a>
  <a href="../reservas/index.php">Reservas</a>
  <a href="../servicios/index.php">Servicios</a>
  <a href="#">Usuarios</a>
  <a href="http://localhost/oneclickservice-master/auth/logout.php" class="cerrar-sesion">Cerrar sesión</a>
</nav>

<h1>Lista de Usuarios</h1>

<a href="crear.php" class="crear-btn">+ Crear Usuario</a>

<table>
  <tr>
    <th>ID</th>
    <th>Nombre</th>
    <th>Correo</th>
    <th>Acciones</th>
  </tr>
  <?php while ($u = $result->fetch_assoc()): ?>
  <tr>
    <td><?= $u['id'] ?></td>
    <td><?= htmlspecialchars($u['nombre']) ?></td>
    <td><?= htmlspecialchars($u['correo']) ?></td>
    <td>
      <a href="editar.php?id=<?= $u['id'] ?>" class="btn-editar">Editar</a>
      <button class="btn-eliminar" onclick="confirmarEliminacion(<?= $u['id'] ?>)">Eliminar</button>
    </td>
  </tr>
  <?php endwhile; ?>
</table>

<script>
function confirmarEliminacion(id) {
  Swal.fire({
    title: '¿Estás seguro?',
    text: "¡Este usuario será eliminado permanentemente!",
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
