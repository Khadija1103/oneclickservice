<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['mensaje' => 'Método no permitido']);
    exit;
}

require_once '../conexion.php';

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['nombre_servicio'], $data['descripcion'], $data['precio'], $data['proveedor_id'])) {
    http_response_code(400);
    echo json_encode(['mensaje' => 'Faltan datos requeridos']);
    exit;
}

$nombre = $data['nombre_servicio'];
$descripcion = $data['descripcion'];
$precio = $data['precio'];
$proveedor_id = $data['proveedor_id'];

$query = "INSERT INTO servicios (nombre_servicio, descripcion, precio, proveedor_id) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("ssdi", $nombre, $descripcion, $precio, $proveedor_id);

if ($stmt->execute()) {
    http_response_code(201);
    echo json_encode(['mensaje' => 'Servicio creado exitosamente']);
} else {
    http_response_code(500);
    echo json_encode(['mensaje' => 'Error al crear el servicio']);
}

$stmt->close();
$conn->close();
