<?php
session_start();
include "../clases/Comentario.php";


if($_SESSION["login"] == false) {
    header("location: ../paginas/index.php?mensaje=6");  
    exit();
} else if ($_POST["comentario"] == "") {
    header("location: ../paginas/articulo.php?idPost=".$_SESSION["idPost"]."&mensaje=2"); 
    exit();
} else if (strlen($_POST["comentario"]) > 255) {
    header("location: ../paginas/articulo.php?idPost=".$_SESSION["idPost"]."&mensaje=3"); 
    exit();
} else {
    $comentario = new Comentario();
    $comentario -> setUsuario($_POST["usuario"]);
    $comentario -> setIdPost($_POST["idPost"]);
    $comentario -> setContenido($_POST["comentario"]);
    $comentario -> comentar($comentario -> getUsuario(), $comentario -> getIdPost(),
    $comentario -> getContenido());
    header("location: ../paginas/articulo.php?idPost=".$_SESSION["idPost"]); 
}