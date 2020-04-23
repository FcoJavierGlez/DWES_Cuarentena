<?php
    echo "<div class='login'>";
        echo "<form action='index.php' method='post'>";
            echo "Usted está logeado con perfil: ".$_SESSION['perfil'];
            echo "<input type='submit' name='cerrar' value='Salir'>";
        echo "</form>";
    echo "</div>";
?>