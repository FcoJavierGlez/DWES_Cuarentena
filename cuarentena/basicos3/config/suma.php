<?php
    echo "<form action=".$_SERVER['PHP_SELF']." method='post'>";
        if(empty($_POST['num']))
            echo "Inserte número entero: <input type='text' name='num'><input type='submit' name='enviar'>";
        else {
            echo "Inserte número entero: <input type='text' value=".$_POST['num']." name='num'><input type='submit' name='enviar'><br/>";
            try {
                echo "Resultado: ".sumaNumeros($_POST['num']);
            } catch (Exception $e) {
                echo "<p class='mensaje_error'>ERROR. Debes introducir un número entero</p>";
            }
        }
    echo "</form>";
?>