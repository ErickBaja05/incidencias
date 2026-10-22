<?php
session_start();

# Se valida que el usuario esté autenticado mediante la bandera estándar 'isLoggedIn'.
if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] == false) {
    header('Location: index.php');
    exit;
}

# Se importa el Data Access Object (DAO) de incidencias. 
# IncidenciaDAO ya incluye internamente DatabaseConnection e Incidencia.
require_once __DIR__ . '/bdd/IncidenciaDAO.php';

# Se valida que el id recibido sea un número entero para evitar inyecciones o errores.
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    header('Location: listar.php');
    exit;
}

# Se ejecuta la consulta a MariaDB/MySQL mediante el método findById pasándole el ID.
$incidenciaDAO = new IncidenciaDAO();
$incidencia = $incidenciaDAO->findById((int) $id);

$username = $_SESSION['username'];

# Si la incidencia no existe o pertenece a otro usuario (salvo que sea admin), se deniega el acceso.
if (!$incidencia || ($incidencia->getUsuarioUsername() !== $username && $username !== 'admin')) {
    header('Location: listar.php');
    exit;
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle de Incidencia</title>
</head>
<body>
    <h1>Sistema de Incidencias Técnicas (SIT)</h1>
    <h2>Usuario Loggeado: <?php echo htmlspecialchars($username); ?></h2>
    
    <p>
        <a href="listar.php">Regresar al listado</a><br>
        <?php if ($username === 'admin') { ?>
            <a href="registrarUsuario.php">Registrar nuevo usuario</a><br>
        <?php } ?>
        <a href="cerrarsesion.php">Cerrar Sesion</a>
    </p>

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