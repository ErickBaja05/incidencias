<?php
session_start();

# SE VERIFICA QUE UN USUARIO TENGA UNA SESIÓN ACTIVA
if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] == false) {
    header('Location: index.php');
    exit;
}

require_once __DIR__ . '/bdd/IncidenciaDAO.php';

$username = $_SESSION['username'];
$incidenciaDAO = new IncidenciaDAO();
$incidencias = $incidenciaDAO->findByUsuario($username);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Incidencias</title>
</head>

<body>

    <h1>Listado de Incidencias</h1>
    <hr>
    <h2>Usuario Loggeado: <?php echo $username; ?></h2>
    <a href="registrar.php">Registrar nueva incidencia</a> <br>
    <?php if ($username === 'admin') { ?>
        <a href="registrarUsuario.php">Registrar nuevo usuario</a> <br>
    <?php } ?>
    <a href="cerrarsesion.php">Cerrar Sesion</a> <br>
    <br>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
        </tr>
        <?php foreach ($incidencias as $incidencia) { ?>
            <tr>
                <td><?php echo $incidencia->getId(); ?></td>
                <td>
                    <a href="detalle.php?id=<?php echo $incidencia->getId(); ?>">
                        <?php echo $incidencia->getNombre(); ?>
                    </a>
                </td>
            </tr>
        <?php } ?>
    </table>

</body>

</html>