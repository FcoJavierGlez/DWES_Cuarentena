<?php
    include "config/config_dev.php";
    include "resource/funciones.php";
    include "class/DBAbstractModel.php";
    include "class/Libro.php";
    include "class/Usuario.php";

    session_start();

    if ($_SESSION['user']['perfil'] !== "administrador") {
        header('Location:index.php');
    }

    if ( isset($_GET['aceptar']) ) {
        $user_data = array(
            'estado' => "activo",
            'id_user' => limpiarDatos($_GET['aceptar'])
        );
        $_SESSION['usuario']->editEstado($user_data);
        header('Location:usuarios.php');
    }

    if ( isset($_GET['bloquear']) ) {
        $user_data = array(
            'estado' => "bloqueado",
            'id_user' => limpiarDatos($_GET['bloquear'])
        );
        $_SESSION['usuario']->editEstado($user_data);
        header('Location:usuarios.php');
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
                    include "include/users/info_user.php";
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