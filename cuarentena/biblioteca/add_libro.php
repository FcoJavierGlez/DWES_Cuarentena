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

    $isbnError = false;
    $isbnUsado = false;
    $ok = false;

    if ( isset($_POST['add_libro']) ) {
        if ( !validarISBN( limpiarDatos($_POST['isbn']) ) )
            $isbnError = true;
        elseif ( sizeof( $_SESSION['libro']->get( limpiarDatos($_POST['isbn']) ) ) == 1 )
            $isbnUsado = true;
        else {
            $book_data = array(
                'titulo' => limpiarDatos($_POST['titulo']),
                'autor' => limpiarDatos($_POST['autor']),
                'isbn' => limpiarDatos($_POST['isbn']),
                'editorial' => ( ($_POST['editorial'] == "") ? null : limpiarDatos($_POST['editorial']) ),
                'anno_publicacion' => ( ($_POST['anno_publicacion'] == "") ? null : limpiarDatos($_POST['anno_publicacion']) ),
                'img' => ( ($_POST['img'] == "") ? null : limpiarDatos($_POST['img']) ),
            );
            $_SESSION['libro']->set( $book_data );
            $ok = true;
        }
        
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
                            echo "<h3>Añadir libro</h3>";
                        echo "</div>";
                        echo "<div class='filtro'>";
                            /* <form action="libros.php" method="post">
                                Buscar título:  <input type="text" name="nombre_libro">
                                <input type="submit" value="Enviar" name="consulta">
                            </form> */
                        echo "</div>";
                        echo "<div class='add_editar'>";
                            echo "<div><b>Libro añadido correctamente.</b>  <a href='index.php'><button>Volver a home</button></a> <a href='add_libro.php'><button>Añadir nuevo libro</button></a></div>";
                        echo "</div>";
                    } else
                        include "include/books/new_libro.php";
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