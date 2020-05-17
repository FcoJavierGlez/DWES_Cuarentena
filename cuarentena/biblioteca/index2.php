<?php
    include "config/config_dev.php";
    include "class/DBAbstractModel.php";
    include "class/Libro.php";

    echo DBHOST;
    echo DBNAME;
    echo DBPORT;
    echo DBUSER;
    echo DBPASS;

    $datos = array(
        "titulo" => "prueba",
        "autor" => "prueba",
        "isbn" => "5643",
        "editorial" => null,
    );

    $libro = new Libro();
    $libro->set( $datos );
?>