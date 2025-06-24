<?php
include 'auth.php';
include 'db.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
  header("Location: index.php");
  exit;
}

$id = (int)$_GET['id'];

$stmt = $conn->prepare("SELECT * FROM proyectos WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$proyecto = $result->fetch_assoc();
$stmt->close();

if (!$proyecto) {
  header("Location: index.php");
  exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $titulo = trim($_POST['titulo']);
  $descripcion = trim($_POST['descripcion']);
  $url_github = trim($_POST['url_github']);
  $url_produccion = trim($_POST['url_produccion']);
  $imagenNombre = $proyecto['imagen']; 

  if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
    $imagenTmp = $_FILES['imagen']['tmp_name'];
    $imagenNombre = basename($_FILES['imagen']['name']);
    $uploadDir = "uploads/";
    $uploadFile = $uploadDir . $imagenNombre;

    if (!move_uploaded_file($imagenTmp, $uploadFile)) {
      $error = "Error al subir la imagen.";
    }
  }

  if (empty($error)) {
    $stmt = $conn->prepare("UPDATE proyectos SET titulo=?, descripcion=?, url_github=?, url_produccion=?, imagen=? WHERE id=?");
    $stmt->bind_param("sssssi", $titulo, $descripcion, $url_github, $url_produccion, $imagenNombre, $id);
    $stmt->execute();
    $stmt->close();

    header("Location: index.php");
    exit;
  }
}
?>

<?php if (!empty($error)): ?>
  <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<form method="post" enctype="multipart/form-data" class="modern-form">
  <div class="form-title">Editar Proyecto</div>
  <label for="titulo">Título</label>
  <input type="text" name="titulo" id="titulo" value="<?= htmlspecialchars($proyecto['titulo']) ?>" required>
  <label for="descripcion">Descripción</label>
  <textarea name="descripcion" id="descripcion" maxlength="200" required><?= htmlspecialchars($proyecto['descripcion']) ?></textarea>
  <label for="url_github">URL GitHub</label>
  <input type="url" name="url_github" id="url_github" value="<?= htmlspecialchars($proyecto['url_github']) ?>">
  <label for="url_produccion">URL Producción</label>
  <input type="url" name="url_produccion" id="url_produccion" value="<?= htmlspecialchars($proyecto['url_produccion']) ?>">
  <label for="imagen">Imagen</label>
  <input type="file" name="imagen" id="imagen" accept="image/*">
  <button type="submit">Actualizar</button>
</form>