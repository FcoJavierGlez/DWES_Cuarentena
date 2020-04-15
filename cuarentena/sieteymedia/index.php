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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
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
</body>
</html>