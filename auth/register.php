<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Conexión a la base de datos
$host = "localhost";
$usuario = "root";
$contrasena = "";
$base_de_datos = "crud_usuarios";

$conn = new mysqli($host, $usuario, $contrasena, $base_de_datos);
if ($conn->connect_error) {
    die("❌ Error de conexión: " . $conn->connect_error);
}

// Incluir archivo de correo
require_once '../correo.php';

$errores = [];
$exito = false;

// Inicializar variables vacías
$nombre = $correo = $telefono = $tipo_usuario = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST["nombre"]);
    $correo = trim($_POST["correo"]);
    $telefono = trim($_POST["telefono"]);
    $tipo_usuario = $_POST["tipo_usuario"];
    $contrasena = $_POST["contrasena"];

    // Validaciones
    if (!preg_match("/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]{3,}$/", $nombre)) {
        $errores['nombre'] = "El nombre debe tener al menos 3 letras.";
    }

    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $errores['correo'] = "Correo inválido.";
    }

    if (!preg_match("/^[0-9]{7,15}$/", $telefono)) {
        $errores['telefono'] = "Teléfono inválido.";
    }

    if (!in_array($tipo_usuario, ['Administrador', 'Proveedor', 'Cliente'])) {
        $errores['tipo_usuario'] = "Seleccione un tipo válido.";
    }

    if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/', $contrasena)) {
        $errores['contrasena'] = "Contraseña débil (mínimo 8 caracteres, mayúscula, minúscula, número y símbolo).";
    }

    // Verificar si el correo ya existe
    if (empty($errores)) {
        $stmt = $conn->prepare("SELECT id FROM usuarios WHERE correo = ?");
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $errores['correo'] = "Este correo ya está registrado.";
        }
        $stmt->close();
    }

    // Verificar si el teléfono ya existe
    if (empty($errores)) {
        $stmt = $conn->prepare("SELECT id FROM usuarios WHERE telefono = ?");
        $stmt->bind_param("s", $telefono);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $errores['telefono'] = "Este teléfono ya está registrado.";
        }
        $stmt->close();
    }

    // Insertar si no hay errores
    if (empty($errores)) {
        $hash = password_hash($contrasena, PASSWORD_DEFAULT);
        $token = bin2hex(random_bytes(32));
        $verificado = 0;

        $stmt = $conn->prepare("INSERT INTO usuarios (nombre, correo, telefono, rol, contraseña, token_verificacion, verificado) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssi", $nombre, $correo, $telefono, $tipo_usuario, $hash, $token, $verificado);

        if ($stmt->execute()) {
            // Enviar correo
            $asunto = "Verifica tu cuenta en ONE CLICK SERVICE";
            $mensaje = "Hola $nombre,\n\nPor favor verifica tu cuenta haciendo clic en este enlace:\n";
            $mensaje .= "http://localhost/oneclickservice-master/verificar.php?token=$token\n\n";
            $mensaje .= "Gracias por registrarte.";
            if (enviarCorreo($correo, $asunto, $mensaje)) {
                echo "<p style='color:green'>✅ Registro exitoso. Revisa tu correo para verificar la cuenta.</p>";
                $exito = true;
            } else {
                echo "<p style='color:red;'>❌ No se pudo enviar el correo. Revisa los datos del servidor SMTP o la contraseña de aplicación.</p>";
            }
            
        } else {
            $errores['general'] = "❌ Error al registrar: " . $stmt->error;
        }

        $stmt->close();
    }
}
?>

<!-- Formulario HTML -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro - ONE CLICK SERVICE</title>
    <link rel="stylesheet" href="../assets/styles.css">
    <style>
        body {
            background: #f0f2f5;
            font-family: Arial;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-container {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            width: 400px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        input, select {
            width: 100%;
            padding: 8px;
            margin-bottom: 5px;
            border: 2px solid #ccc;
            border-radius: 4px;
        }
        input.valid {
            border-color: green;
        }
        input.invalid {
            border-color: red;
        }
        .error {
            color: red;
            font-size: 0.9em;
            margin-bottom: 10px;
        }
        .success {
            color: green;
        }
    </style>
</head>
<body>
<div class="form-container">
    <h2>Registro de Usuario</h2>

    <?php if (!$exito && !empty($errores['general'])): ?>
        <p class="error"><?= $errores['general'] ?></p>
    <?php endif; ?>

    <form method="POST" action="" autocomplete="off">
        <label for="nombre">Nombre completo:</label>
        <input type="text" name="nombre" id="nombre"
            value="<?= htmlspecialchars($nombre) ?>"
            class="<?= isset($errores['nombre']) ? 'invalid' : ($nombre !== '' ? 'valid' : '') ?>">
        <?php if (!empty($errores['nombre'])) echo '<p class="error">' . $errores['nombre'] . '</p>'; ?>

        <label for="correo">Correo:</label>
        <input type="email" name="correo" id="correo"
            value="<?= htmlspecialchars($correo) ?>"
            class="<?= isset($errores['correo']) ? 'invalid' : ($correo !== '' ? 'valid' : '') ?>">
        <?php if (!empty($errores['correo'])) echo '<p class="error">' . $errores['correo'] . '</p>'; ?>

        <label for="telefono">Teléfono:</label>
        <input type="text" name="telefono" id="telefono"
            value="<?= htmlspecialchars($telefono) ?>"
            class="<?= isset($errores['telefono']) ? 'invalid' : ($telefono !== '' ? 'valid' : '') ?>">
        <?php if (!empty($errores['telefono'])) echo '<p class="error">' . $errores['telefono'] . '</p>'; ?>

        <label for="tipo_usuario">Rol:</label>
        <select name="tipo_usuario" id="tipo_usuario"
            class="<?= isset($errores['tipo_usuario']) ? 'invalid' : ($tipo_usuario !== '' ? 'valid' : '') ?>">
            <option value="">-- Selecciona --</option>
            <option value="Administrador" <?= $tipo_usuario == 'Administrador' ? 'selected' : '' ?>>Administrador</option>
            <option value="Proveedor" <?= $tipo_usuario == 'Proveedor' ? 'selected' : '' ?>>Proveedor</option>
            <option value="Cliente" <?= $tipo_usuario == 'Cliente' ? 'selected' : '' ?>>Cliente</option>
        </select>
        <?php if (!empty($errores['tipo_usuario'])) echo '<p class="error">' . $errores['tipo_usuario'] . '</p>'; ?>

        <label for="contrasena">Contraseña:</label>
        <input type="password" name="contrasena" id="contrasena"
            class="<?= isset($errores['contrasena']) ? 'invalid' : '' ?>" autocomplete="new-password">
        <?php if (!empty($errores['contrasena'])) echo '<p class="error">' . $errores['contrasena'] . '</p>'; ?>

        <input type="submit" value="Registrarse">
    </form>

    <p style="text-align:center;">
        <a href="login.php">¿Ya tienes cuenta? Inicia sesión</a><br>
        <a href="http://localhost/oneclickservice-master/main.php">← Volver al inicio</a>
    </p>
</div>
</body>
</html>