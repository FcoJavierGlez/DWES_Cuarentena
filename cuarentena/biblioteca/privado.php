<?php
    include "config/config_dev.php";
    include "resource/funciones.php";
    include "class/DBAbstractModel.php";
    include "class/error/UserExistException.php";
    include "class/error/DniInvalidException.php";
    include "class/error/DniExistException.php";
    include "class/error/CheckOldPassException.php";
    include "class/error/PassCheckException.php";
    include "class/Usuario.php";

    session_start();
    
    $uee = false;   //nick ya existe
    $die = false;   //dni inválido
    $dee = false;   //dni existente en BD
    $ope = false;   //contraseña vieja no coincide
    $cpe = false;   //contraseña y verificación no coinciden
    $cve = false;   //campos vacíos
    $ok = false;    //todo ok

    if ( $_SESSION['user']['perfil'] == "invitado" 
            || $_SESSION['user']['estado'] == "bloqueado" || $_SESSION['user']['estado'] == "pendiente" ) {
        header('Location:index.php');
    }

    if ( isset($_POST['cancelar']) ) {
        header('Location:index.php');
    }

    if ( isset($_POST['up_perfil']) ) {
        try {
            $user_data = array(
                'id_user' => $_SESSION['user']['id_user'],
                'nombre' => limpiarDatos($_POST['nombre']),
                'apellidos' => limpiarDatos($_POST['apellidos']),
                'dni' => limpiarDatos($_POST['dni']),
                'telefono' => limpiarDatos($_POST['telefono']),
                'email' => limpiarDatos($_POST['email']),
                'img' => limpiarDatos($_POST['img']),
            );
            $_SESSION['usuario']->editUser($user_data);
            $ok = true;
            $_SESSION['user']['nombre'] = limpiarDatos($_POST['nombre']);
            $_SESSION['user']['apellidos'] = limpiarDatos($_POST['apellidos']);
            $_SESSION['user']['dni'] = limpiarDatos($_POST['dni']);
            $_SESSION['user']['telefono'] = limpiarDatos($_POST['telefono']);
            $_SESSION['user']['email'] = limpiarDatos($_POST['email']);
            $_SESSION['user']['img'] = ( (limpiarDatos($_POST['img']) == '') ? $_SESSION['user']['img'] : $_POST['img'] );
        } 
        catch (DniInvalidException $die) {}
        catch (DniExistException $dee) {}
    }

    if ( isset($_POST['change_pass']) ) {
        if ( !( empty($_POST['old_pass']) || empty($_POST['new_pass']) || empty($_POST['new_pass2']) ) ) {
           try {
                $user_data = array(
                    'id_user' => $_SESSION['user']['id_user'],
                    'old_pass' => limpiarDatos($_POST['old_pass']),
                    'new_pass' => limpiarDatos($_POST['new_pass']),
                    'new_pass2' => limpiarDatos($_POST['new_pass2'])
                );
                $_SESSION['usuario']->editPass($user_data);
                $ok = true;
                $_SESSION['user']['pass'] = limpiarDatos($_POST['new_pass']);
            } 
            catch (CheckOldPassException $ope) {} 
            catch (PassCheckException $cpe) {} 
        } else 
            $cve = true;
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Privado</title>
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
                elseif ( $_SESSION['user']['perfil'] == "lector" )
                    include "include/nav_user.php";
            ?>
        </nav>
        <main>
            <div class="contenedor">
                <?php 
                    if ( $ok ) {
                        echo "<div>";
                            echo "<h3>Mi perfil</h3>";
                        echo "</div>";
                        echo "<div class='center'>";
                            
                        echo "</div>";
                        echo "<div class='add_editar'>";
                            echo "<div><b>Su perfil se ha actualizado con éxito.</b>  <a href='privado.php'><button class='boton_sq aceptar'>Continuar</button></a></div>";
                        echo "</div>";
                    } 
                    elseif ( isset( $_GET['edit'] ) || $die || $dee ) 
                        include "include/users/edit_user.php";
                    elseif ( isset( $_POST['ed_pass'] ) || $cve ||$ope || $cpe )
                        include "include/users/ed_pass_user.php";
                    else
                        include "include/users/own_user.php";
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