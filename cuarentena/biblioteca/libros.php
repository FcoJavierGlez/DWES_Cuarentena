<?php
    include "config/config_dev.php";
    include "resource/funciones.php";
    include "class/DBAbstractModel.php";
    include "class/error/IsbnInvalidException.php";
    include "class/error/IsbnExistException.php";
    include "class/Libro.php";
    include "class/Usuario.php";
    include "class/Prestamo.php";

    session_start();

    if ( $_SESSION['user']['perfil'] == "invitado" || $_SESSION['user']['estado'] == "bloqueado" || $_SESSION['user']['estado'] == "pendiente" ) {
        header('Location:index.php');
    }

    $iie = false;
    $iee = false;
    $aok = false;
    $eok = false;

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
            $aok = true;
        } 
        catch (IsbnInvalidException $iie) {}
        catch (IsbnExistException $iee) {}
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
        $eok = true;
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
                    if ( $aok || $eok ) {
                        echo "<div>";
                            echo "<h3>".( ($aok) ? "Añadir libro" : "Editar libro" )."</h3>";
                        echo "</div>";
                        echo "<div class='filtro'>";

                        echo "</div>";
                        echo "<div class='add_editar'>";
                            echo ($aok) ? 
                            "<div><b>Libro añadido correctamente.</b>  <a href='libros.php'><button class='boton_sq editar'>Volver a libros</button></a> <a href='libros.php?add'><button class='boton_sq aceptar'>Añadir nuevo libro</button></a></div>" :
                            "<div><b>Libro editado correctamente.</b>  <a href='libros.php'><button class='boton_sq aceptar'>Continuar</button></a></div>";
                        echo "</div>";
                    }
                    elseif ( $_SESSION['user']['perfil'] == "administrador" ) {
                        if ( isset($_GET['add']) )
                            include "include/books/new_libro.php";
                        elseif ( isset($_GET['edit']) )
                            include "include/books/edit_libro.php";
                        elseif( isset($_GET['del']) )
                            include "include/books/del_libro.php";
                        elseif ( isset($_GET['view']) ) 
                            include "include/books/view_libro.php";
                        else
                            include "include/books/info_libro.php";
                    } 
                    else {
                        include "include/books/res_libro.php";
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