<?php
    echo "<form action=".$_SERVER['PHP_SELF']." method='post'>";
        echo "Usuario: <input type='text' name='user'>  Contraseña: <input type='password' name='pswd'>  ";
        echo "<input type='submit' value='Login' name='login'> | <a href='#'>Regístrate</a>";
    echo "</form>";
?>