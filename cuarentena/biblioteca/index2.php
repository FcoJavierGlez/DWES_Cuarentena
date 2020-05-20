<?php
    include "config/config_dev.php";
    include "class/DBAbstractModel.php";
    include "class/Libro.php";

    /* session_start(); */

    /* echo DBHOST;
    echo DBNAME;
    echo DBPORT;
    echo DBUSER;
    echo DBPASS; */

    $datos = array(
        "titulo" => "prueba",
        "autor" => "prueba",
        "isbn" => "1234",
        "editorial" => null,
        "anno_publicacion" => null,
        "img" => null,
    );

    /* $_SESSION['libro'] = Libro::singleton();
    //$_SESSION['libro'] = new Libro();
    $_SESSION['libro']->set( $datos );

    echo $_SESSION['libro']->lastInsert();

    echo "<pre>";
        print_r( $_SESSION['libro']->getID($_SESSION['libro']->lastInsert()) );
    echo "</pre>"; */

    $libro = Libro::singleton();
    //$libro = new Libro();
    $libro->set( $datos );

    echo $libro->lastInsert();

    echo "<pre>";
        print_r( $libro->getID($libro->lastInsert()) );
    echo "</pre>";
?>