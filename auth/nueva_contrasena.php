<?php
require_once __DIR__ . '/../conexion.php';

$token = $_GET['token'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['token'];
    $nueva = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);

    $sql = "UPDATE usuarios SET contrasena = ?, token_password = NULL WHERE token_password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $nueva, $token);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "✅ Contraseña actualizada. <a href='login.php'>Inicia sesión</a>";
    } else {
        echo "❌ Token inválido o expirado.";
    }
    exit;
}

// Verifica si token existe
$sql = "SELECT id FROM usuarios WHERE token_password = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $token);
$stmt->execute();
$result = $stmt->get_result();

if (!$result->num_rows) {
    echo "❌ Enlace inválido o expirado.";
    exit;
}
?>

<form method="POST">
  <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
  <h2>Nueva contraseña</h2>
  <input type="password" name="contrasena" placeholder="Nueva contraseña" required>
  <button type="submit">Cambiar contraseña</button>
</form>
