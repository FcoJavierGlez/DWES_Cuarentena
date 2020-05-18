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
            "nombre" => "Préstamos"
        ),
        array(
            "enlace" => "usuarios.php",
            "nombre" => "Usuarios"
        ),
    );


    echo "<ul>";
        foreach ($enlaces as $valor) 
            echo "<li><a href=".$valor["enlace"].">".$valor["nombre"]."</a></li>";
    echo "</ul>";
?>