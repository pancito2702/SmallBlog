<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../../css/crearArticuloStyle.css">
    <meta charset="UTF-8">
    <title>Pen and Pixels - Crear Artículo</title>
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

    <main>

        <h2>Crear Artículo</h2>
        <form action="../controller/crearArticuloController.php" method="post">
            <div>
                <label for="titulo">Título:</label>
                <input type="text" id="titulo" name="titulo" placeholder="Ingrese el título del artículo">

                <label for="contenido">Contenido:</label>
                <textarea id="contenido" name="contenido" placeholder="Ingrese el contenido del artículo"
                    ></textarea>

                <label for="imagen">URL de Imagen:</label>
                <input type="text" id="imagen" name="imagen" placeholder="Ingrese el URL de la imagen">

                

                <button type="submit">Enviar</button>
            </div>
        </form>
        
    </main>
    <?php
       
        if (isset($_GET["error"])) {
            switch ($_GET["error"]) {
                case "1":
                    echo "<p class='p-error-crearArt'> Primero debe loguearse </p>";
                break;
                case "2":
                    echo "<p class='p-error-crearArt'> Titulo o contenido vacios </p>";
                break;
                case "3":
                    echo "<p class='p-error-crearArt'> El titulo no puede contener mas de 255 caracteres </p>";
                break;
                case "4":
                    echo "<p class='p-error-crearArt'> El url de la imagen no puede contener mas de 255 caracteres </p>";
                break;
            }
       } 

       
    ?>
    <footer>
        <p>&copy; 2023 Pen and Pixels. Todos los derechos reservados.</p>
    </footer>
</body>

</html>