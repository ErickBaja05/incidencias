<?php 

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title> Registrar incidencia </title>
    </head>
    <body>
        <header>
            <p>Bienvenido, <?php echo $_SESSION['usuario']; ?></p>
            <a href= "cerrarsesion.php">Cerrar sesión</a>
        </header>

        <h1>Registrar nueva incidencia</h1>
        
        <form method="POST" action="registrar.php">
            <fieldset>
                <legend><b>Datos de la incidencia </b></legend> 

                <label for="nombre"> Nombre: </label><br>
                <input type = "text" id ="nombre" name= "nombre" placeholder="Ej: Error al calcular total de factura" required> 
                <br><br>

                <label for="descripcion"> Descripcion:</label><br>
                <textarea name="descripcion" id="descripcion" rows="5" cols="50" placeholder="Ej: Describe detalladamente el problema o comportamiento inesperado..." required></textarea>
                <br><br>

                <label for ="prioridad" >Prioridad: </label><br>
                <select id="prioridad" name ="prioridad" required>
                    <option value ="" >Seleccione una opción... </option>
                    <option value ="1">Baja </option>
                    <option value ="2">Media </option>
                    <option value ="3">Alta </option>
                </select>
                <br><br>

                <input type="submit" value ="Enviar">
            </fieldset>
        </form>

        <br>
        <a href= "Listar.php"> Regresar al listado</a>

    </body>
</html>