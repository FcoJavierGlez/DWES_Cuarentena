<?php
    include "class/Gestor.php";

    session_start();

    if (!isset($_SESSION['perfil'])) {
        $_SESSION['perfil'] = "invitado";
        $_SESSION['gestor'] = new Gestor();
    }

    if ($_SESSION['perfil'] !== "usuario") {
        header('Location:index.php');
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Privado</title>
</head>
<body>
    <header>
        <h1>Autentificación</h1>
    </header>
    <main>
        <div class="github">
            <b>El siguiente botón conduce al repositorio de GitHub:</b>
            <a href="#" target="_blank">
                <button>Ver código</button>
            </a>
        </div>
       <?php
            include "config/exit.php";
            
            echo "<div class='contenedor'>";
            echo "<div><h3>El lado oculto de la luna</h3><a href='index.php'>Volver a Home</a></div>";
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