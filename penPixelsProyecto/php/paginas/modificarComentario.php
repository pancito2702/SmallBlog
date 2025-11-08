<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../../css/modificarComentario.css">
    <meta charset="UTF-8">
    <title>Pen and Pixels - Modificar Comentario</title>
</head>

<body>
    <header>
        <h1>Pen and Pixels</h1>
        <nav>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="crearArticulo.php">Crear Artículo</a></li>
                <li><a href="acercaDe.php">Acerca de</a></li>
                <li><a href="contacto.php">Contacto</a></li>
                <li><a href="registro.php">Registro</a></li>
                <li><a href="login.php">Iniciar Sesión</a></li>
                <?php
                session_start();

                if (isset($_SESSION["usuario"])) {
                    echo "<li> Usuario: " . $_SESSION["usuario"] . "</li>";
                    echo "<li><a href='../controller/logoutController.php' >Cerrar Sesión </a></li>";
                }
                ?>
            </ul>
        </nav>
    </header>

    <main>

        <?php
        include "../clases/Comentario.php";
        $pertenece = Comentario::verSiComentarioPerteneceUsuario($_SESSION["usuario"], $_GET["idComentario"]);
        $comentario = Comentario::verComentarioEspecifico($_GET["idComentario"]);
       
        if (isset($_SESSION["login"]) == false) {
            header("location: ../paginas/index.php?mensaje=11");
            exit();
        } else if ($_GET["idComentario"] != $comentario -> getIdComentario()) {
            header("location: ../paginas/index.php?mensaje=4");
        } else if ($_GET["idComentario"] == "") {
            header("location: ../paginas/index.php?mensaje=4");
        } else if ($pertenece == false) {
            header("location: ../paginas/index.php?mensaje=12");
            exit();
        }

       

        echo "<section class='section-comentario'>";
            echo "<div id='div-comentario'>";
                echo "<div>";
                    echo "<h3 id='h3-agregar-comentario'> Modificar Comentario: </h3>";
                echo "</div>";
                echo "<form action='../controller/modificarComentarioController.php' method='post'>";
                    echo "<textarea placeholder='Ingrese comentario Aquí' name='comentario' id='textarea-comentario'> ".$comentario -> getContenido()."</textarea>";
                    echo "<input type='hidden' name='idComentario' value='". $comentario->getIdComentario()."'>";
                    echo "<div id='div-button-comentario'>";
                        echo "<button type='submit' id='boton-comentario'> Enviar Comentario </button>";
                    echo "</div>";
                echo "</form>";
            echo "</div>";
        echo "</section>";
        ?>
    </main>

    <footer>
        <p>&copy; 2023 Pen and Pixels. Todos los derechos reservados.</p>
    </footer>
</body>


</html>