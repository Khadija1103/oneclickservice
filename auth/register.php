<?php
// Conexión a la base de datos
require_once '../conexion.php';

$errores = [];
$exito = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST["nombre"]);
    $correo = trim($_POST["correo"]);
    $telefono = trim($_POST["telefono"]);
    $tipo_usuario = $_POST["tipo_usuario"];
    $contrasena = $_POST["contrasena"];

    // Validaciones del formulario
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

    // Si todo está correcto, se inserta en la base de datos
    if (empty($errores)) {
        $hash = password_hash($contrasena, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO usuarios (nombre, correo, telefono, rol, contraseña) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $nombre, $correo, $telefono, $tipo_usuario, $hash);

        if ($stmt->execute()) {
            $exito = true;
            header("Location: login.php"); // Redirige al login
            exit;
        } else {
            $errores['general'] = "Error al registrar. Intenta de nuevo.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registro de Usuario</title>

  <!-- Carga de CSS externo (asegúrate que esta ruta sea correcta) -->
  <link rel="stylesheet" href="../assets/styles.css">

  <!-- Estilos básicos en caso de que no tengas styles.css -->
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f4f4;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      margin: 0;
    }
    .form-container {
      background: #fff;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      width: 90%;
      max-width: 500px;
    }
    input, select {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    input[type="submit"] {
      background: #007bff;
      color: #fff;
      border: none;
      padding: 12px;
      margin-top: 20px;
      cursor: pointer;
    }
    input[type="submit"]:hover {
      background: #0056b3;
    }
    .error { color: red; font-size: 0.9em; margin-top: 5px; }
    .success { color: green; font-weight: bold; }
    h1 { text-align: center; color: #007bff; }
    .back-link { text-align: center; margin-top: 15px; }
  </style>
</head>

<body>
  <div class="form-container">
    <h1>Formulario de Registro</h1>

    <?php if (!empty($errores['general'])): ?>
      <p class="error"><?= $errores['general'] ?></p>
    <?php endif; ?>

    <form method="POST" action="">
      <!-- Nombre -->
      <label>Nombre completo:</label>
      <input type="text" name="nombre" value="<?= $_POST['nombre'] ?? '' ?>" required pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]{3,}" title="Mínimo 3 letras. Solo letras y espacios.">
      <?php if (isset($errores['nombre'])) echo "<div class='error'>{$errores['nombre']}</div>"; ?>

      <!-- Correo -->
      <label>Correo electrónico:</label>
      <input type="email" name="correo" value="<?= $_POST['correo'] ?? '' ?>" required>
      <?php if (isset($errores['correo'])) echo "<div class='error'>{$errores['correo']}</div>"; ?>

      <!-- Teléfono -->
      <label>Teléfono:</label>
      <input type="text" name="telefono" value="<?= $_POST['telefono'] ?? '' ?>" required pattern="[0-9]{7,15}" title="Solo números. Mínimo 7 y máximo 15 dígitos.">
      <?php if (isset($errores['telefono'])) echo "<div class='error'>{$errores['telefono']}</div>"; ?>

      <!-- Tipo de Usuario -->
      <label>Tipo de usuario:</label>
      <select name="tipo_usuario" required>
        <option value="">Seleccione...</option>
        <option value="Administrador" <?= ($_POST['tipo_usuario'] ?? '') == "Administrador" ? 'selected' : '' ?>>Administrador</option>
        <option value="Proveedor" <?= ($_POST['tipo_usuario'] ?? '') == "Proveedor" ? 'selected' : '' ?>>Proveedor</option>
        <option value="Cliente" <?= ($_POST['tipo_usuario'] ?? '') == "Cliente" ? 'selected' : '' ?>>Cliente</option>
      </select>
      <?php if (isset($errores['tipo_usuario'])) echo "<div class='error'>{$errores['tipo_usuario']}</div>"; ?>

      <!-- Contraseña -->
      <label>Contraseña:</label>
      <input type="password" name="contrasena" required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$" title="Debe tener al menos 8 caracteres, una mayúscula, una minúscula, un número y un símbolo.">
      <?php if (isset($errores['contrasena'])) echo "<div class='error'>{$errores['contrasena']}</div>"; ?>

      <!-- Botón -->
      <input type="submit" value="Registrarse">
    </form>

    <!-- Enlace al inicio -->
    <div class="back-link">
      <a href="http://localhost/oneclickservice-master/main.php">← Volver al inicio</a>
    </div>
  </div>
</body>
</html>





