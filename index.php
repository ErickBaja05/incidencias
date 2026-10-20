<?php

session_start();


$isError = false;
if (isset($_SESSION['errorCode'])) {
    $isError = true;
    $errorCode = $_SESSION['errorCode'];
    unset($_SESSION['errorCode']);
}

#SI ESQUE MARCO RECORDARME, PUES TENGO QUE RECUPERAR LA COOKIE Y PODER PONER EL NOMBRE Y MARCAR EL CHECKBOX

$username = $_COOKIE['c_username'] ?? null;
$recordarme = isset($_COOKIE['c_recordarme']);



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Tickets</title>
</head>

<body>

    <h1>SISTEMA DE INCIDENCIAS TÉCNICAS (SIT) </h1>
    <hr>

    <form method="POST" action="loginManager.php">
        <fieldset>
            <legend>Autentíquese en el sistema antes de continuar</legend>
            <label for="username">Usuario</label>
            <input type="text" id="username" , name="username" required
                value="<?php echo $recordarme ? $username : "" ?>">
            <br>
            <label for="password">Contraseña</label>
            <input type="password" id="password" , name="password" required>
            <br>
            <label for="chkRecordarme">¿Recordar Usuario?</label>
            <input type="checkbox" name="chkRecordarme" id="chkRecordarme" <?php echo $recordarme ? "checked" : "" ?>>
            <br>
            <br>
            <input type="submit" value="Iniciar Sesión">
        </fieldset>

    </form>

    <p> <?php if ($isError) {
        if ($errorCode === '0') {
            echo "CREDENCIALES INCORRECTAS";
        } else {
            echo "TODOS LOS CAMPOS SON OBLIGATORIOS";
        }
    } ?></p>

</body>

</html>
