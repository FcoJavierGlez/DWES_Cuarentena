<?php
    /**
     * 
     */
    
    if (isset($_POST['procesar'])) {

        $resultados = $_POST["numero"];

        $multiplos = explode(",",$_POST["multiplos"]);

        $sinResponder = 0;
        $aciertos = 0;
        $fallos = 0;

        for ($i=0; $i<sizeof($multiplos); $i++) { 
            for ($j=1; $j<11; $j++) {
                if (empty($resultados[$multiplos[$i]][$j]))
                    $sinResponder++;
                elseif ($resultados[$multiplos[$i]][$j]==$multiplos[$i]*$j)
                    $aciertos++;
                else
                    $fallos++;
            }
        }

        echo "Respuestas correctas: $aciertos<br/>";
        echo "Respuestas erróneas: $fallos<br/>";
        echo "Sin responder: $sinResponder<br/>";
        
    }
?>