<?php
include "../clases/Usuario.php";


$usuario = Usuario::iniciarSesion($_POST["usuario"], $_POST["contra"]);

if ($_POST["usuario"] == "" || $_POST["contra"] == "") {
    header("location: ../paginas/login.php?error=1");   
    exit();
} else if ($usuario == null) {
    header("location: ../paginas/login.php?error=2");   
    exit();
} else {
    session_start();
    $_SESSION["login"] = true;
    $_SESSION["usuario"] = $usuario -> getUsuario();
    $_SESSION["nombre"] = $usuario -> getNombre();
    $_SESSION["primerApellido"] = $usuario -> getPrimerApellido();
    $_SESSION["segundoApellido"] = $usuario -> getSegundoApellido();
    $_SESSION["correo"] = $usuario -> getCorreo();
    
    header("location: ../paginas/index.php?mensaje=1");  
    exit();
}





