<?php
    /**
     * Siete y media en PHP basada en sesiones.
     * 
     * @author Francisco Javier González Sabariego.
     */
    include "class/Baraja.php";
    include "class/Jugador.php";
    include "class/IA.php";
    include "resources/funciones.php";


    session_start();    //Iniciamos sesión
    
    //Destruimos la sesión:
    if (isset($_POST['nuevapartida']) || isset($_POST['rendirse'])) {
        cerrarSesion();
    }

    //Si la variable de sesión de baraja no existe la creamos junto al resto de variables necesarias para la partida
    if (!isset($_SESSION['baraja'])) {
        $_SESSION['baraja'] = new Baraja();
        $_SESSION['jugador'] = new Jugador();
        $_SESSION['banca'] = new IA();
        $_SESSION['banca']->reparteCartas();
        $_SESSION['jugadorPierde'] = false;
        $_SESSION['jugadorGana'] = false;
    }

    //Si el jugador pide carta llamamos a la función de pedir carta del jugador
    if (isset($_POST['carta'])) {
        $_SESSION['jugador']->pideCarta();
        if ($_SESSION['jugador']->getPuntos()>7.5) $_SESSION['jugador']->setEstadoJuego(-1);
    }

    //Si el jugador se ha plantado ponemos su estado a "0" (plantado), juega la IA y determinamos el ganador
    if (isset($_POST['plantarse'])) {
        $_SESSION['jugador']->setEstadoJuego(0);
        $_SESSION['banca']->jugar();
        $_SESSION['jugadorPierde'] = ($_SESSION['jugador']->getEstadoJuego() == 0 
            && $_SESSION['banca']->getPuntos() >= $_SESSION['jugador']->getPuntos() 
            && !($_SESSION['banca']->getPuntos()>7.5));
        $_SESSION['jugadorGana'] = $_SESSION['jugador']->getEstadoJuego() == 0 
            && $_SESSION['banca']->getPuntos() > 7.5;
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Siete y media</title>
</head>
<body>
    <header>
        <h1>Juego de la siete y media</h1>
        <h2>Powered by PHP Sessions</h2>
    </header>
    <main>
        <div class="github">
            <b>El siguiente botón conduce al código fuente en GitHub:</b>
            <a href="https://github.com/FcoJavierGlez/DWES_Cuarentena/tree/sieteymedia/cuarentena/sieteymedia" target="_blank">
                <button>Ver código</button>
            </a>
        </div>
        <?php
            mensajeFinPartida();    //En caso de haberse finalizado la partida se muestra el mensaje final
        ?>
        <div class="contenedor">
            <div class="juego">
                <?php
                    //Mostramos mano de la banca y la puntuación de sus cartas visibles
                    echo "<b>Mano de la banca:</b><br/>";
                    $_SESSION['banca']->mostrarMano()."<br/>";
                    echo "<br/>Puntos: ".$_SESSION['banca']->getPuntos()."<br/><br/>";

                    //Mostramos mano del jugador y su puntuación
                    echo "<b>Mano del jugador:</b><br/>";
                    $_SESSION['jugador']->mostrarMano()."<br/>";
                    echo "<br/>Puntos: ".$_SESSION['jugador']->getPuntos();

                    //Imprimimos la botonera con las opciones de juego
                    echo "<div class='opciones'>";
                        echo "<form action=".$_SERVER['PHP_SELF']." method='post'>";
                        if ($_SESSION['jugador']->getEstadoJuego() == 1) 
                            echo "<input type='submit' name='carta' value='Pide carta'><input type='submit' name='plantarse' value='Plantarse'>";
                        elseif ($_SESSION['jugador']->getEstadoJuego() == 0 || $_SESSION['jugador']->getEstadoJuego() == -1) 
                            echo "<input type='submit' name='nuevapartida' value='Nueva Partida'>";
                        echo "</form>";
                    echo "</div>";
                ?>
            </div>
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