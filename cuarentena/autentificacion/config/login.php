<?php
    echo "<div class='login'>";
        echo "<form action=".$_SERVER['PHP_SELF']." method='post'>";
            echo "Usuario: <input type='text' name='user'>";
            echo "Contraseña: <input type='password' name='pswd'>";
            echo "<input type='submit' name='login'>";
        echo "</form>";
    echo "</div>";
?>