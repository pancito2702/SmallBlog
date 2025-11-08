<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pen and Pixels - Iniciar Sesión</title>
    <link rel="stylesheet" href="../../css/iniciarSesion.css">
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
        <form action="../controller/loginController.php" method="post">
            <h1> Iniciar Sesión </h1>
            <label for="usuario"> Usuario <i class="fa fa-user" aria-hidden="true"></i> </label>
            <input type="text" placeholder="Usuario" name="usuario" id="usuario">

            <label for="contra"> Contraseña <i class="fa fa-lock"></i> </label>
            <input type="text" placeholder="Usuario" name="contra" id="contra">

            <button type="submit">
                Iniciar Sesión
            </button>
        </form>
    </section>
    <?php
        if(isset($_GET["error"])) {
            switch ($_GET["error"]) {
                case "1":
                    echo "<p class='p-login'> Hay campos vacios </p>";
                    break;
                case "2":
                    echo "<p class='p-login'> Usuario o contraseña incorrectos </p>";
                    break;          
            }  
        }
     

    ?>
    <footer>
        <p>&copy; 2023 Pen and Pixels. Todos los derechos reservados.</p>
    </footer>

    
</body>
</html>