<?php
    echo "<form action='index.php' method='post'>";
        echo "Usuario: <input type='text' name='user'>  Contraseña: <input type='password' name='pswd'>  ";
        echo "<input type='submit' value='Login' name='login'> | <a href='register.php'>Regístrate</a>";
    echo "</form>";
?>