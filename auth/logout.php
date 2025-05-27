<?php
require_once '../conexion.php';
session_start();

$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = $_POST['correo'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM usuarios WHERE correo = '$correo'";
    $resultado = $conn->query($sql);

    if ($resultado && $resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();
        if (password_verify($password, $usuario['password'])) {
            $_SESSION['user_id'] = $usuario['id'];
            $_SESSION['nombre'] = $usuario['nombre'];
            $_SESSION['tipo'] = $usuario['tipo_usuario'];

            if ($usuario['tipo_usuario'] === 'proveedor') {
                header('Location: ../dashboard/proveedor.php');
            } else {
                header('Location: ../dashboard/usuario.php');
            }
            exit;
        } else {
            $mensaje = '❌ Contraseña incorrecta.';
        }
    } else {
        $mensaje = '❌ Usuario no encontrado.';
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Iniciar Sesión - One Click Service</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }

    .container {
      background: white;
      padding: 40px;
      border-radius: 10px;
      width: 100%;
      max-width: 500px;
      box-shadow: 0 0 10px rgba(0,0,0,0.2);
    }

    h2 {
      text-align: center;
      color: #007BFF;
    }

    .form-group {
      margin-bottom: 20px;
      position: relative;
    }

    label {
      display: block;
      font-weight: bold;
      margin-bottom: 5px;
    }

    input {
      width: 100%;
      padding: 10px;
      border: 2px solid #ccc;
      border-radius: 5px;
      font-size: 16px;
    }

    input:focus {
      outline: none;
    }

    .error {
      border-color: red !important;
    }

    .valid {
      border-color: green !important;
    }

    .error-message {
      color: red;
      font-size: 13px;
      position: absolute;
      bottom: -18px;
      left: 0;
      display: none;
    }

    .btn {
      background-color: #007BFF;
      color: white;
      padding: 12px;
      width: 100%;
      border: none;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer;
    }

    .btn:hover {
      background-color: #0056b3;
    }

    .link {
      text-align: center;
      margin-top: 15px;
    }

    .alert {
      color: red;
      text-align: center;
      margin-bottom: 15px;
    }
  </style>
</head>
<body>

<div class="container">
  <h2>Iniciar Sesión</h2>
  <?php if ($mensaje): ?>
    <div class="alert"><?= $mensaje ?></div>
  <?php endif; ?>
  <form id="loginForm" method="post" novalidate>
    <div class="form-group">
      <label for="correo">Correo electrónico</label>
      <input type="email" id="correo" name="correo">
      <div class="error-message" id="errorCorreo">Correo electrónico inválido.</div>
    </div>

    <div class="form-group">
      <label for="password">Contraseña</label>
      <input type="password" id="password" name="password">
      <div class="error-message" id="errorPassword">La contraseña debe tener al menos 8 caracteres.</div>
    </div>

    <button type="submit" class="btn">Ingresar</button>

    <div class="link">
      <p><a href="recuperar.php">¿Olvidaste tu contraseña?</a></p>
      <p>¿No tienes cuenta? <a href="registro.php">Regístrate aquí</a></p>
    </div>
  </form>
</div>

<script>
  const form = document.getElementById('loginForm');

  const campos = {
    correo: {
      input: document.getElementById('correo'),
      error: document.getElementById('errorCorreo'),
      validar: value => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)
    },
    password: {
      input: document.getElementById('password'),
      error: document.getElementById('errorPassword'),
      validar: value => value.length >= 8
    }
  };

  Object.values(campos).forEach(({ input, error, validar }) => {
    input.addEventListener('input', () => {
      const valor = input.value.trim();
      if (validar(valor)) {
        input.classList.remove('error');
        input.classList.add('valid');
        error.style.display = 'none';
      } else {
        input.classList.remove('valid');
        input.classList.add('error');
        error.style.display = 'block';
      }
    });
  });

  form.addEventListener('submit', function (e) {
    let valido = true;

    Object.values(campos).forEach(({ input, error, validar }) => {
      const valor = input.value.trim();
      if (!validar(valor)) {
        input.classList.add('error');
        error.style.display = 'block';
        valido = false;
      } else {
        input.classList.remove('error');
        input.classList.add('valid');
        error.style.display = 'none';
      }
    });

    if (!valido) {
      e.preventDefault(); // Evita el envío si no es válido
    }
  });
</script>

</body>
</html>
