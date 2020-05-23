<?php
    if ( $_SESSION['user']['perfil'] !== "invitado" && $_SESSION['user']['estado'] == "bloqueado" ) {
        echo "<h2 class='bloqueado'>Su cuenta ha sido bloqueada</h2>";
    } elseif ( $_SESSION['user']['perfil'] == "administrador" )
        include "include/notices_admin.php";
    else 
        include "include/welcome.php";
?>