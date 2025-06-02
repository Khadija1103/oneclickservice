<?php
header('Content-Type: application/json');
require_once '../conexion.php';

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    // Listar servicios
    $query = "SELECT * FROM servicios";
    $result = $conn->query($query);
    $servicios = [];
    while ($row = $result->fetch_assoc()) {
        $servicios[] = $row;
    }
    echo json_encode($servicios);

} elseif ($method === 'POST') {
    // Crear servicio
    $data = json_decode(file_get_contents('php://input'), true);
    if (!isset($data['nombre'], $data['descripcion'], $data['precio'], $data['id_afiliado'])) {
        http_response_code(400);
        echo json_encode(['mensaje' => 'Faltan datos requeridos']);
        exit;
    }

    $nombre = $data['nombre'];
    $descripcion = $data['descripcion'];
    $precio = $data['precio'];
    $id_afiliado = $data['id_afiliado'];

    $stmt = $conn->prepare("INSERT INTO servicios (nombre, descripcion, precio, id_afiliado) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssdi", $nombre, $descripcion, $precio, $id_afiliado);
    if ($stmt->execute()) {
        http_response_code(201);
        echo json_encode(['mensaje' => 'Servicio creado']);
    } else {
        http_response_code(500);
        echo json_encode(['mensaje' => 'Error al crear servicio']);
    }
    $stmt->close();

} else {
    http_response_code(405);
    echo json_encode(['mensaje' => 'Método no permitido']);
}

$conn->close();
?>
