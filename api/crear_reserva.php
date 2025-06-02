<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['mensaje' => 'Método no permitido']);
    exit;
}

require_once '../conexion.php';

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['usuario_id'], $data['servicio_id'], $data['fecha_reserva'], $data['estado'])) {
    http_response_code(400);
    echo json_encode(['mensaje' => 'Faltan datos requeridos']);
    exit;
}

$usuario_id = $data['usuario_id'];
$servicio_id = $data['servicio_id'];
$fecha_reserva = $data['fecha_reserva'];
$estado = $data['estado'];

$query = "INSERT INTO reservas (usuario_id, servicio_id, fecha_reserva, estado) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("iiss", $usuario_id, $servicio_id, $fecha_reserva, $estado);

if ($stmt->execute()) {
    http_response_code(201);
    echo json_encode(['mensaje' => 'Reserva creada exitosamente']);
} else {
    http_response_code(500);
    echo json_encode(['mensaje' => 'Error al crear la reserva']);
}

$stmt->close();
$conn->close();
?>
