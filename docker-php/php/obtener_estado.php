<?php
// Archivo: obtener_estado.php

// Incluye el archivo de configuración de la base de datos
require_once "config.php";

// Verifica si el usuario ha iniciado sesión
session_start();

if (isset($_SESSION["username"])) {
    $username = $_SESSION["username"];

    // Consulta el estado actual del usuario en la base de datos
    $query = "SELECT estado FROM Users WHERE username = '$username'";
    $result = $connection->query($query);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $estadoActual = $row["estado"];

        // Devuelve el estado actual como respuesta JSON
        echo json_encode(["success" => true, "estado" => $estadoActual]);
    } else {
        // No se encontró el usuario o hubo un error en la consulta
        echo json_encode(["success" => false, "message" => "Error al obtener el estado del usuario"]);
    }
} else {
    // El usuario no ha iniciado sesión
    echo json_encode(["success" => false, "message" => "Usuario no autenticado"]);
}
?>
