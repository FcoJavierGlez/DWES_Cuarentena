<?php
    function esPrimo($num) {
        if ($num<=1) return false;
        for ($i=2; $i<=sqrt($num); $i++) 
            if ($num%$i==0) return false;
        return true;
    }

    function primerosNPrimos($n) {
        $array = array();
        $numero = 2;
        $contador = 0;
        do {
            if (esPrimo($numero)){
                array_push($array,$numero);
                $contador++;
            }
            $numero++;
        } while ($contador < $n);
        return $array;
    }
?>