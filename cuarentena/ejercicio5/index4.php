<?php
    /**
     * 
     */
    include "class/Tablero.php";
    include "resources/funcionesIndex4.php";

    session_start();

    if (!isset($_SESSION['tablero'])) {
        $_SESSION['tablero'] = new Tablero();   //Creamos el objeto tablero

        for ($i=0; $i<sizeof(LONGITUD_BARCOS); $i++) { //Añadimos los barcos en posiciones válidas
            do {
                $fila = rand(0,9);
                $columna = rand(0,9);
    
                $sentido = rand(0,3);
                
                try {
                    $_SESSION['tablero']->addBarco($fila,$columna,LONGITUD_BARCOS[$i],$sentido);
                    $ubicarBarco = false;
                } catch (Exception $e) {
                    $ubicarBarco = true;
                }
            } while ($ubicarBarco);
        }
    }

    if (isset($_POST['borrar'])) {
        cerrarSesion();
    }

    if (isset($_GET['fila'])) {
        $_SESSION['tablero']->impacto($_GET['fila'],$_GET['columna']);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barcos formulario</title>
</head>
<body>
<h1>Hundir la flota</h1>
    <!-- <form action="procesa.php" method="post">
        <label for="fila">Fila: <input type="text" name="fila" id="fila"></label>
        <label for="columna">Columna: <input type="text" name="columna" id="columna"></label>
        <input type="submit" name="enviar">
    </form> -->
    <a href=""></a>
    <?php

        //impresión tablero vacío

        $_SESSION['tablero']->imprTabVis();
        //$_SESSION['tablero']->imprimir();

        echo "<form action='index4.php' method='post'>";
        echo "<input type='submit' name='borrar' value='Nueva partida'>";
        echo "</form>";

        echo "<br/><a href="."verCodigo.php?src=".str_replace("&bsol;","",__FILE__)." target='_blank'><button>Ver código index</button></a>";
        echo "<br/><a href="."verCodigo.php?src=".str_replace("&bsol;","","class/Tablero.php")." target='_blank'><button>Ver código Tablero.php</button></a>";
        echo "<br/><a href="."verCodigo.php?src=".str_replace("&bsol;","","class/Barco.php")." target='_blank'><button>Ver código Barco.php</button></a>";    
        echo "<br/><a href="."verCodigo.php?src=".str_replace("&bsol;","","procesa.php")." target='_blank'><button>Ver código procesa.php</button></a>";    
    ?>
</body>
</html>