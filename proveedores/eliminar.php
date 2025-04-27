<?php
include '../conexion.php';
if (!isset($_GET['id'])) exit("ID no especificado.");
$id = $_GET['id'];
$conn->query("DELETE FROM proveedores WHERE id=$id");
header("Location: index.php");
exit;
?>
