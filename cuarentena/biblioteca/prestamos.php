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
                    include "include/login.php";
                else 
                    include "include/exit.php";
            ?>
        </div>
    </header>
    <div class="cuerpo">
        <nav>
            <?php
                if ( $_SESSION['perfil'] == "administrador" )
                    include "include/nav.php";
            ?>
        </nav>
        <main>
            <div class="contenedor">
                <div>
                    <h3>Listado de préstamos</h3>
                </div>
                <div class="filtro">
                    <!-- <form action="#">
                        Buscar:  <input type="text" name="nombre_libro">
                        <input type="submit" value="Enviar" name="consulta">
                    </form>  |  <a href="#">Nuevo</a> -->
                </div>
                <div class="listado">
                    <p>Préstamo 1</p>
                    <p>Préstamo 2</p>
                    <p>Préstamo 3</p>
                    <p>Préstamo 4</p>
                    <p>Préstamo 5</p>
                    <p>Préstamo 6</p>
                    <p>Préstamo 7</p>
                    <p>Préstamo 8</p>
                    <p>Préstamo 9</p>
                    <p>Préstamo 10</p>
                    <p>Préstamo 11</p>
                    <p>Préstamo 12</p>
                    <p>Préstamo 13</p>
                    <p>Préstamo 14</p>
                    <p>Préstamo 15</p>
                    <p>Préstamo 16</p>
                    <p>Préstamo 17</p>
                    <p>Préstamo 18</p>
                    <p>Préstamo 19</p>
                    <p>Préstamo 20</p>
                </div>
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