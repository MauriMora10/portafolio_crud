<?php
include 'auth.php';
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $titulo = trim($_POST['titulo']);
  $descripcion = trim($_POST['descripcion']);
  $url_github = trim($_POST['url_github']);
  $url_produccion = trim($_POST['url_produccion']);

  if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
    $imagenTmp = $_FILES['imagen']['tmp_name'];
    $imagenNombre = basename($_FILES['imagen']['name']);
    $uploadDir = "uploads/";
    $uploadFile = $uploadDir . $imagenNombre;

    if (move_uploaded_file($imagenTmp, $uploadFile)) 
    {
      $stmt = $conn->prepare("INSERT INTO proyectos (titulo, descripcion, url_github, url_produccion, imagen) VALUES (?, ?, ?, ?, ?)");
      $stmt->bind_param("sssss", $titulo, $descripcion, $url_github, $url_produccion, $imagenNombre);
      $stmt->execute();
      $stmt->close();

      header("Location: proyectos.php");
      exit;
    } 
    else 
    {
      $error = "Error al subir la imagen.";
    }
  } 
  else 
  {
    $error = "Debe subir una imagen válida.";
  }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Agregar Proyecto</title>
  <link rel="stylesheet" href="css/style.css" />
</head>
<body>
  <form method="post" enctype="multipart/form-data" class="modern-form">
    <div class="form-title">Agregar Proyecto</div>
    <?php if (!empty($error)): ?>
      <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <label for="titulo">Título</label>
    <input type="text" name="titulo" id="titulo" placeholder="Título" required>
    <label for="descripcion">Descripción</label>
    <textarea name="descripcion" id="descripcion" maxlength="200" placeholder="Descripción (máx 200 palabras)" required></textarea>
    <label for="url_github">URL GitHub</label>
    <input type="url" name="url_github" id="url_github" placeholder="URL GitHub">
    <label for="url_produccion">URL Producción</label>
    <input type="url" name="url_produccion" id="url_produccion" placeholder="URL Producción">
    <label for="imagen">Imagen</label>
    <input type="file" name="imagen" id="imagen" accept="image/*" required>
    <button type="submit">Guardar</button>
  </form>
</body>
</html>