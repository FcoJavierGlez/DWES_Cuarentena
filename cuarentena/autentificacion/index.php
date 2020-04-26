<?php
    include "class/Gestor.php";

    session_start();

    if (!isset($_SESSION['perfil'])) {
        $_SESSION['perfil'] = "invitado";
    }
    
    if (isset($_POST['login'])) {
        $_SESSION['perfil'] = getPerfil($_POST['user'],$_POST['pswd']);
        if ($_SESSION['perfil']=="administrador") {
            $_SESSION['gestor'] = new Gestor();
            $_SESSION['gestor']->importUsers();
        }
    }

    if (isset($_POST['add'])) {
        $_SESSION['gestor']->addUser($_POST['add_user'],$_POST['add_pswd']);
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
        <h1>Autentificación</h1>
    </header>
    <main>
        <div class="github">
            <b>El siguiente botón conduce al repositorio de GitHub:</b>
            <a href="https://github.com/FcoJavierGlez/DWES_Cuarentena/tree/autentificacionFicheros/cuarentena/autentificacion" target="_blank">
                <button>Ver código</button>
            </a>
        </div>
       <?php
            //Logeo
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
            echo "</div>";
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