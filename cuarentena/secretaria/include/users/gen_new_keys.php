<?php
    //Borramos las claves actuales
    $_SESSION['clave']->borrarClaves( $_SESSION['user']['id'] );

    //Generamos claves y las amacenamos en un fichero y en la BD
    $_SESSION['clave']->crearClaves( $_SESSION['user']['id'], "users/".$_SESSION['user']['directorio']."/" );

    //Mandamos el fichero al usuario
    $mail = $_SESSION['mail']->enviarMail(
        $_SESSION['user']['email'],
        $_SESSION['user']['nombre'],
        "developerdaw86@gmail.com",
        "Administración Secretaría Virtual",
        "Recibo de nuevo juego de claves",

        "<h1 style='text-align: center;'>Recibo de nuevo juego de claves</h1>
        
        <p style='text-align: justify;'>Estimado/a ".$_SESSION['user']['nombre']." ".$_SESSION['user']['apellidos'].", 
        su petición de generar un nuevo juego de claves ha sido aceptada. 
        <b>Se le adjunta en este correo el fichero con su nuevo juego de claves</b>.</p>

        <p style='text-align: justify;'><b>Por favor conserve el fichero adjunto para la validación de sus firmas digitales</b>, 
        en caso de perderlo o considerar que sus claves están comprometidas <u>podrá solicitar un nuevo juego de claves desde su perfil 
        de la Secretaría Virtual</u>.</p>",

        "users/".$_SESSION['user']['directorio']."/clave.txt"
    );

    //Si el correo se manda con éxito borramos el fichero de claves del sistema
    if ( $mail )
        unlink( "users/".$_SESSION['user']['directorio']."/clave.txt" );
?>