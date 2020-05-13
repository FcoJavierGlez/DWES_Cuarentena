<?php
    include "class/GestorLogin.php";
    include "class/Gestor.php";

    session_start();

    if (!isset($_SESSION['perfil'])) {
        $_SESSION['perfil'] = "invitado";
        $_SESSION['uee'] = false;
        $_SESSION['uie'] = false;
    }
    
    if (isset($_POST['login'])) {
        $_SESSION['perfil'] = GestorLogin::getPerfil($_POST['user'],$_POST['pswd']);
        if ($_SESSION['perfil']=="administrador") {
            $_SESSION['gestor'] = new Gestor();
            $_SESSION['gestor']->importUsers();
        }
    }

    if (isset($_POST['add'])) {
        $_SESSION['uee'] = false;
        $_SESSION['uie'] = false;
        try {
            $_SESSION['gestor']->addUser($_POST['add_user'],$_POST['add_pswd']);
        } catch (UserExistException $uee) {
            $_SESSION['uee'] = true;
        } catch (UserInvalidException $uie) {
            $_SESSION['uie'] = true;
        }
    }

    if (isset($_POST['cerrar'])) {
        if ($_SESSION['perfil']=="administrador")
            $_SESSION['gestor']->exportUsers();
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
    <title>Home</title>
</head>
<body>
    <header>
        <h1>Biblioteca</h1>
    </header>
    <?php
        if ($_SESSION['perfil'] == "invitado") 
            include "config/login.php";
        else 
            include "config/exit.php";
    ?>
    <main>
        <!-- <div class="github">
            <b>El siguiente botón conduce al repositorio de GitHub:</b>
            <a href="https://github.com/FcoJavierGlez/DWES_Cuarentena/tree/autentificacionBD/cuarentena/autentificacion" target="_blank">
                <button>Ver código</button>
            </a>
        </div> -->
        <div class="contenedor">
            <div>
                <h3>Listado de títulos</h3>

            </div>
            <div class="filtro">
                <form action="#">
                    Buscar:  <input type="text" name="nombre_libro">
                    <input type="submit" value="Enviar" name="consulta">
                </form>  |  <a href="#">Nuevo</a>
            </div>
            <div class="listado">
                <p>ejemplo1</p>
                <p>ejemplo2</p>
                <p>ejemplo3</p>
                <p>ejemplo4</p>
                <p>ejemplo5</p>
                <p>ejemplo6</p>
                <p>ejemplo7</p>
                <p>ejemplo8</p>
                <p>ejemplo9</p>
                <p>ejemplo10</p>
                <p>ejemplo11</p>
                <p>ejemplo12</p>
                <p>ejemplo13</p>
                <p>ejemplo14</p>
                <p>ejemplo15</p>
                <p>ejemplo16</p>
                <p>ejemplo17</p>
                <p>ejemplo18</p>
                <p>ejemplo19</p>
                <p>ejemplo20</p>
            </div>
        </div>
       <?php
            /* //Logeo
            if ($_SESSION['perfil'] == "invitado") 
                include "config/login.php";
            else 
                include "config/exit.php";

            //Contenido
            echo "<div class='contenedor'>";
            if ($_SESSION['perfil'] == "administrador") 
                include "config/add.php";
            elseif ($_SESSION['perfil'] == "usuario")
                echo "<a href='privado.php'>Acceder a privado</a>";
            echo "</div>"; */
       ?>
    </main>
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