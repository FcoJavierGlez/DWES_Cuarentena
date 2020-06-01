<?php
    /**
     * Este script permite activar el perfil usuario de la secretaría vritual.
     */
    
    if ( !isset($_SESSION['user']) || $_SESSION['user']['perfil'] !== "admin" ) {
        header('Location:index.php');
    }

    $usuario = $_SESSION['usuario']->getUserById( $_GET['bloquear'] )[0];

    $user_data = array(
        'id' => $usuario['id'],
        'estado' => "bloqueado",
        'directorio' => $usuario['directorio']
    );

    $_SESSION['usuario']->editEstado( $user_data );

    header('Location:index.php?usuarios');
?>