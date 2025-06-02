<?php
header('Content-Type: application/json');
require_once '../conexion.php';

$query = "SELECT id, nombre_servicio, descripcion, precio, proveedor_id FROM servicios";
$result = $conn->query($query);

$servicios = [];

if ($result->num_rows > 0) {
    while ($fila = $result->fetch_assoc()) {
        $servicios[] = $fila;
    }
    http_response_code(200);
    echo json_encode(['mensaje' => 'Servicios encontrados', 'servicios' => $servicios]);
} else {
    http_response_code(404);
    echo json_encode(['mensaje' => 'No hay servicios registrados']);
}

$conn->close();
