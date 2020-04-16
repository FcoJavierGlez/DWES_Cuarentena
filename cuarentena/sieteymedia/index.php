<?php
    /**
     * Siete y media en PHP basada en sesiones.
     * 
     * @author Francisco Javier González Sabariego.
     */
    include "class/Baraja.php";
    include "class/Jugador.php";
    include "class/IA.php";


    session_start();    //Iniciamos sesión
    
    //Destruimos la sesión:
    if (isset($_POST['nuevapartida']) || isset($_POST['rendirse'])) {
        session_unset();
        session_destroy();
        session_start();
        session_regenerate_id();
        header('Location:index.php');
    }

    if (!isset($_SESSION['baraja'])) {
        $_SESSION['baraja'] = new Baraja();
        $_SESSION['jugador'] = new Jugador();
        $_SESSION['banca'] = new IA();
        $_SESSION['banca']->reparteCartas();
    }

    if (isset($_POST['carta'])) {
        $_SESSION['jugador']->pideCarta();
        if ($_SESSION['jugador']->getPuntos()>7.5) $_SESSION['jugador']->setEstadoJuego(-1);
    }

    if (isset($_POST['plantarse'])) {
        $_SESSION['jugador']->setEstadoJuego(0);
        $_SESSION['banca']->jugar();
        /* if () */
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Siete y media</title>
</head>
<body>
    <header>
        <h1>Juego de la siete y media</h1>
        <h2>Powered by PHP Sessions</h2>
    </header>
    <main>
        <div class="juego">
            <?php
                echo "Mano de la banca: <br/>";
                $_SESSION['banca']->mostrarMano()."<br/>";
                echo "<br/>Puntos: ".$_SESSION['banca']->getPuntos()."<br/>";

                echo "Mano del jugador: <br/>";
                $_SESSION['jugador']->mostrarMano()."<br/>";
                echo "<br/>Puntos: ".$_SESSION['jugador']->getPuntos();

                echo "<form action=".$_SERVER['PHP_SELF']." method='post'>";
                if ($_SESSION['jugador']->getEstadoJuego() == 1) 
                    echo "<input type='submit' name='carta' value='Pide carta'><input type='submit' name='plantarse' value='Plantarse'>";
                elseif ($_SESSION['jugador']->getEstadoJuego() == 0 || $_SESSION['jugador']->getEstadoJuego() == -1) 
                    echo "<input type='submit' name='nuevapartida' value='Nueva Partida'>";
                echo "</form>";
            ?>
        </div>
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