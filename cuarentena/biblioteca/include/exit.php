<?php
    echo "<form action='index.php' method='post'>";
        echo "Usted está logeado con perfil: ".$_SESSION['user']['perfil'];
        echo "  <input type='submit' name='cerrar' value='Salir'>";
    echo "</form>";
?>