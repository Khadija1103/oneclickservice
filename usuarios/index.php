<?php
include '../conexion.php';

$sql = "SELECT * FROM usuarios";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Usuarios – One Click Service</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 30px;
            background-color: #f7f7f7;
        }

        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        .crear-btn {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            display: block;
            width: 200px;
            margin: 20px auto;
            text-align: center;
        }

        .crear-btn:hover {
            background-color: #218838;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        th, td {
            border: 1px solid #ccc;
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #00a884;
            color: white;
            font-weight: bold;
        }

        td {
            background-color: #f9f9f9;
        }

        a {
            color: #007bff;
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        a:hover {
            background-color: #007bff;
            color: white;
        }

        .btn-editar {
            background-color: #007bff;
            color: white;
            padding: 6px 12px;
            border-radius: 5px;
            text-decoration: none;
        }

        .btn-editar:hover {
            background-color: #0056b3;
        }

        .btn-eliminar {
            background-color: #dc3545;
            color: white;
            padding: 6px 12px;
            border-radius: 5px;
            text-decoration: none;
        }

        .btn-eliminar:hover {
            background-color: #c82333;
        }

        /* Estilos del navbar */
        .navbar {
            background-color: #007bff;
            padding: 10px 20px;
            color: white;
            text-align: center;
            border-radius: 5px;
            margin-bottom: 30px;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            font-weight: bold;
        }

        .navbar a:hover {
            background-color: #0056b3;
            border-radius: 5px;
        }

        /* Encabezado */
        .encabezado {
            text-align: center;
            background-color: #007bff;
            color: white;
            padding: 20px;
            margin-bottom: 30px;
            border-radius: 5px;
        }

        .encabezado h1 {
            margin: 0;
        }

        /* Pie de página */
        .pie-de-pagina {
            text-align: center;
            background-color: #333;
            color: white;
            padding: 15px;
            margin-top: 30px;
            border-radius: 5px;
        }
    </style>

    <!-- Agregar SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

    <!-- Encabezado -->
    <div class="encabezado">
        <h1>One Click Service</h1>
        <p>Plataforma de servicios a tu alcance</p>
    </div>

    <!-- Navbar -->
    <div class="navbar">
        <a href="http://localhost/oneclickservice/index.php">Inicio</a>
        <a href="http://localhost/oneclickservice/reservas/index.php">Reservas</a>
        <a href="http://localhost/oneclickservice/proveedores/index.php">Proveedores</a>
        <a href="http://localhost/oneclickservice/servicios/index.php">Servicios</a>
        <a href="http://localhost/oneclickservice/Coontactos/index.php">Contactos</a>
    </div>

    <h1>Lista de Usuarios</h1>
    <a class="crear-btn" href="crear.php">+ Crear Usuario</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Acciones</th>
        </tr>

        <?php while($fila = $resultado->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $fila['id']; ?></td>
            <td><?php echo htmlspecialchars($fila['nombre']); ?></td>
            <td><?php echo htmlspecialchars($fila['correo']); ?></td>
            <td>
                <a href="editar.php?id=<?php echo $fila['id']; ?>" class="btn-editar">Editar</a> |
                <a href="javascript:void(0);" class="btn-eliminar" onclick="confirmarEliminacion(<?php echo $fila['id']; ?>)">Eliminar</a>
            </td>
        </tr>
        <?php } ?>
    </table>

    <script>
        function confirmarEliminacion(id) {
            // Usar SweetAlert2 para mostrar el cuadro de confirmación
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
                    // Si el usuario confirma, redirigir a la página de eliminación
                    window.location.href = 'eliminar.php?id=' + id;
                }
            });
        }
    </script>

    <!-- Pie de página -->
    <div class="pie-de-pagina">
        <p>&copy; 2025 One Click Service | Todos los derechos reservados.</p>
    </div>

</body>
</html>

