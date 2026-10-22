<?php
session_start();

# Solo se permite ingresar si previamente ocurrió un error de BDD y se levantó la flag.
if (!isset($_SESSION['error_500']) || $_SESSION['error_500'] !== true) {
    header("Location: index.php");
    exit;
}

# Se consume la bandera eliminándola para que no sea reutilizable tras recargar.
unset($_SESSION['error_500']);

# Se inyecta la cabecera 500 Internal Server Error requerida por la rúbrica.
http_response_code(500);
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Error 500 - Internal Server Error</title>
</head>
<body>
    <h1>Sistema de Incidencias Técnicas (SIT)</h1>
    <hr>
    <h2>Error 500 - Internal Server Error</h2>
    <p>Hubo un problema de conexión con la base de datos al procesar la solicitud. Por favor, intente más tarde.</p>
    <hr>
    
    <!-- El enlace dirige a cerrarsesion.php para destruir la sesión y volver al login -->
    <p><a href="cerrarsesion.php">Regresar al Login</a></p>
</body>
</html>