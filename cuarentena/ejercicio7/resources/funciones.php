<?php
    function tablasMultiplicar($multiplicandos,$multiplicadores) {
        $k = 0;
        echo "<table>";
        echo "<tr class='fila negrita'>
            <td></td><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td>
            <td>6</td><td>7</td><td>8</td><td>9</td><td>10</td></tr>";
        for ($i=0; $i<sizeof($multiplicandos); $i++) {
            echo "<tr class='fila'>";
            for ($j=0; $j<11; $j++) {
                if ($j==0) echo "<td class='negrita'>$multiplicandos[$i]</td>";
                else {
                    if ($multiplicadores[min($k,sizeof($multiplicadores)-1)]==$j) {
                        echo "<td><input type='text' name='numero[".$multiplicandos[$i]."][".$j."]'></td>";
                        $k++;
                    } 
                    else echo "<td>".($multiplicandos[$i]*$j)."</td>";
                }
            }
            echo "</tr>";
        }
        echo "</table>";
    }

    function validaNum($num,$array) {
        for ($i=0; $i<sizeof($array); $i++) 
            if ($num==$array[$i]) return false;
        return true;
    }

    function getMultiplicadores($totalMultiplicandos,$n) {
        $salida = "";
        for ($i=0; $i<$totalMultiplicandos; $i++) { 
            $array = array();
            $j = 0;
            do {
                $num = rand(2,9);
                while (!validaNum($num,$array)) {
                    $num = rand(2,9);
                }
                array_push($array,$num);
                $j++;
            } while ($j<$n);
            sort($array);
            if ($i>0) $salida = $salida.",";
            $salida = $salida.implode(",",$array);
        }
        return explode(",",$salida);
    }

    function imprFormTablas() {
        echo "<p>Marque las tablas de multiplicar que desea repasar</p>";
        echo "<form action=".$_SERVER['PHP_SELF']." method='post'>";
        /* echo "Elija una dificultad: <select name='dificultad'>";
        for ($i=1; $i<9; $i++) 
            echo ($i==1) ? "<option value=".$i." selected>".$i."</option>" : "<option value=".$i.">".$i."</option>";
        echo "</select><br/>"; */
        for ($i=1; $i<11; $i++) 
            echo "Tabla ".$i.": <input type='checkbox' value=".$i." name='tablas[]'><br/>";
        echo "<input type='submit' name='enviar'>";
        echo "</form>";
    }

    function limpiarDatos($dato) {
        $dato = trim($dato);
        $dato=stripcslashes($dato);
        $dato = htmlspecialchars($dato);
        return $dato;
    }
?>