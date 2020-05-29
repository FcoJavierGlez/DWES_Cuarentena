<?php
    include "config/config_dev.php";
    include "resource/funciones.php";
    include "class/DBAbstractModel.php";
    include "class/Usuario.php";
    include "class/Clave.php";
    include "class/Mail.php";
    include "class/error/UserExistException.php";
    include "class/error/PassCheckException.php";

    header('Content-Type: text/html; charset=utf-8');

    session_start();

    $addNickExist = false;      //Al añadir usuario, el nick está registrado
    $checkPassError = false;    //Al verificar pass y su validación
    $die = false;
    $dee = false;


    $newUser = false;

    if ( !isset($_SESSION['user']) ) { 
        $_SESSION['usuario'] = Usuario::singleton();
        $_SESSION['clave'] = Clave::singleton();
        $_SESSION['mail'] = new Mail();

        $_SESSION['mail']->enviarMail();

        $_SESSION['user'] = array(
            'perfil' => "invitado"
        );
    }
    
    if ( isset($_POST['login']) ) {
        $usuario = $_SESSION['usuario']->getUserByNick( limpiarDatos($_POST['user']) );
        if ( sizeof($usuario) && $usuario[0]['pass'] == limpiarDatos($_POST['pswd']) ) 
            $_SESSION['user'] = $usuario[0];
    }

    if ( isset($_POST['cerrar']) ) {
        cerrarSesion();
    }

    if ( isset($_POST['add_user']) ) {
        $user_data = array (
            'nick' => limpiarDatos($_POST['nick']),
            'pass' => limpiarDatos($_POST['pass']),
            'pass2' => limpiarDatos($_POST['pass2']),
            'nombre' => limpiarDatos($_POST['nombre']),
            'apellidos' => limpiarDatos($_POST['apellidos']),
            'email' => limpiarDatos($_POST['email']),
        );

        try {
            $_SESSION['usuario']->setUser( $user_data );
            $newUser = true;
        }
        catch (UserExistException $addNickExist) {}
        catch (PassCheckException $checkPassError) {}
    }

    if ( isset( $_GET['activar'] ) ) {
        include "include/users/active_user.php";
    }
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
                    if ( isset($_GET['register']) ) {                     //Si se accede al registro
                        if ( $newUser )
                            include "include/users/new_user_ok.php";
                        else
                            include "include/users/new_user.php";
                    } 
                    elseif ( isset($_GET['usuarios']) )                   //Acceder a usuarios
                        include "include/users/info_user.php";
                    elseif ( isset($_GET['documentos']) )                 //Documentos
                        include "include/documents/own_documents.php";
                    elseif ( isset($_GET['perfil']) )                     //Perfil
                        include "include/users/own_user.php";
                    else
                        include "include/main.php";
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