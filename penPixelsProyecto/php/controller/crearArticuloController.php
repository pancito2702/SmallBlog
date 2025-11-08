<?php 

include "../clases/Articulo.php";

session_start();

if ($_SESSION["login"] == false) {
    header("location: ../paginas/crearArticulo.php?error=1");    
    exit();
} else if ($_POST["titulo"] == "" || $_POST["contenido"] == "") {
    header("location: ../paginas/crearArticulo.php?error=2");    
    exit();
} else if (strlen($_POST["titulo"]) > 255) {
        header("location: ../paginas/crearArticulo.php?error=3");    
        exit();
} else if (strlen($_POST["imagen"]) > 255) {
        header("location: ../paginas/crearArticulo.php?error=4");    
        exit();    
} else {
    $articulo = new Articulo();

    $articulo -> setEncabezado($_POST["titulo"]);

    $articulo -> setContenido($_POST["contenido"]);

    $articulo -> setFechaPublicacion(date('Y-m-d'));

    $articulo -> setUsuario(comprobarUsuario());

    $articulo -> setImagen($_POST["imagen"]);

    $articulo -> agregarPost($articulo -> getEncabezado(), $articulo -> getContenido(),
    $articulo -> getFechaPublicacion(), $articulo -> getUsuario(), $articulo -> getImagen());
    header("location: ../paginas/index.php?mensaje=3");    
    exit();
}

//Comprueba que el usuario este logueado y que sea diferente a NULL
function comprobarUsuario() {
    if (isset($_SESSION["usuario"])) {
        return $_SESSION["usuario"];
    }
    return "";
}

