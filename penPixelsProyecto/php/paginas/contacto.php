<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Pen and Pixels - Contacto</title>
    <link rel="stylesheet" href="../../css/contacto.css">
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
        <h2>Contacto</h2>
        <p>¿Tienes alguna pregunta, comentario o sugerencia? ¡No dudes en ponerte en contacto con nosotros!</p>

        <form action="../controller/contactoController.php" method="post">
            <label for="usuario">Usuario:</label>
            <input type="text" id="usuario" name="usuario" placeholder="Ingrese su usuario"
            value="<?php echo comprobarUsuarioLogueado() ?>" readonly="readonly">

            <label for="email">Correo electrónico:</label>
            <input type="email" id="email" name="email" placeholder="Ingrese su correo electrónico"
            value="<?php echo comprobarCorreoLogueado() ?>" readonly="readonly">

            <label for="mensaje">Mensaje:</label>
            <textarea id="mensaje" name="mensaje" placeholder="Escriba su mensaje aquí"></textarea>

            <button type="submit" onclick="mostrarError()">Enviar</button>
        </form>
    </main>

    <?php
       if (isset($_GET["error"])) {
            switch ($_GET["error"]) {
                case "1":
                    echo "<p class='p-contacto-error'> Primero debe loguearse </p>";
                break;
                case "2":
                    echo "<p class='p-contacto-error'> Hay campos vacios </p>";
                break;
                case "3":
                    echo "<p class='p-contacto-error'> El mensaje no puede contener mas de 255 caracteres </p>";
                break;
                
            }
       } 
       //Comprueba que el usuario este logueado y que sea diferente a null
       function comprobarUsuarioLogueado() {
            if(isset($_SESSION["usuario"])) {
                return $_SESSION["usuario"];
            }
            return "";
       }
        //Comprueba que el correo del usuario este presente y que sea diferente a null
        function comprobarCorreoLogueado() {
            if(isset($_SESSION["correo"])) {
                return $_SESSION["correo"];
            }
            return "";
        }
    ?>

    <footer>
        <p>&copy; 2023 Pen and Pixels. Todos los derechos reservados.</p>
    </footer>
</body>

</html>