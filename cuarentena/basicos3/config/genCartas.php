<?php
    echo "<form action=".$_SERVER['PHP_SELF']." method='post'>";
        if (!isset($_POST['gen_cartas']))
            echo "<input type='submit' value='Generar cartas' name='gen_cartas'><br/><br/>";

        elseif (isset($_POST['gen_cartas'])) {                 //Si se pulsa el botón "Generar cartas"
            $_SESSION['cartas']->generarCartas();
            echo "<div>";
                $_SESSION['cartas']->imprimeEnlaces();
            echo "</div>";
        }
    echo "</form>";
?>