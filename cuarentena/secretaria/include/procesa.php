<?php
    $nickExist      = false;        //El nick está registrado
    $checkPassError = false;        //Al verificar pass y su validación
    $oldPassError   = false;        //Al verificar la vieja contraseña no coincide
    $mailInvalido   = false;        //El email no posee el formato correcto
    $mailExistente  = false;        //El email ya está registrado

    $newUser        = false;        //Registro de usuario realizado
    $newFile        = false;        //Fichero subido correctamente

    $edit_perfil_ok = false;        //Perfil editado correctamente
    $edit_pass_ok   = false;        //Cambio de contraseña correcto

    $signInvalid    = false;        //Firma invalida
    
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
        catch (UserExistException $nickExist) {}
        catch (PassCheckException $checkPassError) {}
        catch (MailInvalidException $mailInvalido) {}
        catch (MailExistException $mailExistente) {}
    }

    if ( isset($_POST['up_perfil']) ) {         //Editar perfil
        $user_data = array(
            'id' => $_SESSION['user']['id'],
            'nombre' => $_POST['nombre'],
            'apellidos' => $_POST['apellidos'],
            'email' => $_POST['email']
        );

        try {
            $_SESSION['usuario']->editUser( $user_data );

            $_SESSION['user']['nombre'] = $user_data['nombre'];
            $_SESSION['user']['apellidos'] = $user_data['apellidos'];
            $_SESSION['user']['email'] = $user_data['email'];

            $edit_perfil_ok = true;
        }
        catch (UserExistException $nickExist) {}
        catch (MailInvalidException $mailInvalido) {}
        catch (MailExistException $mailExistente) {}
    }

    if ( isset($_POST['change_pass']) ) {       //Cambiar contraseña
        $user_data = array(
            'id' => $_SESSION['user']['id'],
            'old_pass' => $_POST['old_pass'],
            'new_pass' => $_POST['new_pass'],
            'new_pass2' => $_POST['new_pass2']
        );

        try {
            $_SESSION['usuario']->editPass( $user_data );

            $edit_pass_ok = true;
        }
        catch (CheckOldPassException $oldPassError) {}
        catch (PassCheckException $checkPassError) {}
    }

    if ( isset($_POST['cancel_up_perfil']) || isset($_POST['cancel_pass']) ) {  //Cancelar editar perfil o contraseña
        header('Location:index.php?perfil');
    }

    if ( isset( $_GET['activar'] ) ) {              //Activar un usuario
        include "include/users/active_user.php";
    }

    if ( isset($_POST['add_document']) ) {          //Añadir un documento
        $newFile = $_SESSION['documento']->subirFichero( $_SESSION['user'], $_FILES['fichero'], $_POST['descripcion']);
    }

    if ( isset($_POST['sign']) ) {                  //Firmar un documento
        if ( $_SESSION['clave']->validarFirma( $_SESSION['user']['id'], $_POST['input'] ) ) {
            $_SESSION['documento']->firmarDocumento( $_POST['idFichero'], $_POST['fecha']." ".$_POST['hora'] );
        }
        else
            $signInvalid = true;
    }

    if ( isset($_POST['change_key']) ) {            //Cambiar juego de claves
        try {
            if ( $_SESSION['clave']->validateCodGenNewKey( $_POST['codigo'] ) ) {
                include "include/users/gen_new_keys.php";

                header('Location:index.php?step=ok');
            } else 
                header('Location:index.php?step=repeat');
        } catch (TimeLimitException $tle) {
            header('Location:index.php?step=error');
        }
    }

    if ( isset( $_POST['acept_del'] ) ) {
        $_SESSION['documento']->borrarFichero( $_SESSION['user'], $_POST['id'] );
        header('Location:index.php?documentos');
    }

    if ( isset( $_POST['cancel_del'] ) ) {
        header('Location:index.php?documentos');
    }
?>