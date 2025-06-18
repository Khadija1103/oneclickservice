<?php
// auth/olvide.php
require_once __DIR__ . '/../Controllers/RecuperarController.php';

$recuperar = new RecuperarController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $recuperar->enviarCorreoRecuperacion($_POST['correo']);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Recuperar Contraseña – One Click Service</title>
  <style>
    body { font-family: Arial; background-color: #f8f9fa; margin: 0; display: flex; justify-content: center; align-items: center; height: 100vh; }
    .form-container { background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); width: 100%; max-width: 400px; }
    h2 { text-align: center; color: #007bff; }
    label { display: block; margin-top: 15px; font-weight: bold; }
    input[type="email"] { width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 5px; }
    button { width: 100%; padding: 12px; background-color: #007bff; color: white; border: none; border-radius: 5px; margin-top: 20px; cursor: pointer; }
    button:hover { background-color: #0056b3; }
    .back { text-align: center; margin-top: 15px; }
    .back a { color: #007bff; text-decoration: none; }
    .back a:hover { text-decoration: underline; }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>Recuperar Contraseña</h2>
    <form method="POST" action="">
      <label for="correo">Correo electrónico:</label>
      <input type="email" id="correo" name="correo" required>

      <button type="submit">Enviar enlace</button>
    </form>
    <div class="back">
      <a href="login.php">← Volver al inicio de sesión</a>
    </div>
  </div>
</body>
</html>
