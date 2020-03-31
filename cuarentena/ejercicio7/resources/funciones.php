<?php
    function tablasMultiplicar($array) {
        echo "<table>";
        echo "<tr class='fila negrita'>
            <td></td>
            <td>1</td>
            <td>2</td>
            <td>3</td>
            <td>4</td>
            <td>5</td>
            <td>6</td>
            <td>7</td>
            <td>8</td>
            <td>9</td>
            <td>10</td>
            </tr>";
        for ($i=0; $i<sizeof($array); $i++) {
            echo "<tr class='fila'>";
            for ($j=0; $j<11; $j++) 
                echo ($j==0) ? "<td class='negrita'>$array[$i]</td>" : "<td><input type='text' name='numero[".$array[$i]."][".$j."]'></td>";
            echo "</tr>";
        }
        echo "</table>";
    }

    function imprFormTablas() {
        echo "<p>Marque las tablas de multiplicar que desea repasar</p>";
        echo "<form action=".$_SERVER['PHP_SELF']." method='post'>";
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