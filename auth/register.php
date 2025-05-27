<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registro - One Click Service</title>
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
      max-width: 800px;
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

    input, select {
      width: 100%;
      padding: 10px;
      border: 2px solid #ccc;
      border-radius: 5px;
      font-size: 16px;
    }

    input:focus, select:focus {
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
  </style>
</head>
<body>

<div class="container">
  <h2>Formulario de Registro</h2>
  <form id="registerForm" novalidate>
    
    <div class="form-group">
      <label for="nombre">Nombre completo</label>
      <input type="text" id="nombre" name="nombre">
      <div class="error-message" id="errorNombre">Por favor, ingresa un nombre válido (mínimo 3 letras).</div>
    </div>

    <div class="form-group">
      <label for="email">Correo electrónico</label>
      <input type="email" id="email" name="email">
      <div class="error-message" id="errorEmail">Correo electrónico inválido.</div>
    </div>

    <div class="form-group">
      <label for="telefono">Teléfono</label>
      <input type="text" id="telefono" name="telefono">
      <div class="error-message" id="errorTelefono">Número de teléfono inválido (mínimo 7 números).</div>
    </div>

    <div class="form-group">
      <label for="tipo">Tipo de usuario</label>
      <select id="tipo" name="tipo">
        <option value="">Seleccione una opción</option>
        <option value="usuario">Usuario</option>
        <option value="proveedor">Proveedor</option>
      </select>
      <div class="error-message" id="errorTipo">Debes seleccionar un tipo de usuario.</div>
    </div>

    <div class="form-group">
      <label for="password">Contraseña</label>
      <input type="password" id="password" name="password">
      <div class="error-message" id="errorPassword">
        La contraseña debe tener entre 8 y 12 caracteres, incluir mayúscula, minúscula, número y símbolo.
      </div>
    </div>

    <button type="submit" class="btn">Registrarse</button>
  </form>
</div>

<script>
  const form = document.getElementById('registerForm');

  const campos = {
    nombre: {
      input: document.getElementById('nombre'),
      error: document.getElementById('errorNombre'),
      validar: value => /^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,}$/.test(value)
    },
    email: {
      input: document.getElementById('email'),
      error: document.getElementById('errorEmail'),
      validar: value => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)
    },
    telefono: {
      input: document.getElementById('telefono'),
      error: document.getElementById('errorTelefono'),
      validar: value => /^[0-9]{7,15}$/.test(value)
    },
    tipo: {
      input: document.getElementById('tipo'),
      error: document.getElementById('errorTipo'),
      validar: value => value !== ''
    },
    password: {
      input: document.getElementById('password'),
      error: document.getElementById('errorPassword'),
      validar: value => /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,12}$/.test(value)
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
    e.preventDefault();

    let valido = true;

    Object.values(campos).forEach(({ input, error, validar }) => {
      const valor = input.value.trim();
      if (!validar(valor)) {
        input.classList.remove('valid');
        input.classList.add('error');
        error.style.display = 'block';
        valido = false;
      }
    });

    if (valido) {
      alert("Formulario válido ✅ (Aquí se puede enviar al servidor)");
      // Aquí puedes hacer el fetch o submit con PHP
    }
  });
</script>

</body>
</html>






