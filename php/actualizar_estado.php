<?php
require_once "config.php";
session_start();

if (!isset($_GET["estado"])) {
    http_response_code(400); // Bad Request
    echo json_encode(['error' => 'No se proporcionó el estado']);
    exit;
}

$estado = $_GET["estado"];
$username = $_SESSION["username"]; // obtén el nombre de usuario de la sesión

$query = "UPDATE Users SET estado = '$estado' WHERE username = '$username'";
$result = $connection->query($query);
header("Location:home.php");
?>
