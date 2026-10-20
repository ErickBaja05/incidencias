<?php

session_start();

# SE VERIFICA QUE UN USUARIO TENGA UNA SESION ACTIVA

if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] == false) {
    header('Location: index.php');
    exit;
}

#PARA EVITAR QUE SE ACCEDA DESDE LA URI, SE MIRA SI DE VERDAD SE REGISTRÓ UNA INCIDENCIA, SI NO FUE ASÍ, PUES SE REDIRIGE AL LISTADO

if (!isset($_SESSION['incidencia_creada']) || $_SESSION['incidencia_creada'] == false) {
    header('Location: listar.php');
    exit;
}

# ESTA BANDERA ES DE USO ÚNICO Y PUES SE LA ELIMINA UNA VEZ QUE SE LA CONSUMA.

unset($_SESSION['incidencia_creada']);

// 2. Verificar que realmente acaba de crear una incidencia (bloquea acceso directo por URI)
if (empty($_SESSION['incidencia_creada'])) {
    header('Location: listar.php');
    exit;
}

// 3. Consumir la bandera (para que solo sirva una vez)
unset($_SESSION['incidencia_creada']);

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
