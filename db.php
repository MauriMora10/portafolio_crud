<?php
$host = "localhost";
$db = "mauricio_mora";
$user = "mauricio_mora";
$pass = "mauricio_mora2025";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
  die("Error de conexión: " . $conn->connect_error);
}
?>
<head>
    <link rel="stylesheet" href="css/style.css">
</head>