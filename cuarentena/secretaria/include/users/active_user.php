<?php
    /**
     * Este script permite activar el perfil usuario de la secretaría vritual.
     */
    
    if ( !isset($_SESSION['user']) || $_SESSION['user']['perfil'] !== "admin" ) {
        header('Location:index.php');
    }

    //Creamos directorio y actualizamos estado a activo
    $_SESSION['usuario']->activarPerfil( $_GET['activar'] );    //Crea carpeta del usuario y actualiza perfil
        
    $usuario = $_SESSION['usuario']->getUserById( $_GET['activar'] )[0];

    //Generamos claves y las amacenamos en un fichero y en la BD
    $_SESSION['clave']->crearClaves( $usuario['id'], "users/".$usuario['directorio']."/" );

    //Mandamos el fichero al usuario
    $mail = $_SESSION['mail']->enviarMail(
        $usuario['email'],
        $usuario['nombre'],
        "developerdaw86@gmail.com",
        "Administración Secretaría Virtual",
        "Solicitud de registro aceptada",

        "<h1 style='text-align: center;'>Solicitud de registro aceptada</h1>
        
        <p style='text-align: justify;'>Estimado/a ".$usuario['nombre']." ".$usuario['apellidos'].", le informamos 
        que su solicitud de registro en la secretaría virtual ha sido aceptada y su perfil dado de alta.</p>
        
        <p style='text-align: justify;'><b>Por favor conserve el fichero adjunto para la validación de sus firmas digitales</b>, 
        en caso de perderlo o considerar que sus claves están comprometidas <u>podrá solicitar un nuevo juego de claves desde su perfil 
        de la Secretaría Virtual</u>.</p>",
        
        "users/".$usuario['directorio']."/clave.txt"
    );

    //Si el correo se manda con éxito borramos el fichero de claves del sistema
    if ( $mail )
        unlink( "users/".$usuario['directorio']."/clave.txt" );

    header('Location:index.php?usuarios');
?>