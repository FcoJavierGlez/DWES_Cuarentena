<?php
    include "class/Tablero.php";

    $tablero = new Tablero();

    for ($i=0; $i<sizeof(LONGITUD_BARCOS); $i++) { 
        do {
            $fila = rand(0,9);
            $columna = rand(0,9);

            $sentido = rand(0,3);
            
            try {
                $tablero->addBarco($fila,$columna,LONGITUD_BARCOS[$i],$sentido);
                $ubicarBarco = false;
            } catch (Exception $e) {
                $ubicarBarco = true;
            }
        } while ($ubicarBarco);
    }

    $tablero->imprimir();
    
    echo "<br/><a href="."verCodigo.php?src=".str_replace("&bsol;","",__FILE__)." target='_blank'><button>Ver código index</button></a>";
    echo "<br/><a href="."verCodigo.php?src=".str_replace("&bsol;","","class/Tablero.php")." target='_blank'><button>Ver código Tablero.php</button></a>";
    echo "<br/><a href="."verCodigo.php?src=".str_replace("&bsol;","","class/Barco.php")." target='_blank'><button>Ver código Barco.php</button></a>";
    
    echo "<br/><b>Lista de barcos en el tablero: </b><br/>";
    $tablero->imprimirListaBarcos();
?>