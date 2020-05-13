<?php
    echo "<form action=".$_SERVER['PHP_SELF']." method='post'>";
        if ( empty( $_POST['num'] ) )
            echo "Inserte números separados por comas: <input type='text' name='num'><input type='submit' name='enviar'>";
        else {
            echo "Inserte números separados por comas: <input type='text' value=".$_POST['num']." name='num'><input type='submit' name='enviar'><br/>";
            try {
                echo "<b>Resultado: ".sumaNumeros( 0, explode(",", $_POST['num']) )."</b>";
            } catch ( Exception $e ) {
                echo "<p class='mensaje_error'>ERROR. Solo puedes introducir números</p>";
            }
        }
    echo "</form>";
?>