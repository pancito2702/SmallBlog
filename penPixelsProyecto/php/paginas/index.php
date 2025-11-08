<!DOCTYPE html>
<?php
    include "../clases/Articulo.php"
?>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../css/indexStyle.css">
    <title>Pen and Pixels - Blog</title>
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
                        echo "<li> Usuario: ". $_SESSION["usuario"]. "</li>";
                        echo "<li><a href='../controller/logoutController.php' >Cerrar Sesión </a></li>";
                    }
                ?>
            </ul>
        </nav>
    </header>
    <section>
        
     
    
    </section>
    <main>
        <?php
            $posts = Articulo::verPosts();

            foreach ($posts as $post) { 
            echo "<article>";   
                echo "<h2>".$post -> getEncabezado()."</h2>";
                echo "<p>" .substr($post -> getContenido(), 0, 1500)."..."."</p>"; 
                echo "<div id='div-flex'>";
                echo "<a href='ModificarArticulo.php?idPost=".$post -> getIdPost()."' id='a-article'>
                <button class='button-article'>
                  Modificar Articulo
                </button>
                </a>";
                echo "<a href='articulo.php?idPost=".$post -> getIdPost()."' id='a-article'>
                <button class='button-article'>
                  Ver Artículo
                </button>
                </a>";
                echo "<form action='../controller/eliminarArticuloController.php' id='a-article' method='post'>";
                echo "<input type='hidden' name='idPost' value='". $post -> getIdPost()."'>";
                echo "<button type='submit' class='button-article'>
                  Eliminar Artículo
                </button>";
                echo "</form>";
                echo "</div>";
                echo "</article>";
            }
        ?>
    </main>

        <?PHP
            if (isset($_GET["mensaje"])) {
                switch ($_GET["mensaje"]) {
                    case "1":
                        echo  "<script> 
                            alert('Sesion Iniciada con Exito');
                        </script>";
                    break;

                    case "2":
                        echo  "<script> 
                            alert('Mensaje Enviado Correctamente');
                        </script>";
                    break;
                    case "3":
                        echo  "<script> 
                            alert('Post Creado Correctamente');
                        </script>";
                    break;
                    case "4":
                        echo  "<script> 
                            alert('Pagina no existe');
                        </script>";
                    break;
                    case "5":
                        echo  "<script> 
                            alert('Para dar like a un post debe iniciar sesion');
                        </script>";
                    break;
                    case "6":
                        echo  "<script> 
                            alert('Para comentar un post debe iniciar sesion');
                        </script>";
                    break;
                    case "7":
                        echo  "<script> 
                            alert('Para eliminar un articulo debe iniciar sesion');
                        </script>";
                    break;
                    case "8":
                        echo  "<script> 
                            alert('Este post no le pertenece, por lo que no lo puede borrar');
                        </script>";
                    break;
                    case "9":
                        echo  "<script> 
                            alert('Para modificar un articulo debe iniciar sesion');
                        </script>";
                    break;
                    case "10":
                        echo  "<script> 
                            alert('Este post no le pertenece por lo que no se puede modificar');
                        </script>";
                    break;
                    case "11":
                        echo  "<script> 
                            alert('Para modificar un comentario debe iniciar sesion');
                        </script>";
                    break;
                    case "12":
                        echo  "<script> 
                            alert('Este comentario no le pertenece, por lo que no le puede modificar');
                        </script>";
                    break;
                    case "13":
                        echo  "<script> 
                            alert('El comentario a modificar no puede estar vacio');
                        </script>";
                    break;
                    case "14":
                        echo  "<script> 
                            alert('El comentario a modificar no puede contener mas de 255 caracteres');
                        </script>";
                    break;
                    case "15":
                        echo  "<script> 
                            alert('El titulo o contenido del articulo a modificar no puede estar vacio');
                        </script>";
                    break;
                    case "16":
                        echo  "<script> 
                            alert('El titulo del articulo a modificar no puede contener mas de 255 caracteres');
                        </script>";
                    break;
                    case "17":
                        echo  "<script> 
                            alert('La imagen del articulo a modificar no puede contener mas de 255 caracteres');
                        </script>";
                    break;

                }
            } 
        ?>

    <footer>
        <p>&copy; 2023 Pen and Pixels. Todos los derechos reservados.</p>
    </footer>

   
</body>

</html>