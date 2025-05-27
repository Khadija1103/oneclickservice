<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>One Click Service - Inicio</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f4f4;
      margin: 0;
      padding: 0 20px 40px 20px;
      color: #333;
    }

    /* Mensaje bienvenida separado */
    .welcome-message {
      text-align: center;
      margin: 40px 0 30px 0;
      color: #007bff;
    }
    .welcome-message h1 {
      margin-bottom: 10px;
      font-size: 2.5rem;
    }
    .welcome-message p {
      font-size: 1.25rem;
      font-weight: 500;
    }

    /* Navbar centrado con enlaces */
    .navbar {
      display: flex;
      justify-content: center;
      gap: 40px;
      margin-bottom: 40px;
      background: #007bff;
      padding: 15px 0;
      border-radius: 8px;
      box-shadow: 0 2px 6px rgb(0 0 0 / 0.1);
    }
    .navbar a {
      color:rgb(240, 241, 243);
      text-decoration: none;
      font-weight: 600;
      font-size: 1.1rem;
      transition: color 0.3s ease;
    }
    .navbar a:hover {
      text-decoration: underline;
      color:rgb(139, 182, 228);
    }

    /* Carrusel */
    .carousel {
      max-width: 900px;
      margin: 0 auto 50px auto;
      position: relative;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgb(0 0 0 / 0.15);
      overflow: hidden;
    }
    .carousel img {
      width: 100%;
      display: none;
      border-radius: 12px;
      transition: opacity 1s ease;
      position: absolute;
      top: 0;
      left: 0;
      opacity: 0;
    }
    .carousel img.active {
      display: block;
      opacity: 1;
      position: relative;
    }
    .carousel-indicators {
      position: absolute;
      bottom: 15px;
      width: 100%;
      text-align: center;
    }
    .carousel-indicators span {
      cursor: pointer;
      height: 12px;
      width: 12px;
      margin: 0 5px;
      background-color: #bbb;
      border-radius: 50%;
      display: inline-block;
      transition: background-color 0.3s ease;
    }
    .carousel-indicators span.active {
      background-color: #007bff;
    }

    /* Sección corporación BÁRAKA */
    .corporacion-section {
      max-width: 900px;
      margin: 0 auto 50px auto;
      background: white;
      padding: 25px;
      border-radius: 12px;
      box-shadow: 0 3px 10px rgb(0 0 0 / 0.1);
      display: flex;
      gap: 40px;
      align-items: center;
      flex-wrap: wrap;
    }
    .corporacion-logos {
      flex: 1 1 150px;
      display: flex;
      flex-direction: column;
      gap: 20px;
      align-items: center;
    }
    .corporacion-logos img {
      max-width: 140px;
      height: auto;
      object-fit: contain;
      border-radius: 8px;
      box-shadow: 0 2px 6px rgb(0 0 0 / 0.1);
    }
    .corporacion-text {
      flex: 3 1 500px;
      font-size: 1.1rem;
      line-height: 1.5;
      color: #444;
    }

    /* Sección promociones, proveedor y cliente del mes en fila */
    .stats-section {
      max-width: 900px;
      margin: 0 auto;
      display: flex;
      justify-content: space-between;
      gap: 20px;
      flex-wrap: wrap;
    }
    .stats-card {
      background: white;
      flex: 1 1 280px;
      border-radius: 12px;
      padding: 20px;
      box-shadow: 0 3px 10px rgb(0 0 0 / 0.1);
      text-align: center;
    }
    .stats-card h3 {
      color: #007bff;
      margin-bottom: 15px;
    }
    .stats-card img {
      max-width: 100%;
      height: 180px;
      object-fit: cover;
      border-radius: 10px;
      margin-bottom: 15px;
      box-shadow: 0 2px 8px rgb(0 0 0 / 0.15);
    }
    .stats-card p {
      font-size: 1rem;
      color: #555;
    }

    /* Sección de llamada a la acción */
    .cta-section {
      max-width: 900px;
      margin: 60px auto 20px auto;
      background: #007bff;
      color: white;
      padding: 30px 25px;
      border-radius: 12px;
      text-align: center;
      font-size: 1.3rem;
      font-weight: 600;
      box-shadow: 0 5px 15px rgb(0 0 0 / 0.2);
    }
    .cta-section a {
      color: white;
      font-weight: 700;
      text-decoration: underline;
      cursor: pointer;
    }
  </style>
