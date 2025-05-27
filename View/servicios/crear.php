<?php
// View/servicios/crear.php
require_once __DIR__ . '/../../Controllers/ServiciosControllers.php';
$ctrl = new ServiciosControllers();
$ctrl->crearServicio();

// Para el select de proveedores:
require_once __DIR__ . '/../../conexion.php';
$prov = $conn->query("SELECT id, nombre FROM proveedores");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>Crear Servicio – One Click Service</title>
  <style>
    body{font-family:Arial;margin:0;background:#f4f6f8;display:flex;justify-content:center;align-items:center;height:100vh;}
    .form-container{background:#fff;padding:30px;border-radius:8px;box-shadow:0 2px 10px rgba(0,0,0,0.1);width:90%;max-width:500px;}
    h2{text-align:center;color:#007bff;margin-top:0;}
    label{display:block;margin-top:15px;font-weight:bold;}
    input,textarea,select{width:100%;padding:10px;margin-top:5px;border:1px solid #ccc;border-radius:4px;}
    button{background:#43a047;color:#fff;padding:10px;border:none;border-radius:4px;cursor:pointer;width:100%;margin-top:20px;}
    button:hover{background:#388e3c;}
    .back{text-align:center;margin-top:15px;}
    .back a{color:#007bff;text-decoration:none;}
    .back a:hover{text-decoration:underline;}
  </style>
</head>
<body>
  <div class="form-container">
    <h2>Crear Servicio</h2>
    <form method="POST" action="">
<<<<<<< HEAD
      <label>Nombre del servicio:</label>
      <input type="text" name="nombre_servicio" required>
      <label>Descripción:</label>
      <textarea name="descripcion" required></textarea>
      <label>Precio:</label>
      <input type="number" name="precio" step="0.01" required>
      <label>Proveedor:</label>
      <select name="proveedor_id" required>
        <?php while($p = $prov->fetch_assoc()): ?>
          <option value="<?=$p['id']?>"><?=htmlspecialchars($p['nombre'])?></option>
        <?php endwhile; ?>
      </select>
      <button type="submit">Guardar Servicio</button>
    </form>
    <div class="back"><a href="index.php">← Volver a Servicios</a></div>
  </div>
</body>
=======
  <!-- Nombre del Servicio -->
  <label for="nombre_servicio">Nombre del servicio:</label>
  <input 
    type="text" 
    id="nombre_servicio" 
    name="nombre_servicio" 
    required 
    maxlength="100"
    pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ0-9\s.,\-]{4,100}$"
    oninvalid="this.setCustomValidity('Debe contener entre 3 y 100 caracteres.')" 
    oninput="this.setCustomValidity('')" 
    title="Debe contener entre 3 y 100 caracteres.">
     <!-- DESCRIPCIÓN -->
<label for="descripcion">Descripción del servicio:</label>
<textarea 
  id="descripcion" 
  name="descripcion" 
  required 
  minlength="10" 
  maxlength="500" 
  pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ0-9\s\.,:;!¿?()\-]{10,500}$"
  title="La descripción debe tener entre 10 y 500 caracteres. Se permiten letras, números, espacios y signos básicos de puntuación.">
  <?= isset($data['descripcion']) ? htmlspecialchars($data['descripcion']) : '' ?>
</textarea>

      <!-- Precio -->
      <label for="precio">Precio (COP):</label>
      <input 
        type="number" 
        id="precio" 
        name="precio" 
        step="0.01" 
        min="0" 
        max="10000000" 
        required
        title="Ingresa un valor entre 0 y 10 millones.">


<!-- PROVEEDOR -->
<label for="proveedor_id">Proveedor:</label>
<select id="proveedor_id" name="proveedor_id" required>
  <option value="" disabled selected>Seleccione un proveedor</option>
  <?php while($p = $prov->fetch_assoc()): ?>
    <option value="<?= htmlspecialchars($p['id']) ?>">
      <?= htmlspecialchars($p['nombre']) ?>
    </option>
  <?php endwhile; ?>
</select>

      <button type="submit">Guardar Servicio</button>
    </form>

    <div class="back">
      <a href="index.php">← Volver a Servicios</a>
    </div>
  </div>
</body>

>>>>>>> main
</html>
