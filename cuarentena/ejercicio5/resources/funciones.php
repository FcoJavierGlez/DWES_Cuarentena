<?php
    /**
     * 
     */
    include "resources/datos.php";

    /**
     * 
     */
    function iniciaTablero() {
        $tablero = array();
        for ($i=0; $i<10; $i++) 
            array_push($tablero, array(0,0,0,0,0,0,0,0,0,0));
        return $tablero;
    }

    /**
     * 
     */
    function posicionValida($tablero, $fila, $columna, $posicion, $longitud) {
        if ($posicion=="vertical") {
            if ($fila+$longitud>10) return false;
        }
        elseif ($columna+$longitud>10) return false;
        
        for ($i=max($fila-1,0); $i<min($fila+$longitud+1,10); $i++) 
            for ($j=max($columna-1,0); $j<min($columna+$longitud+1,10); $j++)
                if (!$tablero[$i][$j]==0) return false;
        return true;
    }

    /**
     * 
     */
    function colocaBarcos($tablero) {
        for ($i=0; $i<sizeof(LONGITUD_BARCOS); $i++) { 
            $posicion = (rand(1,2)==1) ? "vertical" : "horizontal";
            do {
                $fila = rand(0,9);
                $columna = rand(0,9);
            } while (!posicionValida($tablero, $fila, $columna, $posicion, LONGITUD_BARCOS[$i]));
            
            if ($posicion=="vertical")
                for ($j=$fila; $j<$fila+LONGITUD_BARCOS[$i]; $j++) $tablero[$j][$columna] = LONGITUD_BARCOS[$i];
            else
                for ($j=$columna; $j<$columna+LONGITUD_BARCOS[$i]; $j++) $tablero[$fila][$j] = LONGITUD_BARCOS[$i];
        }
        return $tablero;
    }

    /**
     * 
     */
    function generaTablero() {
        $tablero = iniciaTablero();
        $tablero = colocaBarcos($tablero);
        return $tablero;
    }
    
    /**
     * 
     */
    function imprimeTablero($tablero) {
        echo "<table>";
        for ($i=0; $i<sizeof($tablero); $i++) { 
            echo "<tr>";
            for ($j=0; $j<sizeof($tablero); $j++)
                echo "<td>".CASILLAS_SVG[$tablero[$i][$j]]."</td>";
                //echo "<td class="."c".$tablero[$i][$j]."></td>";
                //echo "<td class="."c".$tablero[$i][$j].">".$tablero[$i][$j]."</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
?>