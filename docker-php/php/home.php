<?php
require_once "config.php";

session_start();

if (!isset($_SESSION["username"])) {
    header("Location:index.php");
} else {
    $query = "UPDATE Users SET estado = 'Conectado' WHERE username = '$username'";
    $result = $connection->query($query);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="homestyle.css?v=<?php echo time(); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css?v=<?php echo time(); ?>" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Home</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="icon material-symbols-outlined">person</i>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="actualizar_estado.php?estado=Conectado">Conectado</a></li>
                            <li><a class="dropdown-item" href="actualizar_estado.php?estado=Ausente">Ausente</a></li>
                            <li><a class="dropdown-item" href="actualizar_estado.php?estado=Ocupado">Ocupado</a></li>
                            <li><a class="dropdown-item" href="actualizar_estado.php?estado=Desconectado">Desconectado</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php"><i class="icon material-symbols-outlined logout">logout</i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container align-middle">
        <div class="row">
            <?php
            $query = "SELECT * FROM Users";
            $result = mysqli_query($connection, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '
                        <div class="col-md-4 my-3">
                            <div class="shadow overflow">
                                <div id="header" style="background-image: url(' . $row["fotoPortada"] . ');"></div>
                                <div id="profile">
                                    <div class="image">
                                        <img src="' . $row["fotoPerfil"] . '" alt="" />
                                    </div>
                                    <div class="name">
                                        ' . $row["name"] . '
                                    </div>
                                    <div class="nickname">
                                        @' . $row["username"] . '
                                        <span class="material-symbols-outlined verify">
                                        verified
                                        </span>
                                    </div>
                                    <div id=' . $row["username"] . ' class="location">
                                        ' . $row["estado"] . '
                                    </div>                       
                                </div>
                            </div>
                        </div>
                        ';
                }
            }
            ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>