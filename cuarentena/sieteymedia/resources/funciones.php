<?php
    /**
     * Esta función cierra la sesión actual, eliminando sus variables, y genera una nueva con un nuevo ID
     */
    function cerrarSesion() {
        session_unset();
        session_destroy();
        session_start();
        session_regenerate_id();
        header('Location:index.php');
    }

    /** Si la banca supera o iguala al jugador en puntos (sin excederse de 7.5) 
     * o el estado del jugador es -1 el jugador pierde
     */
    function mensajeFinPartida() {
        if ($_SESSION['jugadorPierde'] || $_SESSION['jugador']->getEstadoJuego() == -1) 
            echo "<div class='mensaje perdido'>Lo siento, has perdido.</div>";
        elseif ($_SESSION['jugadorGana']) 
            echo "<div class='mensaje ganado'>¡¡Enhorabuena, has ganado!!</div>";
    }
?>