<?php
    include "config/config_dev.php";
    include "resource/funciones.php";
    include "class/DBAbstractModel.php";
    include "class/error/IsbnInvalidException.php";
    include "class/error/IsbnExistException.php";
    include "class/Libro.php";
    include "class/Usuario.php";

    session_start();

    if ($_SESSION['user']['perfil'] !== "administrador") { 
        header('Location:index.php');
    }

    $iie = false;
    $iee = false;
    $ok = false;

    if ( isset($_POST['add_libro']) ) {
        try {
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
        catch (IsbnInvalidException $iie) {}
        catch (IsbnExistException $iee) {}
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
        <?php
            include "include/footer.php";
        ?>
    </footer>
</body>
</html>