<?php
session_start();

# SE VERIFICA QUE UN USUARIO TENGA UNA SESIÓN ACTIVA
if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] == false) {
    header('Location: index.php');
    exit;
}

# PARA EVITAR QUE SE ACCEDA DESDE LA URI, SE VERIFICA LA BANDERA DE ERROR 400
if (!isset($_SESSION['error_400']) || $_SESSION['error_400'] == false) {
    header('Location: registrar.php');
    exit;
}

# ESTA BANDERA ES DE USO ÚNICO Y SE LA ELIMINA UNA VEZ QUE SE LA CONSUMA
unset($_SESSION['error_400']);

http_response_code(400);

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error 400</title>
</head>

<body>

    <h1>Error 400 – Bad request</h1>
    <hr>
    <h2>Usuario Loggeado: <?php echo $username ?></h2>
    <a href="registrar.php">Regresar al registro</a> <br>
    <a href="cerrarsesion.php">Cerrar Sesion</a>
    <hr>
    <p>La solicitud no pudo ser entendida o procesada por el servidor</p>

</body>

</html>
