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
                if ( $_SESSION['user']['perfil'] == "invitado" ) //$_SESSION['perfil'] == "invitado"
                    include "include/login.php";
                else 
                    include "include/exit.php";
            ?>
        </div>
    </header>
    <div class="cuerpo">
        <nav>
            <?php
                if ( $_SESSION['user']['perfil'] == "administrador" ) //$_SESSION['perfil'] == "administrador"
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
                            echo "<h3>Registrarse</h3>";
                        echo "</div>";
                        echo "<div class='center'>";
                            
                        echo "</div>";
                        echo "<div class='add_editar'>";
                            echo "<div><b>Se ha registrado correctamente.</b>  <a href='index.php'><button>Continuar</button></a></div>";
                        echo "</div>";
                    }
                    else
                        include "include/users/edit_user.php";
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