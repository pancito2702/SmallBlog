<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../../css/crearArticuloStyle.css">
    <meta charset="UTF-8">
    <title>Pen and Pixels - Modificar Articulo</title>
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

        <h2>Modificar Articulo</h2>
        <?php
        include "../clases/Articulo.php";
        $_SESSION["idPost"] = $_GET["idPost"];
        $articulo = Articulo::verPostEspecifico($_SESSION["idPost"]);
        $pertenece = Articulo::verSiPostPerteneceUsuario($_SESSION["usuario"], $_SESSION["idPost"]);
        if (isset($_SESSION["login"]) == false) {
            header("location: ../paginas/index.php?mensaje=9");
        } else if ($_SESSION["idPost"] != $articulo->getIdPost()) {
            header("location: ../paginas/index.php?mensaje=4");
            exit();
        } else if ($_GET["idPost"] == "") {
            header("location: ../paginas/index.php?mensaje=4");
            exit();
        } else if ($pertenece == false) {
            header("location: ../paginas/index.php?mensaje=10");
            exit();
        }

        if (isset($_GET["mensaje"])) {
            switch ($_GET["mensaje"]) {
                case "1":
                    echo  "<script> 
                alert('Titulo o encabezado vacios');
                </script>";
                break;
            }
        }

        echo "<form action='../controller/modificarArticuloController.php' method='post'>";
        echo "<div>";
        echo "<label for='titulo'>Título:</label>";
        echo "<input type='text' id='titulo' value='" . $articulo->getEncabezado() . "' name='titulo' placeholder='Ingrese el título del artículo'>";

        echo "<label for='contenido'>Contenido:</label>";
        echo "<textarea id='contenido' name='contenido' placeholder='Ingrese el contenido del artículo'>" . $articulo->getContenido() . "</textarea>";

        echo "<label for='imagen'>URL de Imagen:</label>";
        echo "<input type='text' id='imagen' value='" . $articulo->getImagen() . "' name='imagen' placeholder='Ingrese el URL de la imagen'>";

        echo "<input type='hidden' name='idPost' value='" . $articulo->getIdPost() . "'>";
        echo "<button type='submit'>Enviar</button>";
        echo "</div>";
        echo "</form>";
        ?>
    </main>
    <?php

 

    ?>
    <footer>
        <p>&copy; 2023 Pen and Pixels. Todos los derechos reservados.</p>
    </footer>
</body>

</html>