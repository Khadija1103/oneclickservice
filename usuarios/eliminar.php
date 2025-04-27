<?php
include '../conexion.php';

if (!isset($_GET['id'])) {
    echo "ID de usuario no especificado.";
    exit();
}

$id = $_GET['id'];

$sql = "DELETE FROM usuarios WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    header("Location: index.php");
    exit();
} else {
    echo "Error al eliminar: " . $conn->error;
}
?>
