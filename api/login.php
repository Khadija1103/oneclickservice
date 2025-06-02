<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['mensaje' => 'Método no permitido']);
    exit;
}

require_once '../conexion.php';

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['correo'], $data['contraseña'])) {
    http_response_code(400);
    echo json_encode(['mensaje' => 'Faltan datos requeridos']);
    exit;
}

$correo = $data['correo'];
$contraseña = $data['contraseña'];

$query = "SELECT id, nombre, contraseña, rol FROM usuarios WHERE correo = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $correo);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $usuario = $result->fetch_assoc();

    // Si usas password_hash al registrar, deja esta línea:
    if (password_verify($contraseña, $usuario['contraseña'])) {

        http_response_code(200);
        echo json_encode([
            'mensaje' => 'Inicio de sesión exitoso',
            'usuario' => [
                'id' => $usuario['id'],
                'nombre' => $usuario['nombre'],
                'rol' => $usuario['rol'],
                'correo' => $correo
            ]
        ]);
    } else {
        http_response_code(401);
        echo json_encode(['mensaje' => 'Contraseña incorrecta']);
    }
} else {
    http_response_code(404);
    echo json_encode(['mensaje' => 'Usuario no encontrado']);
}

$stmt->close();
$conn->close();

