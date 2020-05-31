<?php
    include "config/config_dev.php";
    include "resource/funciones.php";
    include "class/DBAbstractModel.php";
    include "class/Usuario.php";
    include "class/Clave.php";
    include "class/Documento.php";
    include "class/error/UserExistException.php";
    include "class/error/PassCheckException.php";
    include "class/error/CheckOldPassException.php";
    include "class/error/MailInvalidException.php";
    include "class/error/MailExistException.php";
    include "class/error/TimeLimitException.php";
    require "phpmailer/class.phpmailer.php";

    session_start();

    if ( !isset($_SESSION['user']) ) { 
        $_SESSION['usuario']          = Usuario::singleton();
        $_SESSION['clave']            = Clave::singleton();
        $_SESSION['documento']        = Documento::singleton();

        $_SESSION['mailer']           = NULL;

        $_SESSION['user']             = array( 'perfil' => "invitado" );
    }

    include "include/procesa.php";
    
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Home</title>
</head>
<body>
    <header>
        <div>
            
        </div>
        <div class="title_header">
            <h1><a href="index.php">Secretaría Virtual</a></h1>
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
                if ( $_SESSION['user']['perfil'] == "admin" ) 
                    include "include/nav.php";
                elseif ( $_SESSION['user']['perfil'] == "user" && $_SESSION['user']['estado'] == "activo" )
                    include "include/nav_user.php";
            ?>
        </nav>
        <main>
            <div class="contenedor">
                <?php
                    include "include/controller.php";
                ?>
            </div>
        </main>
    </div>
    <footer>
        <?php
            include "include/footer.php";
        ?>
    </footer>
</body>
</html>