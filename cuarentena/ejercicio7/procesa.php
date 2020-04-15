<?php
    /**
     * 
     */
    
    if (isset($_POST['procesar'])) {

        $resultados = $_POST["numero"];

        $multiplicandos = explode(",",$_POST["multiplicandos"]);
        $multiplicadores = explode(",",$_POST["multiplicadores"]);

        $sinResponder = 0;
        $aciertos = 0;
        $fallos = 0;

        $k = 0;

        echo "<link rel='stylesheet' href='css/tablas.css'>";
        echo "<table>";
        echo "<tr class='fila negrita'>
            <td></td><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td>
            <td>6</td><td>7</td><td>8</td><td>9</td><td>10</td></tr>";
        for ($i=0; $i<sizeof($multiplicandos); $i++) { 
            echo "<tr class='fila'>";
            for ($j=0; $j<11; $j++) {
                $correcto = false;
                if ($j==0) echo "<td class='negrita'>$multiplicandos[$i]</td>";
                elseif ($multiplicadores[min($k,sizeof($multiplicadores)-1)]==$j) {
                    if (empty($resultados[$multiplicandos[$i]][$j])) 
                        $sinResponder++;
                    elseif ($resultados[$multiplicandos[$i]][$j]==$multiplicandos[$i]*$j) {
                        $aciertos++;
                        $correcto = true;
                    }
                    else 
                        $fallos++;
                    $clase = ($correcto) ? "class='correcto'" : "class='error'";
                    echo (empty($resultados[$multiplicandos[$i]][$j])) ? 
                    "<td class='blanco'><input type='text' class='error' value='' ></td>" : 
                    "<td class='blanco'><input type='text' ".$clase." value=".$resultados[$multiplicandos[$i]][$j]." ></td>";
                    $k++;
                }
                else echo "<td>".($multiplicandos[$i]*$j)."</td>";
            }
            echo "</tr>";
        }
        echo "</table>";

        echo "Respuestas correctas: $aciertos<br/>";
        echo "Respuestas erróneas: $fallos<br/>";
        echo "Sin responder: $sinResponder<br/>";
        
    }
?>