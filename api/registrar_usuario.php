<?php
header("Content-Type: application/json");

// Conexión a la base de datos
$host = "localhost";
$usuario = "root";
$contrasena = "";
$base_de_datos = "crud_usuarios";

$conn = new mysqli($host, $usuario, $contrasena, $base_de_datos);

if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["mensaje" => "❌ Error de conexión a la base de datos"]);
    exit;
}

// Leer datos JSON
$data = json_decode(file_get_contents("php://input"), true);

$nombre     = trim($data["nombre"] ?? '');
$correo     = trim($data["correo"] ?? '');
$telefono   = trim($data["telefono"] ?? '');
$rol        = trim($data["rol"] ?? '');
$contrasena = $data["contrasena"] ?? '';

// Validar campos obligatorios
if (!$nombre || !$correo || !$telefono || !$rol || !$contrasena) {
    http_response_code(400);
    echo json_encode(["mensaje" => "Todos los campos son obligatorios."]);
    exit;
}

// Validar formato de correo
if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(["mensaje" => "Correo electrónico no válido."]);
    exit;
}

// Validar si el correo ya existe
$stmt = $conn->prepare("SELECT id FROM usuarios WHERE correo = ?");
$stmt->bind_param("s", $correo);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows > 0) {
    http_response_code(409);
    echo json_encode(["mensaje" => "Ya existe un usuario con ese correo."]);
    $stmt->close();
    exit;
}
$stmt->close();

// Validar si el teléfono ya existe
$stmt = $conn->prepare("SELECT id FROM usuarios WHERE telefono = ?");
$stmt->bind_param("s", $telefono);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows > 0) {
    http_response_code(409);
    echo json_encode(["mensaje" => "Ya existe un usuario con ese teléfono."]);
    $stmt->close();
    exit;
}
$stmt->close();

// Insertar usuario
$hash = password_hash($contrasena, PASSWORD_DEFAULT);
$stmt = $conn->prepare("INSERT INTO usuarios (nombre, correo, telefono, rol, contraseña) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $nombre, $correo, $telefono, $rol, $hash);

if ($stmt->execute()) {
    http_response_code(201);
    echo json_encode(["mensaje" => "✅ Usuario registrado correctamente."]);
} else {
    http_response_code(500);
    echo json_encode([
        "mensaje" => "❌ Error al registrar el usuario.",
        "error" => $stmt->error
    ]);
}

$stmt->close();
$conn->close();
?>
