<?php
    include "config/config_dev.php";
    include "resource/funciones.php";
    include "class/DBAbstractModel.php";
    include "class/Libro.php";
    include "class/Usuario.php";

    session_start();

    if ( isset($_POST['add_user']) ) {
        if ( $_POST['pass'] == $_POST['pass2'] ) {
            if ( sizeof( $_SESSION['usuario']->get( $_POST['user'] ) ) == 0 ) {
                $user_data = array(
                    'user' => limpiarDatos($_POST['user']),
                    'pass' => limpiarDatos($_POST['pass']),
                    'perfil' => "lector",
                    'estado' => "pendiente",
                    'nombre' => limpiarDatos($_POST['nombre']),
                    'apellidos' => limpiarDatos($_POST['apellidos']),
                    'dni' => limpiarDatos($_POST['dni']),
                    'telefono' => limpiarDatos($_POST['telefono']),
                    'email' => limpiarDatos($_POST['email']),
                    'img' => ( ($_POST['img'] == "") ? null : limpiarDatos($_POST['img']) ),
                );
                $_SESSION['usuario']->set( $user_data );
            } else {
                //nick usuario no disponible
            }

        } else {
            //la contraseña y su verificación no coinciden
        }
        
    }

    if (isset($_POST['cerrar'])) {
        cerrarSesion();
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Libros</title>
</head>
<body>
    <header>
        <div>
            
        </div>
        <div class="title_header">
            <h1><a href="index.php">Biblioteca</a></h1>
        </div>
        <div class="login">
            <?php
                if ( $_SESSION['user']['perfil'] == "invitado" ) 
                    include "include/login.php";
                else 
                    include "include/exit.php";
            ?>
        </div>
    </header>
    <div class="cuerpo">
        <nav>
            <?php
                if ( $_SESSION['user']['perfil'] == "administrador" )
                    include "include/nav.php";
            ?>
        </nav>
        <main>
            <div class="contenedor">
                <?php 
                    include "include/users/new_user.php";
                ?>
            </div>
        </main>
    </div>
    <footer>
        <h4>RRSS del autor:</h4>
        <div class="rrss">
            <a href="https://twitter.com/Fco_Javier_Glez" target="_blank"><img src="img/twitter.png" alt="Enlace a cuenta de Twitter del autor"></a>
            <a href="https://github.com/FcoJavierGlez" target="_blank"><img src="img/github.png" alt="Enlace a cuenta de GitHub del autor"></a>
            <a href="https://www.linkedin.com/in/francisco-javier-gonz%C3%A1lez-sabariego-51052a175/" target="_blank"><img src="img/linkedin.png" alt="Enlace a cuenta de Linkedin del autor"></a>
        </div>
    </footer>
</body>
</html>