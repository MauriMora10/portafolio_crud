<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = trim($_POST['username']);
  $password = md5($_POST['password']);

  $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
  $stmt->bind_param("ss", $username, $password);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows === 1) {
    $_SESSION['user'] = $username;
    header("Location: proyectos.php");
    exit;
  } else {
    $error = "Credenciales incorrectas.";
  }
  $stmt->close();
}
?>

<form method="post" class="login-container">
  <h2>Iniciar sesión</h2>
  <?php if (!empty($error)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>
  <label for="username">Usuario</label>
  <input type="text" name="username" id="username" placeholder="Usuario" required autofocus>
  <label for="password">Contraseña</label>
  <input type="password" name="password" id="password" placeholder="Contraseña" required>
  <button type="submit">Iniciar Sesión</button>
</form>