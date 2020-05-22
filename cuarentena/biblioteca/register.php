<?php
    include "config/config_dev.php";
    include "resource/funciones.php";
    include "class/DBAbstractModel.php";
    include "class/error/UserExistException.php";
    include "class/error/DniInvalidException.php";
    include "class/error/DniExistException.php";
    include "class/Usuario.php";

    session_start();
    
    $uee = false;
    $die = false;
    $dee = false;
    $cpe = false;
    $ok = false;

    if ( isset($_POST['add_user']) ) {
        if ( $_POST['pass'] == $_POST['pass2'] ) {  //Comprueba que la contraseña y su verificación son idénticas
            try {
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
                $ok = true;
            } 
            catch (UserExistException $uee) {}
            catch (DniInvalidException $die) {}
            catch (DniExistException $dee) {}
        } else 
            $cpe = true;
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
                    if ( $ok ) {
                        echo "<div>";
                            echo "<h3>Registrarse</h3>";
                        echo "</div>";
                        echo "<div class='center'>";
                            
                        echo "</div>";
                        echo "<div class='add_editar'>";
                            echo "<div><b>Se ha registrado correctamente.</b>  <a href='index.php'><button>Continuar</button></a></div>";
                        echo "</div>";
                    }
                    else
                        include "include/users/new_user.php";
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