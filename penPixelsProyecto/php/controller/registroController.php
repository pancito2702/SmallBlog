<?php

include "../clases/Usuario.php";

$usuarioRepetido = Usuario::seleccionarUsuarioRepetido($_POST["usuario"]);
$correoRepetido = Usuario::seleccionarCorreoRepetido($_POST["correo"]);

if ($_POST["usuario"] == "" || $_POST["nombre"] == "" || $_POST["primerApellido"] == ""||
$_POST["segundoApellido"] == "" || $_POST["contra"] == "" || $_POST["correo"] == "") {
    header("location: ../paginas/registro.php?error=1");
    exit();
} else if (strlen($_POST["usuario"]) > 20) {
    header("location: ../paginas/registro.php?error=2");
    exit();
} else if (strlen($_POST["nombre"]) > 20) {
    header("location: ../paginas/registro.php?error=3");
    exit();
} else if (strlen($_POST["primerApellido"]) > 20) {
    header("location: ../paginas/registro.php?error=4");
    exit();
} else if (strlen($_POST["segundoApellido"]) > 20) {
    header("location: ../paginas/registro.php?error=5");
    exit();
} else if (strlen($_POST["contra"]) > 20) {
    header("location: ../paginas/registro.php?error=6");
    exit();
} else if (strlen($_POST["correo"]) > 50) {
    header("location: ../paginas/registro.php?error=7");
    exit();
} else if ($usuarioRepetido == true) {
    header("location: ../paginas/registro.php?error=8");
    exit();
} else if ($correoRepetido == true) {
    header("location: ../paginas/registro.php?error=9");
    exit();
}  else {
    $usuario = new Usuario();

    $usuario -> setUsuario($_POST["usuario"]);

    $usuario -> setNombre($_POST["nombre"]);

    $usuario -> setPrimerApellido($_POST["primerApellido"]);

    $usuario -> setSegundoApellido($_POST["segundoApellido"]);

    $usuario -> setContra($_POST["contra"]);

    $usuario -> setCorreo($_POST["correo"]);

    $usuario -> registro($usuario -> getUsuario(), $usuario -> getNombre(), 
    $usuario -> getPrimerApellido(),  $usuario -> getSegundoApellido(),
    $usuario -> getContra(), $usuario -> getCorreo());
   
    header("location: ../paginas/registro.php?correcto=1");

    exit();
}



