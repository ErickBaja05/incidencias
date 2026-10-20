<?php
session_start();
http_response_code(400);

if(!isset($_SESSION['nombre']) && !isset($_SESSION['clave'])){
    header("Location: index.php");
    exit;
}

$nombre = $_SESSION['nombre'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Error 400</title>
</head>
<body>
    <h1>Sistemas de Incidencias Técnicas (SIT)</h1>
    <p>Bienvenido <?php echo $nombre; ?></p>
    <hr>
    <h2>Error 400 – Bad request</h2>
    <p>La solicitud no pudo ser entendida o procesada por el servidor</p>
    <hr>
    <a href="registrar.php">Regresar al registro</a> <br>
    <a href="cerrarsesion.php">Cerrar sesión</a>
</body>
</html> 
