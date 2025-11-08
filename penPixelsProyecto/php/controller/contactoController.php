<?php
session_start();
include "../clases/Contacto.php";



if ($_SESSION["login"] == false) {
    header("location: ../paginas/contacto.php?error=1");  
    exit();  
} else if ($_POST["usuario"] == "" || $_POST["email"] == "" || $_POST["mensaje"] == "") {
    header("location: ../paginas/contacto.php?error=2");   
    exit();
} else if(strlen($_POST["mensaje"]) > 255) {
    header("location: ../paginas/contacto.php?error=3");   
    exit();
} else {
    $contacto = new Contacto();

    $contacto -> setUsuario($_POST["usuario"]);

    $contacto -> setCorreo($_POST["email"]);

    $contacto -> setMensaje($_POST["mensaje"]);

    $contacto -> contactar($contacto -> getUsuario(),
    $contacto -> getCorreo(), $contacto->getMensaje());
    header("location: ../paginas/index.php?mensaje=2");
    exit();  
}