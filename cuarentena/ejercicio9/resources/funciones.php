<?php
    function getUser($nombre) {
        return substr(normalizaCadena(explode(" ",$nombre)[0]),0,2).substr(normalizaCadena(explode(" ",$nombre)[1]),0,2).substr(normalizaCadena(explode(" ",$nombre)[2]),0,2);
    }

    function normalizaCadena($cadena) {
        $acentos = array("á","é","í","ó","ú","Á","É","Í","Ó","Ú","Ñ","ñ");
        $letras = array("a","e","i","o","u","a","e","i","o","u","n","n");
        return str_replace($acentos, $letras, strtolower($cadena));
    }

    $usuarios = array();

    $file = fopen("Alumnos.txt", "r") or exit("Unable to open file!");
    //Output a line of the file until the end is reached

    $i = 0;

    if ($file) {
        while (($line = fgets($file)) !== false) {
            if ($i>7) {
                $numUser = 0;
                if (in_array(getUser($line),$usuarios)) {
                    do {
                        $numUser++;
                    } while (in_array(getUser($line).$numUser,$usuarios));
                    array_push($usuarios,getUser($line).$numUser);
                } else 
                    array_push($usuarios,getUser($line));
            }
            $i++;
        }
    } else
        echo "El fichero no pudo ser abierto.";

    //imprimir lista de usuarios:
    for ($i=0; $i<sizeof($usuarios); $i++) 
        echo $usuarios[$i]."<br/>";
?>