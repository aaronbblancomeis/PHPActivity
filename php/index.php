<?php
    require_once "config.php";
    $imagePerfil = [
        "https://a4-images.myspacecdn.com/images03/2/85a286a4bbe84b56a6d57b1e5bd03ef4/300x300.jpg",
        "https://i.pinimg.com/564x/37/29/90/3729902ee163d086f6d704acc4154ac8.jpg",
        "https://i.pinimg.com/564x/44/5b/ab/445babeca8b22aabfa82d7726a68b17d.jpg",
        "https://i.pinimg.com/736x/8c/d3/f8/8cd3f87b754829b6c9203bbb183382bf.jpg",
        "https://i.pinimg.com/736x/ac/e0/27/ace027d45af1032940ddc12e66113f38.jpg",
        "https://i.pinimg.com/564x/5f/93/ae/5f93ae3c3d03b02b794918d139017928.jpg",
        "https://i.pinimg.com/564x/62/e4/09/62e409adb45af28ed3ea4980d1791bfc.jpg"];
    $imagenPortada = [
    "http://i.imgur.com/woUbg3p.jpg",
    "https://i.pinimg.com/564x/bd/7f/6b/bd7f6b57bb24b82283ed031a200114c2.jpg",
    "https://i.pinimg.com/736x/9b/90/c5/9b90c538ea672b101f527f1b24773b64.jpg",
    "https://i.pinimg.com/564x/2f/3e/07/2f3e0726b2e2bfff37e4528d0b46ff17.jpg",
    "https://i.pinimg.com/originals/64/a8/08/64a8083d07b8c98923311cbc88fecafe.gif",
    "https://i.pinimg.com/564x/e2/47/a4/e247a4cad080ddc903b61bb0f516aaa3.jpg"];
    
    session_start();
    if (isset($_SESSION["username"])) {
        header("Location:home.php");
    }

    if(isset($_POST["login"])) {
        $username = mysqli_real_escape_string($connection,$_POST["username"]);
        $password = mysqli_real_escape_string($connection,$_POST["password"]);
        $query = "SELECT * FROM Users WHERE username = '$username'";
        $result = $connection->query($query);

        if($result->num_rows > 0){
            $row = mysqli_fetch_array($result);
            if (password_verify($password, $row["password"])) {
                $_SESSION["username"] = $username;
                header("Location:home.php");
                $query = "UPDATE Users SET estado = 'Conectado' WHERE username = '$username'";
                $result = $connection->query($query);
            }
        }else {
            echo '<script> alert("Error en el login") </script>';
        }
    }

    if (isset($_POST["signup"])) {
        if(empty($_POST["username"]) || empty($_POST["password"]) || empty($_POST["repassword"]) || empty($_POST["email"]) || empty($_POST["fullName"])) {
            echo '<script> alert("Todos los datos deben estar cubiertos");</script>';
            return;
        }

        if($_POST["password"] != $_POST["repassword"]) {
            echo '<script> alert("Las contraseñas no coinciden");</script>';
        }

        $username = mysqli_real_escape_string($connection,$_POST["username"]);
        $password = mysqli_real_escape_string($connection,$_POST["password"]);
        $email = mysqli_real_escape_string($connection,$_POST["email"]);
        $fullName = mysqli_real_escape_string($connection,$_POST["fullName"]);

        $password = password_hash($password, PASSWORD_DEFAULT);
        
        $randomImageUrlPerfil = $imagePerfil[array_rand($imagePerfil)];
        $randomImageUrlPortada = $imagenPortada[array_rand($imagenPortada)];

        $query = "INSERT INTO Users (username, password, email, name, fotoPerfil, fotoPortada) VALUES ('$username', '$password', '$email', '$fullName', '$randomImageUrlPerfil', '$randomImageUrlPortada')";
        #if($connection->query($query)){
        if(mysqli_query($connection,$query)){
            echo '<script> alert("Has sido registrado correctamente") </script>';
        }else {
            echo '<script> alert("Error no has sido registrado correctamente") </script>' . mysqli_error($connection);
        }    
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title> Introducción to PHP </title>
    <link rel="stylesheet" href="./style.css">

</head>

<body>
    <div class="container">
        <div class="box"></div>
        <div class="container-forms">
            <div class="container-info">
                <div class="info-item">
                    <div class="table">
                        <div class="table-cell">
                            <p>
                               Tienes cuenta ?
                            </p>
                            <div class="btn">
                                Inicia Sesión
                            </div>
                        </div>
                    </div>
                </div>
                <div class="info-item">
                    <div class="table">
                        <div class="table-cell">
                            <p>
                               No tienes cuenta ?
                            </p>
                            <div class="btn">
                                Registrate
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-form">
                <div class="form-item log-in">
                    <div class="table">
                        <div class="table-cell">
                            <form method="post">
                                <input name="username" placeholder="Usuario" type="text" />
                                <input name="password" placeholder="Contraseña" type="Password" />
                                <input class="btn" type="submit" value="Log In" name="login">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="form-item sign-up">
                    <div class="table">
                        <div class="table-cell">
                            <form action="" method="post">
                                <input name="email" placeholder="Email" type="text" />
                                <input name="fullName" placeholder="Nombre completo" type="text" />
                                <input name="username" placeholder="Usuario" type="text" />
                                <input name="password" placeholder="Contraseña" type="Password" />
                                <input name="repassword" placeholder="Repetir Contraseña" type="Password" />
                                <input class="btn" type="submit" value="Sign Up" name="signup">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php
echo "
<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
<script>
    \$(document).ready(function(){
        \$(\".info-item .btn\").click(function(){
            \$(\".container\").toggleClass(\"log-in\");
        });
        \$(\".container-form .btn\").click(function(){
            \$(\".container\").addClass(\"active\");
        });
    });
</script>
";
?>


</html>