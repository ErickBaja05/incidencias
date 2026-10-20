<?php

session_start();
http_response_code(500);

$_SESSION["nombre"] = "Fran";
$_SESSION["clave"] = "123";

if (isset($_SESSION['nombre']) && $_SESSION["'clave"]){
    header("Location: index.php");
    exit;
}

?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Error 500</title>
    </head>
    <body>
        <h1>Sistema de Incidencias Técnicas (SIT)</h1>
        <h2>Bienvenid@ <?php echo $_SESSION['nombre'] ?> </h2>
        <hr>
        <h2>Error 500 - Internal Server Error </h2>
        <p>Hubo un problema al conectar con la base de datos. Por favor, intenta más tarde.</p>
        <hr>
        <p><a href="cerrarsesion.php">Regresar al Login</a></p>
    </body>
</html>