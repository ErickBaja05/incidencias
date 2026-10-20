<?php
#PARA INICIAR LA SESIONES

session_start();

#CLASES PARA CONSULTAR A LA BASE DE DATOS

require __DIR__ . "/bdd/UsuarioDAO.php";


$usuarioDAO = new UsuarioDAO();

#VALIDACIÓN DE QUE LOS DATOS SE ENVÍEN POR POST. ADEMÁS, ESTE FICHERO SOLO ES ACCESIBLE DESDE EL FORMULARIO, CON ESO SE BLOQUEA QUE: 1 ENVIE POR POST Y 2 QUE NO ENTREN DESDE LA URI

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: index.php");
    exit;
}



#VALIDACIÓN DE QUE SE HAYAN ENVIADO TODOS LOS DATOS Y BUILD DE VARIABLES

# 1 ---> FALTAN DATOS

# SI FALTAN DATOS, SE REDIRIGE A INDEX.PHP con una SESION para mostrar: "Debe ingresar todos los datos

$username = is_string($_POST["username"] ?? null) ? $_POST["username"] : "";
$password = is_string($_POST["password"] ?? null) ? $_POST["password"] : "";
$recordarme = isset($_POST["chkRecordarme"]);

if ($username === "" || $password === "") {
    $_SESSION["errorCode"] = '1';
    header("Location: index.php");
    exit;
}

#CONSULTA A LA BASE DE DATOS

#SI NO SE PUEDE AUTENTICAR, SE REDIRIGE A INDEX.PHP con una SESSION para mostrar: "Usuario o Credenciales Incorrectas"

# 0 --> USUARIO O CREDENCIALES INCORRECTAS

$usuario = $usuarioDAO->autenticar($username, $password);

if ($usuario === null) {
    $_SESSION["errorCode"] = '0';
    header("Location: index.php");
    exit;

} else {
    # SI ESQUE SI EXISTE UN USUARIO CORRECTO, ENTONCES SE PROCEDE A CREAR LA SESIÓN Y SE CREA LA COOKIE PARA LA EXPERIENCIA SI SE PIDIO RECORDARLO
    $_SESSION["username"] = $usuario->getUsername();
    #ESTE PARAMETRO NOS SERVIRÁ PARA BLOQUEARLE EL ACCESO A LAS DEMÁS PÁGINAS SI ESQUE NO SE AUTENTICA PRIMERO
    $_SESSION["isLoggedIn"] = true;

    $opciones = [
        'expires' => 0,
        'httponly' => true,
        'secure' => !empty($_SERVER['HTTPS']),
        'samesite' => 'Lax'

    ];

    if ($recordarme) {
        setcookie("c_username", $usuario->getUsername(), $opciones);
        setcookie("c_recordarme", 1, $opciones);
    } else {
        setcookie("c_username", "", 0);
        setcookie("c_recordarme", "", 0);
    }

    header("Location: listar.php");
    exit;

}





