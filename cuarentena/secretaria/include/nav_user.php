<?php
    $enlaces = array(
        array(
            "enlace" => "index.php",
            "nombre" => "Home"
        ),
        /* array(
            "enlace" => "libros.php",
            "nombre" => "Libros"
        ),*/
        array(
            "enlace" => "index.php?documentos",
            "nombre" => "Mis documentos"
        ), 
        array(
            "enlace" => "index.php?perfil",
            "nombre" => "Mi perfil"
        ),
    );


    echo "<ul>";
        foreach ($enlaces as $valor) 
            echo "<li><a href=".$valor["enlace"].">".$valor["nombre"]."</a></li>";
    echo "</ul>";
?>