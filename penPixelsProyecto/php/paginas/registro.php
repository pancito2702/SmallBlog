<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pen and Pixels - Registro</title>
    <link rel="stylesheet" href="../../css/registro.css">
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
        <form action="../controller/registroController.php" method="post">
            <h1> Registro de Usuario </h1>
            <label for="usuario"> Usuario </label>
            <input type="text" placeholder="Usuario" name="usuario" id="usuario">
            
            <label for="nombre"> Nombre </label>
            <input type="text" placeholder="Nombre" name="nombre" id="nombre">

            <label for="primApe"> Primer Apellido </label>
            <input type="text" placeholder="Primer Apellido" name="primerApellido" id="primApe">

            <label for="segApe"> Segundo Apellido </label>
            <input type="text" placeholder="Segundo Apellido" name="segundoApellido" id="usuario">

            <label for="pass"> Contraseña </label>
            <input type="text" placeholder="Contraseña" name="contra" id="pass">

            <label for="Correo"> Correo </label>
            <input type="email" placeholder="Correo" name="correo" id="Correo">

            <button type="submit">
                 Registrarse
            </button>
        </form>
 
    </section>

    <?php
 
        if(isset($_GET["correcto"])) {
            if ($_GET["correcto"] == 1) {

                echo "<p class='p-registro'> Registro Completado con Exito </p>";
            }  
        } 
        if(isset($_GET["error"])) {
            switch ($_GET["error"]) {
                case "1":
                    echo "<p class='p-registro'> Hay campos vacios </p>";
                    break;
                case "2":
                    echo "<p class='p-registro'> El campo de usuario no puede contener mas de 20 caracteres </p>";
                    break;
                case "3":
                    echo "<p class='p-registro'> El campo de nombre no puede contener mas de 20 caracteres </p>";
                    break;
                case "4":
                    echo "<p class='p-registro'> El campo de primer apellido no puede contener mas de 20 caracteres </p>";
                    break;
                case "5":
                    echo "<p class='p-registro'> El campo de segundo apellido no puede contener mas de 20 caracteres </p>";
                    break;
                case "6":
                    echo "<p class='p-registro'> El campo de contraseña no puede contener mas de 20 caracteres </p>";
                    break;
                case "7":
                    echo "<p class='p-registro'> El campo de correo no puede contener mas de 50 caracteres </p>";
                    break;   
                case "8":
                    echo "<p class='p-registro'> El usuario ya se encuentra registrado </p>";
                    break;
                case "9":
                    echo "<p class='p-registro'> El correo ya se encuentra registrado </p>";
                    break;             
            }  
        }
    ?>
    <footer>
        <p>&copy; 2023 Pen and Pixels. Todos los derechos reservados.</p>
    </footer>


   
</body>
</html>