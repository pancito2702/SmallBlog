<?php

session_start();
include "../clases/Articulo.php";


$articulo = new Articulo();

$pertenece = Articulo::verSiPostPerteneceUsuario($_SESSION["usuario"], $_POST["idPost"]); 

if ($_SESSION["login"] == false) {
    header("location: ../paginas/index.php?mensaje=7");    
    exit();
} else if ($pertenece == false) {
    header("location: ../paginas/index.php?mensaje=8");    
    exit();
} else {
    $articulo -> eliminarPost($_POST["idPost"]);
    header("location: ../paginas/index.php");    
    exit();
}
