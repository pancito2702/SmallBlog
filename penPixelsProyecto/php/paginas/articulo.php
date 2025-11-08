<!DOCTYPE html>
<html lang="en">
<?php

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pen and Pixels - Artículo</title>
    <link rel="stylesheet" href="../../css/articulo.css">
    <script src="https://kit.fontawesome.com/273ce0a60c.js" crossorigin="anonymous"></script>
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
    <div class="container">

        <section>
            <?php
            include "../clases/Articulo.php";
            include "../clases/Like.php";

            $_SESSION["idPost"] = $_GET["idPost"];
            $articulo = Articulo::verPostEspecifico($_SESSION["idPost"]);

            //Bloquea el acceso a paginas que no existen
            if ($_SESSION["idPost"] != $articulo->getIdPost()) {
                header("location: ../paginas/index.php?mensaje=4");
                exit();
            } else if ($_GET["idPost"] == "") {
                header("location: ../paginas/index.php?mensaje=4");
                exit();
            }

            if (isset($_GET["mensaje"])) {
                switch ($_GET["mensaje"]) {
                    case "1":
                        echo  "<script> 
                    alert('Ya le dio like a este post');
                    </script>";
                        break;
                    case "2":
                        echo  "<script> 
                    alert('El comentario no puede estar vacio');
                    </script>";
                        break;
                    case "3":
                        echo  "<script> 
                    alert('El comentario no puede contener mas de 255 caracteres');
                    </script>";
                        break;
                    case "4":
                        echo  "<script> 
                        alert('Para borrar un comentario debe iniciar sesion');
                        </script>";
                        break;
                    case "5":
                        echo  "<script> 
                            alert('No puede borrar el comentario ya que no le pertenece');
                            </script>";
                        break;
                }
            }

            echo "<div>";
            echo "<h2>" . $articulo->getEncabezado() . "<h2>";
            echo "<h2> Artículo creado por el usuario: " . $articulo->getUsuario()  . "<h2>";
            echo "<h2> Artículo publicado la fecha " . $articulo->getFechaPublicacion()  . "<h2>";
            echo " <form action='../controller/likeController.php' id='form-like' method='post'>";
            echo "<input type='hidden' name='usuario' value=" . verUsuarioLogueado() . ">";
            echo "<input type='hidden' name='idPost' value=" . $_GET["idPost"] . ">";
            echo "<button type='submit'>";
            echo  comprobarLike();
            echo "</button>";
            echo "</form>";
            echo "</div>";
            echo "<p>" . $articulo->getContenido() . "</p>";
            // Si el articulo tiene imagen
            if ($articulo->getImagen() != "") {
                echo "<div id='div-img' style='background-image: url(" . $articulo->getImagen() . ");'>";
                echo "</div>";
            }

            function verUsuarioLogueado()
            {
                if (isset($_SESSION["usuario"])) {
                    return $_SESSION["usuario"];
                }
                return "";
            }

            function veridPostLogueado()
            {
                if (isset($_SESSION["idPost"])) {
                    return $_SESSION["idPost"];
                }
                return "";
            }


            function comprobarLike()
            {
                if (isset($_SESSION["login"])) {
                    if ($_SESSION["login"] == true) {
                        $estaLikeado = Like::buscarLike(veridPostLogueado(), verUsuarioLogueado());
                        if ($estaLikeado == true) {
                            return "<i id='like-activo' class='fa-solid fa-heart'></i>";
                        }
                    }
                }
                return "<i class='fa-solid fa-heart'></i>";
            }

            ?>

        </section>
        <section class="section-comentario">
            <div id="div-comentario">
                <div>
                    <h3 id="h3-agregar-comentario"> Agregar Comentario: </h3>
                </div>
                <form action="../controller/comentarioController.php" method="post">
                    <textarea placeholder="Ingrese comentario Aquí" name="comentario" id="textarea-comentario"></textarea>
                    <input type="hidden" name="usuario" value="<?php echo verUsuarioLogueado() ?>">
                    <input type="hidden" name="idPost" value="<?php echo veridPostLogueado() ?>">
                    <div id="div-button-comentario">
                        <button type="submit" id="boton-comentario"> Enviar Comentario </button>
                    </div>
                </form>

            </div>
        </section>
        <h2> Comentarios </h2>
        <?php
        include "../clases/Comentario.php";
        $comentarios = Comentario::verComentarios($_GET["idPost"]);
        foreach ($comentarios as $comentario) {
            echo "<div id='div-comentario'>";
                echo "<div id='div-comentario-titulo'>";
                    echo "<h3> " . $comentario->getUsuario() . " dice:" . "</h3>";
                echo "</div>";
                echo "<div>";
                    echo "<p>";
                    echo $comentario->getContenido();
                echo  "</p>";
                echo "</div>";
                echo "<div id='div-botones'>";
                    echo "<form action='../controller/eliminarComentarioController.php' id='form-comentario' method='post'>";
                        echo "<input type='hidden' value='" . $comentario->getIdComentario() . "' name='idComentario'>";
                        echo "<button type='submit' class='button-comentario'>
                        Eliminar Comentario
                        </button>";
                    echo "</form>";
                    echo "<a href='ModificarComentario.php?idComentario=" . $comentario->getIdComentario() . "'id='form-comentario''>
                    <button class='button-comentario'>
                    Modificar Comentario
                    </button>
                    </a>";
                echo "</div>";
            echo "</div>";
            echo "<br>";
        }
        ?>

    </div>
    <footer>
        <p>&copy; 2023 Pen and Pixels. Todos los derechos reservados.</p>
    </footer>
</body>

</html>