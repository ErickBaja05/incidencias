<?php 
session_start();
#Validar la autenticacion del usuario 
if(!isset($_SESSION['username'])){
    header("Location: index.php");
    exit();
}

#Procesar el formulario
if($_SERVER['REQUEST_METHOD']==='POST'){
    $nombre = $_POST['nombre'] ?? "";
    $descripcion = $_POST['descripcion'] ?? "";
    $prioridad =$_POST['prioridad']?? "";

    $hay_errores = false;

    if(empty($nombre)|| preg_match('/[\$\\\=]/',$nombre)){
        $hay_errores = true;
    }

    if(empty($descripcion)|| preg_match('/[$\[\]\\\=]/', $descripcion)){
        $hay_errores =true;
    }

    if(empty($prioridad)|| !in_array($prioridad, ['alta', 'media','baja'],true)){
        $hay_errores = true;
    }

    if($hay_errores){
        header("Location: 400.php");
        exit();
    }

    #Inserción en la Base de Datos
    try {
        require_once __DIR__ . '/bdd/IncidenciaDAO.php';

        $usuarioUsername = $_SESSION['username'];

        // Crear la entidad Incidencia con los datos del formulario y la sesión
        $nuevaIncidencia = new Incidencia($nombre, $descripcion, $prioridad, $usuarioUsername);

        // Instanciar el DAO e insertar
        $dao = new IncidenciaDAO();
        $idGenerado = $dao->create($nuevaIncidencia);

        if ($idGenerado > 0) {
            // Bandera para control de acceso a 201.php
            $_SESSION['incidencia_creada'] = true;
            header("Location: 201.php");
            exit();
        } else {
            header("Location: 500.php");
            exit();
        }
    } catch (Throwable $e) {
        // Redirigir a 500.php en caso de error o excepción de base de datos
        header("Location: 500.php");
        exit();
    }

}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title> Registrar incidencia </title>
    </head>
    <body>
        <header>
            <h1>Registrar nueva incidencia</h1>
            <p>Bienvenido, <?php echo htmlspecialchars($_SESSION['username']); ?> </p>
            <a href= "cerrarsesion.php">Cerrar sesión</a>
        </header>
        <hr><br>
        <form method="POST" action="registrar.php">
            <fieldset>
                <legend><b>Datos de la incidencia </b></legend> 

                <label for="nombre"> Nombre: </label><br>
                <input type = "text" id ="nombre" name= "nombre" placeholder="Ej: Error al calcular total de factura" maxlength="100" size="50" required> 
                <br><br>

                <label for="descripcion"> Descripcion:</label><br>
                <textarea name="descripcion" id="descripcion" rows="5" cols="50" maxlength="200" placeholder="Ej: Describe detalladamente el problema o comportamiento inesperado..." required></textarea>
                <br><br>

                <label for ="prioridad" >Prioridad: </label><br>
                <select id="prioridad" name ="prioridad" required>
                    <option value ="" >Seleccione una opción... </option>
                    <option value ="alta">Alta </option>
                    <option value ="media">Media </option>
                    <option value ="baja">Baja </option>
                </select>
                <br><br>

                <input type="submit" value ="Enviar">
            </fieldset>
        </form>

        <br>
        <a href= "listar.php"> Regresar al listado</a>

    </body>
</html>