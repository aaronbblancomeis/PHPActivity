<?php
require_once "config.php";

session_start();
$username = $_SESSION["username"];
$query = "UPDATE Users SET estado = 'Desconectado' WHERE username = '$username'";
$result = $connection->query($query);

session_destroy();
header("Location:index.php")
?>