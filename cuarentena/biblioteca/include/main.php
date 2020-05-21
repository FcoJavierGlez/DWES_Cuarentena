<?php
    if ( $_SESSION['user']['perfil'] !== "invitado" && $_SESSION['user']['estado'] == "bloqueado" ) {
        echo "<h2 class='bloqueado'>Su cuenta ha sido bloqueada</h2>";
    } else 
        include "include/welcome.php";
?>