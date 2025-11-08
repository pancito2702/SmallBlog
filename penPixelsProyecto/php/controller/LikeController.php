<?php
session_start();

include "../clases/Like.php";

$like = new Like();

$like -> setIdPost($_POST["idPost"]);
$like -> setUsuario($_POST["usuario"]);
$like -> setEstado(1);
$likeRepetido = Like::buscarLikeRepetido($_POST["idPost"], $_POST["usuario"]);

if($_SESSION["login"] == false) {
    header("location: ../paginas/index.php?mensaje=5");  
    exit();
} else if ($likeRepetido == true) {
    header("location: ../paginas/articulo.php?idPost=".$_SESSION["idPost"]."&mensaje=1"); 
    exit();
} else {
    $like -> darLike($like -> getIdPost(), $like -> getUsuario(), $like -> getEstado());
    header("location: ../paginas/articulo.php?idPost=".$_SESSION["idPost"]); 
    exit();
}

