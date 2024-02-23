<?php
    define('DB_SERVER', 'db');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', 'secret');
    define('DB_NAME', 'Practica3');

    $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD,DB_NAME);

    if($connection == false) {
        die("Could not connect to database" . mysqli_connect_error());
    }
?>