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

    /**
     * Devuelve el valor de un número romano (un sólo dígito) pasado por parámetro
     * 
     * @param {$numRom} Número (dígito) romano del que deseamos obtener su valor
     * 
     * @return {int}    El valor del número pasado como parámetro
     */
    function getValorNumRom($numRom) {
        switch (strtoupper($numRom)) {
            case 'I':
                return 1;
            case 'V':
                return 5;
            case 'X':
                return 10;
            case 'L':
                return 50;
            case 'C':
                return 100;
            case 'D':
                return 500;
            case 'M':
                return 1000;
            default:
                throw new Exception("Número romano incorrecto");
        }
    }

    /**
     * Convierte un número romano pasado por parámetro a un número arábigo
     */
    function convertirNumRom($numRom) {
        if (strlen($numRom)>1) {
            $resultado = getValorNumRom(substr($numRom,strlen($numRom)-1,1));
            for ($i=strlen($numRom)-1; $i>0; $i--) 
                $resultado += (getValorNumRom(substr($numRom,$i-1,1))>=getValorNumRom(substr($numRom,$i,1))) ? 
                    getValorNumRom(substr($numRom,$i-1,1)) : (getValorNumRom(substr($numRom,$i-1,1))*(-1));
            return $resultado;
        }
        else
            return getValorNumRom($numRom);
    }
?>