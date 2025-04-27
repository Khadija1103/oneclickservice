<?php
// conexion.php — conexión única a la base donde ya tienes tus tablas

$servidor   = "localhost";      // servidor MySQL
$usuario    = "root";           // usuario MySQL
$contrasena = "";               // contraseña MySQL (vacía por defecto en XAMPP)
$basedatos  = "crud_usuarios";  // <-- cambia aquí al nombre real de tu base

// Crear la conexión
$conn = new mysqli($servidor, $usuario, $contrasena, $basedatos);

// Verificar la conexión
if ($conn->connect_error) {
    die("🔌 Conexión fallida a la base de datos '{$basedatos}': " . $conn->connect_error);
}
// ¡Conexión exitosa!
?>
