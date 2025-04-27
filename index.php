<?php
// oneclickservice/index.php
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>One Click Service</title>
  <style>
    /* Reset básico */
    * { margin:0; padding:0; box-sizing:border-box; }
    body { font-family: Arial, sans-serif; background:#f4f6f8; color:#333; }
    a { text-decoration:none; color:inherit; }
    /* Header y Footer */
    header, footer { background:#1e88e5; color:#fff; text-align:center; padding:20px; }
    header h1, footer p { margin:0; }
    /* Navbar */
    nav { background:#007bff; }
    nav ul { display:flex; flex-wrap:wrap; justify-content:center; list-style:none; }
    nav li { margin:5px; }
    nav a { display:block; padding:10px 15px; color:#fff; border-radius:4px; transition:background-color .3s; }
    nav a:hover { background:#0056b3; }
    /* Carousel */
    .carousel { position:relative; overflow:hidden; max-width:1000px; margin:40px auto; border-radius:8px; }
    .carousel img { width:100%; height:400px; object-fit:cover; display:none; }
    .carousel img.active { display:block; }
    /* Cuadros inferiores */
    .features { display:grid; grid-template-columns:repeat(auto-fit,minmax(200px,1fr)); gap:20px; max-width:1000px; margin:40px auto; }
    .feature { background:#fff; padding:20px; border-radius:8px; box-shadow:0 2px 6px rgba(0,0,0,0.1); text-align:center; }
    .feature h3 { margin-bottom:10px; color:#1e88e5; }
  </style>
</head>
<body>

<header>
  <h1>One Click Service</h1>
</header>

<nav>
  <ul>
    <li><a href="index.php">Inicio</a></li>
    <li><a href="usuarios/index.php">Registro</a></li>
    <li><a href="proveedores/index.php">Proveedores</a></li>
    <li><a href="reservas/index.php">Reservas</a></li>
    <li><a href="servicios/index.php">Servicios</a></li>
    <li><a href="contactos.php">Contactos</a></li>
    <li><a href="mision.php">Misión</a></li>
    <li><a href="nosotros.php">Nosotros</a></li>
  </ul>
</nav>

<main>
  <!-- Carousel -->
  <div class="carousel" id="carousel">
    <img src="https://images.unsplash.com/photo-1567568304-05152e079a96?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w0NzQ2NzN8MHx8Y2xhc3N8MXx8fHx8fHwxNjkwOTg5MjMw&ixlib=rb-1.2.1&q=80&w=1080" class="active" alt="Familia feliz 1">
    <img src="https://images.unsplash.com/photo-1562431552-e8f453c0a1fa?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w0NzQ2NzN8MHx8Y2xhc3N8Mnx8fHx8fHwxNjkwOTg5MjMw&ixlib=rb-1.2.1&q=80&w=1080" alt="Familia feliz 2">
    <img src="https://images.unsplash.com/photo-1597434727279-e7dbdb502d1c?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w0NzQ2NzN8MHx8Y2xhc3N8M3x8fHx8fHwxNjkwOTg5MjMw&ixlib=rb-1.2.1&q=80&w=1080" alt="Familia feliz 3">
  </div>

  <!-- Cuadros inferiores -->
  <section class="features">
    <div class="feature">
      <h3>Proveedor del Mes</h3>
      <p>Reconociendo al mejor proveedor por su excelencia.</p>
    </div>
    <div class="feature">
      <h3>Ofertas Especiales</h3>
      <p>Descubre descuentos y promociones exclusivas.</p>
    </div>
    <div class="feature">
      <h3>Novedades</h3>
      <p>Últimas noticias y actualizaciones del servicio.</p>
    </div>
    <div class="feature">
      <h3>Testimonios</h3>
      <p>Lo que dicen nuestros clientes sobre nosotros.</p>
    </div>
  </section>
</main>

<footer>
  <p>© <?= date('Y') ?> One Click Service. Todos los derechos reservados.</p>
</footer>

<script>
// Carousel automático
let idx = 0;
const slides = document.querySelectorAll('#carousel img');
setInterval(() => {
  slides[idx].classList.remove('active');
  idx = (idx + 1) % slides.length;
  slides[idx].classList.add('active');
}, 4000);
</script>

</body>
</html>
