<?php

session_start();

if(!isset($_SESSION['nombre']) && !isset($_SESSION['clave'])){
    header("Location: index.php");
    exit;
}

#Importamos los archivos de la base de datos que se va a utilizar para mostrar el detalle de la incidencia
require_once 'bdd/DatabaseConfig.php';
require_once 'bdd/DatabaseConnection.php';
require_once 'bdd/Incidencia.php';
require_once 'bdd/IncidenciaDAO.php';

#Capturamos el id de la incidencia que se pasa por GET
$id_incidencia = isset($_GET['id']) ? $_GET['id'] : null;

#Consultamos la incidencia en la base de datos utilizando el id capturado
$incidencia = null;
if ($id > 0) {
    $dao = new IncidenciaDAO();
    $incidencia = $dao -> findById($id); 
}

#Si la incidencia no existe o no se proporcionó un ID válido, se redirige al listado de incidencias
if (!$incidencia) {
    header("Location: listar.php");
    exit;
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Detalle de Incidencia</title>
    </head>
    <body>
        <h1>Bienvenid@ <?php echo $_SESSION['nombre'] ?> </h1>
        <h2>Sistema de Incidencias Técnicas (SIT)</h2>
        <p><a href="cerrarsesion.php">Cerrar Sesion</a></p>
        <hr>
        <h3>Detalle de la Incidencia</h3>
        <hr>
        <fieldset>
            <legend><strong>Información del Ticket #<?php echo htmlspecialchars($incidencia->getId()); ?></strong></legend>

            <p>
                <strong>ID:</strong> 
                <?php echo htmlspecialchars($incidencia->getId()); ?>
            </p>

            <p>
                <strong>Nombre:</strong> 
                <?php echo htmlspecialchars($incidencia->getNombre()); ?>
            </p>

            <p>
                <strong>Descripción:</strong><br>
                <?php echo nl2br(htmlspecialchars($incidencia->getDescripcion())); ?>
            </p>

            <p>
                <strong>Prioridad:</strong> 
                <?php echo htmlspecialchars($incidencia->getPrioridad()); ?>
            </p>
        </fieldset>
        <hr>
        <p><a href="listar.php">Regresar al Listado</a></p>
    </body>
</html>