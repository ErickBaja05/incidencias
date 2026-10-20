<?php

session_start();

if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] == false) {
    header('Location: index.php');
    exit;
}

http_response_code(201);

$username = $_SESSION['username'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incidencia Registrada</title>
</head>

<body>

    <h1>Incidencia Creada - 201 created </h1>
    <hr>
    <h2>Usuario Loggeado: <?php echo $username ?></h2>
    <a href="listar.php">Ir al listado de incidencias</a> <br>
    <a href="cerrarsesion.php">Cerrar Sesion</a>
</body>

</html>
