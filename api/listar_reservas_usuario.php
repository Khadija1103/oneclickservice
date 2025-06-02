<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(['mensaje' => 'Método no permitido']);
    exit;
}

require_once '../conexion.php';

if (!isset($_GET['id'])) {
    http_response_code(400);
    echo json_encode(['mensaje' => 'Falta el ID del usuario']);
    exit;
}

$usuario_id = $_GET['id'];

$query = "SELECT r.id, r.fecha_reserva, r.estado, 
                 s.nombre_servicio, s.descripcion, s.precio 
          FROM reservas r
          INNER JOIN servicios s ON r.servicio_id = s.id
          WHERE r.usuario_id = ?";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();

$reservas = [];

while ($fila = $result->fetch_assoc()) {
    $reservas[] = $fila;
}

http_response_code(200);
echo json_encode([
    'mensaje' => 'Historial de reservas encontrado',
    'reservas' => $reservas
]);

$stmt->close();
$conn->close();
