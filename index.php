<?php
include 'db.php';
$proyectos = $conn->query("SELECT * FROM proyectos ORDER BY created_at DESC LIMIT 3");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido | Portafolio de Mauricio Mora</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <div class="top-bar">
    <div class="nav-menu">
      <a class="btn-nav" href="#proyectos">Proyectos</a>
      <a class="btn-nav" href="#contacto">Contacto</a>
    </div>
    <a class="btn-login" href="login.php">Iniciar sesión</a>
  </div>

  <div class="main-section">
    <div class="home-hero-card">
      <img class="avatar" src="https://ui-avatars.com/api/?name=Mauricio+Mora&background=2563eb&color=fff&size=128" alt="Avatar Mauricio Mora">
      <h1 class="titulo-principal">¡Bienvenido al Portafolio de Mauricio Mora!</h1>
      <p>
        Explora los proyectos más recientes y destacados que he desarrollado.<br>
        Si eres administrador, puedes iniciar sesión para gestionar el portafolio.
      </p>
    </div>

    <div class="proyectos-inicio" id="proyectos">
      <h2>Proyectos recientes</h2>
      <div class="proyectos-lista">
        <?php while($row = $proyectos->fetch_assoc()): ?>
          <div class="proyecto-card">
            <?php if (!empty($row['imagen'])): ?>
              <img src="uploads/<?= htmlspecialchars($row['imagen']) ?>" alt="Imagen de <?= htmlspecialchars($row['titulo']) ?>">
            <?php endif; ?>
            <h3><?= htmlspecialchars($row['titulo']) ?></h3>
            <p><?= nl2br(htmlspecialchars($row['descripcion'])) ?></p>
            <div class="links">
              <?php if (!empty($row['url_github'])): ?>
                <a href="<?= htmlspecialchars($row['url_github']) ?>" target="_blank">GitHub</a>
              <?php endif; ?>
              <?php if (!empty($row['url_produccion'])): ?>
                <a href="<?= htmlspecialchars($row['url_produccion']) ?>" target="_blank">Enlace</a>
              <?php endif; ?>
            </div>
          </div>
        <?php endwhile; ?>
      </div>
    </div>
  </div>
  <div class="contacto-box" id="contacto">
    <h2>Contacto</h2>
    <form action="#" method="post" class="contacto-form" autocomplete="off">
      <input type="text" name="nombre" placeholder="Tu nombre" required minlength="2" maxlength="50">
      <input type="email" name="email" placeholder="Tu correo" required maxlength="80">
      <input type="tel" name="telefono" placeholder="Tu teléfono" required pattern="[0-9+\s\-()]{7,20}" maxlength="20" title="Solo números, espacios y símbolos + - ( )">
      <textarea name="mensaje" placeholder="Tu mensaje" rows="3" required minlength="5" maxlength="500"></textarea>
      <button type="submit">Enviar</button>
    </form>
  </div>
</body>
</html>