</head>
<body>

  <!-- Bienvenida -->
  <section class="welcome-message">
    <h1>Bienvenido a One Click Service</h1>
    <p style="color: black; font-size: 1.2rem; margin-top: 5px;">
    Tu plataforma para conectar con los mejores proveedores y servicios
  </p>
  </section>

  <!-- Navbar de inicio / registro -->
  <nav class="navbar" role="navigation" aria-label="Menú principal">
    <a href="http://localhost/oneclickservice-master/auth/logout.php">Iniciar Sesión</a>
    <a href="http://localhost/oneclickservice-master/auth/register.php">Registrarse</a>

  </nav>

  <!-- Carrusel -->
  <section class="carousel" aria-label="Carrusel de imágenes felices y servicios">
    <img src="https://images.unsplash.com/photo-1508214751196-bcfd4ca60f91?auto=format&fit=crop&w=900&q=80" alt="Familia feliz" class="active" />
    <img src="https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?auto=format&fit=crop&w=900&q=80" alt="Aseadora laborando" />
    <img src="https://images.unsplash.com/photo-1504384308090-c894fdcc538d?auto=format&fit=crop&w=900&q=80" alt="Persona limpiando ventana" />
    <div class="carousel-indicators" role="tablist" aria-label="Controles del carrusel">
      <span class="active" role="tab" tabindex="0" aria-selected="true" aria-controls="slide1" aria-label="Imagen 1"></span>
      <span role="tab" tabindex="-1" aria-selected="false" aria-controls="slide2" aria-label="Imagen 2"></span>
      <span role="tab" tabindex="-1" aria-selected="false" aria-controls="slide3" aria-label="Imagen 3"></span>
    </div>
  </section>

  <!-- Sección corporación BÁRAKA -->
  <section class="corporacion-section" aria-label="Corporación BÁRAKA">
    <div class="corporacion-logos">
      <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9d/Star_and_Crescent.svg/1200px-Star_and_Crescent.svg.png" alt="Logo Corporación BÁRAKA" />
      <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/74/Blue_circle_icon.svg/1024px-Blue_circle_icon.svg.png" alt="Logo One Click Service" />
    </div>
    <div class="corporacion-text">
      <h2>¿Qué es la Corporación BÁRAKA?</h2>
      <p>La Corporación BÁRAKA es una organización sin ánimo de lucro dedicada a empoderar mujeres vulnerables, promoviendo sus derechos y ofreciéndoles herramientas para su desarrollo integral.</p>
    </div>
  </section>

  <!-- Sección promociones, proveedor y cliente del mes -->
  <section class="stats-section" aria-label="Estadísticas y promociones">
  <div class="stats-card" aria-label="Proveedor del mes">
  <h3>Proveedor del Mes</h3>
  <img src="https://images.unsplash.com/photo-1515377905703-c4788e51af15?auto=format&fit=crop&w=600&q=80" alt="Proveedor del mes" />
  <p>Reconocemos al proveedor destacado que ha ofrecido servicios de calidad y compromiso.</p>
</div>

    <div class="stats-card" aria-label="Cliente del mes">
      <h3>Cliente del Mes</h3>
      <img src="https://images.unsplash.com/photo-1508214751196-bcfd4ca60f91?auto=format&fit=crop&w=600&q=80" alt="Cliente del mes" />
      <p>Felicidades al cliente más activo y confiable de nuestra plataforma.</p>
    </div>
    <div class="stats-card" aria-label="Promociones">
      <h3>Promociones</h3>
      <img src="https://images.unsplash.com/photo-1588702547923-7093a6c3ba33?auto=format&fit=crop&w=600&q=80" alt="Promociones" />
      <p>Descubre nuestras ofertas exclusivas para ti.</p>
    </div>
  </section>

  <!-- Llamado a la acción -->
  <section class="cta-section" role="region" aria-label="Llamado a la acción para donaciones">
    <p>Apoya a la Corporación BÁRAKA con tu contratación de servicios.</p>
  </section>

  <script>
    const images = document.querySelectorAll('.carousel img');
    const indicators = document.querySelectorAll('.carousel-indicators span');
    let currentIndex = 0;

    function showSlide(index) {
      images.forEach((img, i) => {
        img.classList.toggle('active', i === index);
        indicators[i].classList.toggle('active', i === index);
        indicators[i].setAttribute('aria-selected', i === index ? 'true' : 'false');
        indicators[i].tabIndex = i === index ? 0 : -1;
      });
      currentIndex = index;
    }

    // Auto slide cada 4 segundos
    let slideInterval = setInterval(() => {
      let nextIndex = (currentIndex + 1) % images.length;
      showSlide(nextIndex);
    }, 4000);

    // Controlar clic en indicadores
    indicators.forEach((indicator, i) => {
      indicator.addEventListener('click', () => {
        clearInterval(slideInterval);
        showSlide(i);
      });
      indicator.addEventListener('keydown', (e) => {
        if (e.key === 'Enter' || e.key === ' ') {
          clearInterval(slideInterval);
          showSlide(i);
        }
      });
    });
  </script>

</body>
</html>

