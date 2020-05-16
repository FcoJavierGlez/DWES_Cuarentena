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
        "titulo" => "Veinte mil leguas de viaje submarino",
        "autor" => "Julio Verne",
        "isbn" => "1234"
    );

    $libro = new Libro();
    $libro->set( $datos );
?>