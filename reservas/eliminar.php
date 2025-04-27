<?php
include '../conexion.php';

// Si no viene ID, volvemos
if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = (int) $_GET['id'];

// Ejecutar eliminación
if ($conn->query("DELETE FROM reservas WHERE id = $id") !== TRUE) {
    die("Error al eliminar reserva: " . $conn->error);
}

// Redirigir al listado
header('Location: index.php');
exit;
?>
