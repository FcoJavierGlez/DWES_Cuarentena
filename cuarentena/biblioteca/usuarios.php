<?php
    include "class/GestorLogin.php";
    include "class/Gestor.php";

    session_start();

    if ($_SESSION['perfil'] !== "administrador") {
        header('Location:index.php');
    }
    
    if ( isset($_POST['login']) ) {
        $_SESSION['perfil'] = GestorLogin::getPerfil($_POST['user'],$_POST['pswd']);
        if ($_SESSION['perfil']=="administrador") {
            $_SESSION['gestor'] = new Gestor();
            //$_SESSION['gestor']->importUsers();
        }
    }

    /* if ( isset($_POST['add']) ) {
        $_SESSION['uee'] = false;
        $_SESSION['uie'] = false;
        try {
            $_SESSION['gestor']->addUser($_POST['add_user'],$_POST['add_pswd']);
        } catch (UserExistException $uee) {
            $_SESSION['uee'] = true;
        } catch (UserInvalidException $uie) {
            $_SESSION['uie'] = true;
        }
    } */

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
            <h1>Biblioteca</h1>
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
                <div>
                    <h3>Listado de usuarios</h3>

                </div>
                <div class="filtro">
                    <form action="#">
                        Buscar:  <input type="text" name="nombre_libro">
                        <input type="submit" value="Enviar" name="consulta">
                    </form><!--   |  <a href="#">Nuevo</a> -->
                </div>
                <div class="listado">
                    <p>Usuario 1</p>
                    <p>Usuario 2</p>
                    <p>Usuario 3</p>
                    <p>Usuario 4</p>
                    <p>Usuario 5</p>
                    <p>Usuario 6</p>
                    <p>Usuario 7</p>
                    <p>Usuario 8</p>
                    <p>Usuario 9</p>
                    <p>Usuario 10</p>
                    <p>Usuario 11</p>
                    <p>Usuario 12</p>
                    <p>Usuario 13</p>
                    <p>Usuario 14</p>
                    <p>Usuario 15</p>
                    <p>Usuario 16</p>
                    <p>Usuario 17</p>
                    <p>Usuario 18</p>
                    <p>Usuario 19</p>
                    <p>Usuario 20</p>
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