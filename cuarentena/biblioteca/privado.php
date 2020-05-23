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

    if ( $_SESSION['user']['perfil'] == "invitado" || $_SESSION['user']['estado'] == "bloqueado" || $_SESSION['user']['estado'] == "pendiente" ) {
        header('Location:index.php');
    }

    if ( isset($_POST['cancelar']) ) {
        header('Location:index.php');
    }

    if ( isset($_POST['up_perfil']) ) {
        $ok = true;
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
                    if ( isset( $_GET['edit'] ) )
                        include "include/users/edit_user.php";
                    elseif ( $ok ) {
                        echo "<div>";
                            echo "<h3>Mi perfil</h3>";
                        echo "</div>";
                        echo "<div class='center'>";
                            
                        echo "</div>";
                        echo "<div class='add_editar'>";
                            echo "<div><b>Su perfil se ha modificado con éxito.</b>  <a href='privado.php'><button class='boton_sq aceptar'>Continuar</button></a></div>";
                        echo "</div>";
                    }
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