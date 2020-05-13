<?php
    echo "<div class='login'>";
        echo "<form action=".$_SERVER['PHP_SELF']." method='post'>";
            echo "Usuario: <input type='text' name='user'>  Contraseña: <input type='password' name='pswd'>  ";
            /* echo "Contraseña: <input type='password' name='pswd'>"; */
            echo "<input type='submit' value='Login' name='login'>";
        echo "</form>";
    echo "</div>";
?>