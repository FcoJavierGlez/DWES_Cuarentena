<?php
    function imprimeDatos($nombre) {
        $file = fopen("db/".$nombre.".txt", "r") or exit("No se ha encontrado el fichero");
        $i = 0;
        
        while (($line = fgets($file)) !== false) {
            if ($i>3) 
                echo $line."<br/>";
            $i++;
        }
        fclose($file);
    }

    function extraerDatos() {
        $file = fopen("db/users.txt", "r") or exit("No se ha encontrado el fichero");
        $i = 0;
        $salida = array();
        
        while (($line = fgets($file)) !== false) {
            if ($i>3) 
                array_push($array,$line);
            $i++;
        }
        fclose($file);
        return $salida;
    }
?>