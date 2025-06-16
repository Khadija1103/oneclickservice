<?php 
// Conexión a la base de datos
$host = "localhost";
$usuario = "root";
$contrasena = "";
$base_de_datos = "crud_usuarios";

$conn = new mysqli($host, $usuario, $contrasena, $base_de_datos);

if ($conn->connect_error) {
    die("❌ Error de conexión: " . $conn->connect_error);
}

$errores = [];
$exito = false;

// Inicializar variables para mostrar campos vacíos si no hay POST
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
        $stmt = $conn->prepare("INSERT INTO usuarios (nombre, correo, telefono, rol, contraseña) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $nombre, $correo, $telefono, $tipo_usuario, $hash);
        if ($stmt->execute()) {
            header("Location: login.php");
            exit;
        } else {
            $errores['general'] = "❌ Error al registrar: " . $stmt->error;
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Usuario</title>
    <style>
        body {
            font-family: Arial;
            background: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-container {
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 10px #ccc;
            width: 100%;
            max-width: 500px;
        }
        h1 { text-align: center; color: #007bff; }
        label { font-weight: bold; margin-top: 10px; display: block; }
        input, select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        input[type="submit"] {
            background: #007bff;
            color: white;
            cursor: pointer;
            margin-top: 20px;
        }
        input[type="submit"]:hover {
            background: #0056b3;
        }
        .error {
            color: red;
            font-size: 0.9em;
        }
        .back-link {
            text-align: center;
            margin-top: 15px;
        }
    </style>
</head>
<body>
<div class="form-container">
    <h1>Registro de Usuario</h1>

    <?php if (!empty($errores['general'])): ?>
        <p class="error"><?= $errores['general'] ?></p>
    <?php endif; ?>

    <form method="POST" autocomplete="off">
        <label>Nombre completo:</label>
        <input type="text" name="nombre" value="<?= htmlspecialchars($nombre) ?>" required>

        <?= isset($errores['nombre']) ? "<div class='error'>{$errores['nombre']}</div>" : '' ?>

        <label>Correo electrónico:</label>
        <input type="email" name="correo" value="<?= htmlspecialchars($correo) ?>" required>
        <?= isset($errores['correo']) ? "<div class='error'>{$errores['correo']}</div>" : '' ?>

        <label>Teléfono:</label>
        <input type="text" name="telefono" value="<?= htmlspecialchars($telefono) ?>" autocomplete="off" required>
        <?= isset($errores['telefono']) ? "<div class='error'>{$errores['telefono']}</div>" : '' ?>

        <label>Tipo de usuario:</label>
        <select name="tipo_usuario" required>
            <option value="">Seleccione...</option>
            <option value="Administrador" <?= $tipo_usuario == "Administrador" ? 'selected' : '' ?>>Administrador</option>
            <option value="Proveedor" <?= $tipo_usuario == "Proveedor" ? 'selected' : '' ?>>Proveedor</option>
            <option value="Cliente" <?= $tipo_usuario == "Cliente" ? 'selected' : '' ?>>Cliente</option>
        </select>
        <?= isset($errores['tipo_usuario']) ? "<div class='error'>{$errores['tipo_usuario']}</div>" : '' ?>

        <label>Contraseña:</label>
        <input type="password" name="contrasena" autocomplete="new-password" required>
        <?= isset($errores['contrasena']) ? "<div class='error'>{$errores['contrasena']}</div>" : '' ?>

        <input type="submit" value="Registrarse">
    </form>

    <div class="back-link">
        <a href="../main.php">← Volver al inicio</a>
    </div>
</div>
</body>
</html>
