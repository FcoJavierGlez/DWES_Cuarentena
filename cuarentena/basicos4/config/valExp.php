<?php
    echo "<form action=".$_SERVER['PHP_SELF']." method='post'>";
        if (!isset($_POST['valida_exp']))
            echo "Validar expresión:  <input type='submit' value='Validar' name='gen_cartas'><br/><br/>";

        elseif (isset($_POST['valida_exp'])) {                 //Si se pulsa el botón "Generar cartas"
            //$_SESSION['cartas']->generarCartas();
            echo "<div>";
                //$_SESSION['cartas']->imprimeEnlaces();
            echo "</div>";
        }
    echo "</form>";
?>