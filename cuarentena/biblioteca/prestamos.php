<?php
    include "config/config_dev.php";
    include "resource/funciones.php";
    include "class/DBAbstractModel.php";
    include "class/Libro.php";
    include "class/Usuario.php";
    include "class/Prestamo.php";


    session_start();

    if ( $_SESSION['user']['perfil'] == "invitado" || $_SESSION['user']['estado'] == "bloqueado" || $_SESSION['user']['estado'] == "pendiente" ) {
        header('Location:index.php');
    }

    if ( isset($_GET['devolver']) ) {
        $data = array(
            'devuelto' => date('Y-m-d'),
            'id_pres' => limpiarDatos($_GET['devolver'])
        );
        $_SESSION['prestamo']->edit($data);
        header('Location:prestamos.php');
    }

    if ( isset($_POST['solicitar']) ) {
        $prestamos_data = array(
            'id_user' => $_SESSION['user']['id_user'],
            'id_libro' => $_POST['id'],
            'prestado' => date('Y-m-d')
        );
        $_SESSION['prestamo']->set($prestamos_data);
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
                elseif ( $_SESSION['user']['perfil'] == "lector" )
                    include "include/nav_user.php";
            ?>
        </nav>
        <main>
            <div class="contenedor">
                <?php
                    if ( $_SESSION['user']['perfil'] == "administrador" )
                        include "include/borrow/info_borrow.php";
                    else {
                        if ( isset($_GET['solicitar']) )
                            include "include/borrow/new_borrow.php";
                        else
                            include "include/borrow/own_borrow.php";
                    }
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