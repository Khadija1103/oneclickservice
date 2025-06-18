<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = "localhost";
$usuario = "root";
$contrasena = "";
$base_de_datos = "crud_usuarios";

$conn = new mysqli($host, $usuario, $contrasena, $base_de_datos);
if ($conn->connect_error) {
    die("❌ Error de conexión: " . $conn->connect_error);
}

$mensaje = "";

if (isset($_GET['token']) && !empty($_GET['token'])) {
    $token = $_GET['token'];

    $sql = "SELECT id, verificado FROM usuarios WHERE token_verificacion = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();

        if ($usuario['verificado']) {
            $mensaje = "<h2 style='color:orange'>⚠️ Tu cuenta ya estaba verificada.</h2>";
        } else {
            $sql_update = "UPDATE usuarios SET verificado = 1, token_verificacion = NULL WHERE id = ?";
            $stmt_update = $conn->prepare($sql_update);
            $stmt_update->bind_param("i", $usuario['id']);
            $stmt_update->execute();
            $stmt_update->close();

            $mensaje = "<h2 style='color:green'>✅ Cuenta verificada. Serás redirigido al login en 5 segundos...</h2>";
            $redirigir = true;
        }
    } else {
        $mensaje = "<h2 style='color:red'>❌ Token inválido o ya usado.</h2>";
    }

    $stmt->close();
    $conn->close();
} else {
    $mensaje = "<h2 style='color:red'>❌ No se proporcionó ningún token.</h2>";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Verificación</title>
    <?php if (!empty($redirigir)): ?>
        <script>
    setTimeout(function() {
        window.location.href = 'http://localhost/oneclickservice-master/auth/login.php';
    }, 5000);
</script>
 <?php endif; ?>
</head>
<body style="font-family: Arial; text-align:center; margin-top: 100px;">
    <?= $mensaje ?>
</body>
</html>

