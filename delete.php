<?php
session_start();
include 'auth.php';
include 'db.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("DELETE FROM proyectos WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

header("Location: proyectos.php");
exit;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
</body>
</html>