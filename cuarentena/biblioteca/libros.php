<?php
    include "config/config_dev.php";
    include "resource/funciones.php";
    include "class/DBAbstractModel.php";
    include "class/GestorLogin.php";
    include "class/Libro.php";
    include "class/Usuario.php";

    session_start();

    if ($_SESSION['perfil'] !== "administrador") {
        header('Location:index.php');
    }

    if ( isset($_POST['ed_libro']) ) {
        $book_data = array(
            'id' => limpiarDatos($_POST['id']),
            'titulo' => limpiarDatos($_POST['titulo']),
            'autor' => limpiarDatos($_POST['autor']),
            'isbn' => limpiarDatos($_POST['isbn']),
            'editorial' => limpiarDatos($_POST['editorial']),
            'anno_publicacion' => limpiarDatos($_POST['anno_publicacion']),
            'img' => limpiarDatos($_POST['img']),
        );
        $_SESSION['libro']->edit( $book_data );
    }

    if ( isset($_POST['delete_libro']) ) {
        $_SESSION['libro']->del( $_POST['id'] );
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
                if ( $_SESSION['perfil'] == "invitado" ) 
                    include "config/login.php";
                else 
                    include "config/exit.php";
            ?>
        </div>
    </header>
    <div class="cuerpo">
        <nav>
            <?php
                if ( $_SESSION['perfil'] == "administrador" )
                    include "config/nav.php";
            ?>
        </nav>
        <main>
            <div class="contenedor">
                <?php 
                    if ( isset($_GET['edit']) )
                        include "include/books/edit_libro.php";
                    else if( isset($_GET['del']) )
                        include "include/books/del_libro.php";
                    else
                        include "include/books/info_libro.php";
                ?>
            </div>
        </main>
    </div>
    <footer>
        <h4>RRSS del autor:</h4>
        <div class="rrss">
            <a href="https://twitter.com/Fco_Javier_Glez" target="_blank"><img src="img/twitter.png" alt="Enlace a cuenta de Twitter del autor"></a>
            <a href="https://github.com/FcoJavierGlez" target="_blank"><img src="img/github.png" alt="Enlace a cuenta de GitHub del autor"></a>
            <a href="https://www.linkedin.com/in/francisco-javier-gonz%C3%A1lez-sabariego-51052a175/" target="_blank"><img src="img/linkedin.png" alt="Enlace a cuenta de Linkedin del autor"></a>
        </div>
    </footer>
</body>
</html>