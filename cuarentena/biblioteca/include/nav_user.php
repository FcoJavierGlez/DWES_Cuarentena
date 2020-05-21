<?php
    $enlaces = array(
        array(
            "enlace" => "index.php",
            "nombre" => "Home"
        ),
        array(
            "enlace" => "libros.php",
            "nombre" => "Libros"
        ),
        array(
            "enlace" => "prestamos.php",
            "nombre" => "Mis préstamos"
        ),
        array(
            "enlace" => "privado.php",
            "nombre" => "Mi perfil"
        ),
    );


    echo "<ul>";
        foreach ($enlaces as $valor) 
            echo "<li><a href=".$valor["enlace"].">".$valor["nombre"]."</a></li>";
    echo "</ul>";
?>