<?php
include '../conexion.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $conn->query("DELETE FROM servicios WHERE id=$id");
}
header('Location: index.php');
exit;
?>
