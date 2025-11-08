<?php

session_start();
include "../clases/Articulo.php";
if ($_POST["titulo"] == "" || $_POST["contenido"] == "") {
    header("location: ../paginas/index.php?mensaje=15"); 
    exit();  
} else if (strlen($_POST["titulo"]) > 255) {
        header("location: ../paginas/index.php?mensaje=16");    
        exit();
} else if (strlen($_POST["imagen"]) > 255) {
        header("location: ../paginas/index.php?mensaje=17");    
        exit();
} else { 

$articulo = new Articulo();

$articulo->setIdPost($_POST["idPost"]);

$articulo->setEncabezado($_POST["titulo"]);

$articulo->setContenido($_POST["contenido"]);

$articulo->setFechaPublicacion(date('Y-m-d'));

$articulo->setImagen($_POST["imagen"]);

$articulo->actualizarPost(
    $articulo->getEncabezado(),
    $articulo->getContenido(),
    $articulo->getFechaPublicacion(),
    $articulo->getImagen(),
    $articulo->getIdPost()
);
header("location: ../paginas/index.php");
exit();
}