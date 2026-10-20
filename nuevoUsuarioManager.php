<?php

session_start();

require_once __DIR__ . '/UsuarioDAO.php';

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: cerrarsesion.php");
    exit;

}

if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] == false) {
    header('Location: index.php');
    exit;
}

if ($_SESSION['username'] !== 'admin') {
    header('Location: cerrarsesion.php');
    exit;

}

$usuarioDAO = new usuarioDAO();

# 0 ---> FALTAN DATOS

# SI FALTAN DATOS, SE REDIRIGE A registrarUsuario.php con una SESION para mostrar: "Debe ingresar todos los datos"

$username = is_string($_POST["username"] ?? null) ? $_POST["username"] : "";
$password = is_string($_POST["password"] ?? null) ? $_POST["password"] : "";

if ($username === "" || $password === "") {
    $_SESSION["errorCode"] = '0';
    header("Location: registrarUsuario.php");
    exit;
}


// Verificar si el usuario ya existe
if ($usuarioDAO->findByUsername($username) !== null) {
    $_SESSION["errorCode"] = '1'; // 1 ---> Usuario ya existe
    header("Location: registrarUsuario.php");
    exit;
}

// Registrar el nuevo usuario
$creado = $usuarioDAO->insertar($username, $password);

if ($creado) {
    $_SESSION["successMsg"] = "Usuario creado exitosamente.";
    header("Location: registrarUsuario.php");
    exit;
} else {
    $_SESSION["errorCode"] = '2'; // 2 ---> Error al guardar en base de datos
    header("Location: registrarUsuario.php");
    exit;
}

