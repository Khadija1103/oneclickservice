<?php
header('Content-Type: application/json');

// Solo aceptar método POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['mensaje' => 'Método no permitido']);
    exit;
}

// Conexión a base de datos
require_once '../conexion.php';

// Leer datos JSON enviados
$data = json_decode(file_get_contents("php://input"), true);

// Verificar que recibimos todos los datos necesarios
if (!isset($data['nombre'], $data['correo'], $data['contraseña'], $data['rol'])) {
    http_response_code(400);
    echo json_encode(['mensaje' => 'Faltan datos requeridos']);
    exit;
}

$nombre = $data['nombre'];
$correo = $data['correo'];
$contraseña = password_hash($data['contraseña'], PASSWORD_BCRYPT); // Encriptar contraseña
$rol = $data['rol'];

try {
    $query = "INSERT INTO usuarios (nombre, correo, contraseña, rol) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssss", $nombre, $correo, $contraseña, $rol);

    if ($stmt->execute()) {
        http_response_code(201);
        echo json_encode(['mensaje' => 'Usuario registrado con éxito']);
    } else {
        http_response_code(500);
        echo json_encode(['mensaje' => 'Error al registrar usuario']);
    }

    $stmt->close();
    $conn->close();

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['mensaje' => 'Error en el servidor', 'error' => $e->getMessage()]);
}
