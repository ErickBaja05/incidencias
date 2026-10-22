<?php
session_start();

if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] == false) {
    header('Location: index.php');
    exit;
}

if ($_SESSION['username'] !== 'admin') {
    header('Location: index.php');
    exit;

}

$isError = false;
$errorCode = null;
if (isset($_SESSION['errorCode'])) {
    $isError = true;
    $errorCode = $_SESSION['errorCode'];
    unset($_SESSION['errorCode']);
}

$successMsg = null;
if (isset($_SESSION['successMsg'])) {
    $successMsg = $_SESSION['successMsg'];
    unset($_SESSION['successMsg']);
}

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RegistrarUsuario</title>
</head>

<body>

    <h1>Formulario para el registro de usuarios</h1>
    <hr>
    <h2>Usuario Loggeado: <?php echo $username ?></h2>
    <a href="listar.php">Regresar al listado</a> <br>
    <a href="cerrarsesion.php">Cerrar Sesion</a> <br>
    <br>
    <form method="POST" action="nuevoUsuarioManager.php">
        <fieldset>
            <legend>Complete todos los campos para crear un nuevo usuario</legend>

            <label for="username">Nombre de Usuario</label><br>
            <input type="text" placeholder="Nombre de Usuario" name="username" id="username" required> <br>
            <label for="password">Contraseña</label><br>
            <input type="password" placeholder="Constraseña" name="password" id="password" required> <br><br>
            <input type="submit" value="Registrar Usuario">
        </fieldset>
    </form>
    <p>
        <?php

        if ($isError) {
            if ($errorCode === '0') {
                echo "ERROR: SE NECESITAN TODOS LOS CAMPOS PARA REGISTRAR UN USUARIO";
            } elseif ($errorCode === '1') {
                echo "ERROR: YA EXISTE UN USUARIO CON EL NOMBRE DE USUARIO PROPORCIONADO";
            } elseif ($errorCode === '2') {
                echo "ERROR AL GUARDAR EL USUARIO EN LA BASE DE DATOS";
            } else {
                echo "ERROR DESCONOCIDO";
            }
        }

        if ($successMsg) {
            echo $successMsg;

        }
        ?>
    </p>




</body>

</html>
