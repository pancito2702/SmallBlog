<?php
include "../clases/Comentario.php";
session_start();


$comentario = new Comentario();
$pertenece = Comentario::verSiComentarioPerteneceUsuario($_SESSION["usuario"], $_POST["idComentario"]); 

if ($_SESSION["login"] == false) {
    header("location: ../paginas/articulo.php?idPost=".$_SESSION["idPost"]."&mensaje=4"); 
    exit();
}  else if ($pertenece == false) {
    header("location: ../paginas/articulo.php?idPost=".$_SESSION["idPost"]."&mensaje=5"); 
    exit();
}  else {
    $comentario -> eliminarComentario($_POST["idComentario"]);
    header("location: ../paginas/articulo.php?idPost=".$_SESSION["idPost"].""); 
    exit();
}
