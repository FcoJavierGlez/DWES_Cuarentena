<?php
    /**
     * 
     */
    function imprimeTabla($resultados) {
        echo "<table>";
        echo "<tr class='fila negrita'><td colspan='3'>Equipo</td><td>Victorias</td><td>Derrotas</td></tr>";
        for ($i=0; $i<sizeof($resultados); $i++) 
            echo "<tr class='fila'>
            <td>".($i+1)."</td>
            <td><img src="."img/".$resultados[$i]["logo"]."></td>
            <td>".$resultados[$i]["nombreEquipo"]."</td>
            <td>".$resultados[$i]["victorias"]."</td>
            <td>".$resultados[$i]["derrotas"]."</td>
            </tr>";
        echo "</table>";
    }
?>