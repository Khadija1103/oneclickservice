<?php
header('Content-Type: application/json');

require_once '../conexion.php';

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(['mensaje' => 'Método no permitido']);
    exit;
}

if (!isset($_GET['id'])) {
    http_response_code(400);
    echo json_encode(['mensaje' => 'Falta el ID del servicio']);
    exit;
}

$id = intval($_GET['id']);

$query = "SELECT id, nombre_servicio, descripcion, precio, proveedor_id FROM servicios WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $servicio = $result->fetch_assoc();
    http_response_code(200);
    echo json_encode(['servicio' => $servicio]);
} else {
    http_response_code(404);
    echo json_encode(['mensaje' => 'Servicio no encontrado']);
}

$stmt->close();
$conn->close();
