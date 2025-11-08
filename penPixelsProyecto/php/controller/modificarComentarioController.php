<?php

session_start();
include "../clases/Comentario.php";
if ($_POST["comentario"] == "") {
    header("location: ../paginas/index.php?mensaje=13"); 
    exit();  
} else if (strlen($_POST["comentario"]) > 255) {
    header("location: ../paginas/index.php?mensaje=14"); 
    exit();  
} else {
$comentario = new Comentario();
$comentario -> actualizarComentario($_POST["comentario"], $_POST["idComentario"]);
header("location: ../paginas/index.php");
exit();
}
