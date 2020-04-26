<?php
    echo "<form action='index.php' method='post'>";
        echo "Usuario: <input type='text' name='add_user'>";
        echo "Contraseña: <input type='password' name='add_pswd'>";
        echo "<input type='submit' name='add' value='Agregar Usuario'>";
        if ($_SESSION['error'])
            echo "<p class='mensaje_error'>El usuario <b>".$_POST['add_user']."</b> no pudo ser creado. El usuario ya existe en el sistema</p>";
    echo "</form>";
?>