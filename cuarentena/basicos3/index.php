<?php
    include "class/Pila.php";
    include "class/Carta.php";

    session_start();

    if (!isset($_SESSION['pila'])) {
        $_SESSION['pila'] = new Pila();
        $_SESSION['cartas'] = new Carta();
    }

    if (isset($_POST['salir'])) {
        cerrarSesion();
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Francisco Javier González Sabariego">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Ejercicios básicos 3</title>
</head>
<body>
    <header>
        <h1>Ejercicios básicos 3</h1>
    </header>
    <main>
        <div class="github">
            <b>El siguiente botón conduce al repositorio de GitHub:</b>
            <a href="#" target="_blank">
                <button>Ver código</button>
            </a>
        </div>
        <?php
            echo "<div class='contenedor'>";
                //Suma dígitos de un número
                include "config/suma.php";

                //Pila
                include "config/control_pila.php";
                
                //Carta
                include "config/genCartas.php";
            echo "</div>";
            
            //Cerrar sesión
            /* echo "<form action=".$_SERVER['PHP_SELF']." method='post'>";
                echo "<input type='submit' value='Cerrar sesión' name='salir'>";
            echo "</form>"; */
            
        ?>
    </main>
    <footer>
        <h4>RRSS del autor:</h4>
        <div>
            <a href="https://twitter.com/Fco_Javier_Glez" target="_blank"><img src="img/twitter.png" alt="Enlace a cuenta de Twitter del autor"></a>
            <a href="https://github.com/FcoJavierGlez" target="_blank"><img src="img/github.png" alt="Enlace a cuenta de GitHub del autor"></a>
            <a href="https://www.linkedin.com/in/francisco-javier-gonz%C3%A1lez-sabariego-51052a175/" target="_blank"><img src="img/linkedin.png" alt="Enlace a cuenta de Linkedin del autor"></a>
        </div>
    </footer>
</body>
</html>