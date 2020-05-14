<?php
    echo "<form action=".$_SERVER['PHP_SELF']." method='post'>";
        if ( !isset($_POST['valida_exp']) ) {
            echo "Validar expresión:  <input type='text' value='' name='expresion'>";
            echo "<input type='submit' value='Validar' name='valida_exp'><br/><br/>";
        }
        elseif ( isset($_POST['valida_exp']) ) {                 //Si se pulsa el botón para validar
            if ( !empty($_POST['expresion']) ) {
                echo "Validar expresión:  <input type='text' value=".str_replace( " ", "", $_POST['expresion'] )." name='expresion'>";
                echo "<input type='submit' value='Validar' name='valida_exp'><br/><br/>";
                if ( $_SESSION['exp']->valida($_POST['expresion']) )
                    echo "Expresión válida.";
                else
                    echo "<p class='mensaje_error'>Expresión inválida.</p>";
            }
            else {
                echo "Validar expresión:  <input type='text' value='' name='expresion'>";
                echo "<input type='submit' value='Validar' name='valida_exp'><br/><br/>";
            }
        }
    echo "</form>";
?>