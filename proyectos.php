<?php
include 'auth.php';
include 'db.php';
$result = $conn->query("SELECT * FROM proyectos ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portafolio | Proyectos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      body {
        min-height: 100vh;
        background: linear-gradient(120deg, #2563eb 0%, #60a5fa 100%);
        font-family: 'Segoe UI', Arial, sans-serif;
      }
    </style>
</head>
<body>
<div class="container py-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="text-primary fw-bold text-uppercase" style="letter-spacing:1.5px;">Proyectos</h1>
    <div>
      <a href="add.php" class="btn btn-success rounded-pill fw-semibold me-2">+ Agregar Proyecto</a>
      <a href="logout.php" class="btn btn-outline-danger rounded-pill fw-semibold">Cerrar sesión</a>
    </div>
  </div>
  <div class="row g-4">
    <?php while($row = $result->fetch_assoc()): ?>
      <div class="col-12 col-md-6 col-lg-4">
        <div class="card h-100 shadow border-0">
          <?php if (!empty($row['imagen'])): ?>
            <img src="uploads/<?= htmlspecialchars($row['imagen']) ?>" class="card-img-top" alt="Imagen de <?= htmlspecialchars($row['titulo']) ?>" style="max-height:160px;object-fit:cover;">
          <?php endif; ?>
          <div class="card-body d-flex flex-column">
            <h3 class="card-title text-primary fw-bold fs-5"><?= htmlspecialchars($row['titulo']) ?></h3>
            <p class="card-text text-dark flex-grow-1"><?= nl2br(htmlspecialchars($row['descripcion'])) ?></p>
            <div class="d-flex flex-wrap gap-2 mt-2">
              <?php if (!empty($row['url_github'])): ?>
                <a href="<?= htmlspecialchars($row['url_github']) ?>" target="_blank" class="btn btn-primary btn-sm rounded-pill px-3 fw-semibold">GitHub</a>
              <?php endif; ?>
              <?php if (!empty($row['url_produccion'])): ?>
                <a href="<?= htmlspecialchars($row['url_produccion']) ?>" target="_blank" class="btn btn-info btn-sm rounded-pill px-3 fw-semibold text-white">Enlace</a>
              <?php endif; ?>
              <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm rounded-pill px-3 fw-semibold text-dark">Editar</a>
              <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('¿Seguro?')" class="btn btn-danger btn-sm rounded-pill px-3 fw-semibold">Eliminar</a>
            </div>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>