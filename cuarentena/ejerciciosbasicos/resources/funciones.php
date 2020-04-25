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

    /**
     * Recibe un número y comprueba si es perfecto
     * 
     * @param {$num}        Número a comprobar.
     * 
     * @return {Boolean}    True si el número perfecto, false si no lo es.
     */
    function esPerfecto($num) {
        if ($num%2!=0) return false;    //Si es impar no es perfecto (hasta la fecha no se conocen números perfectos impares)
        $conjunto = array();
        for ($i=1; $i<=$num/2; $i++) 
            if ($num%$i==0) array_push($conjunto,$i);
        return array_sum($conjunto) == $num;
    }

    /**
     * Recibe como parámetro un número perfecto y devuelve el conjunto de números que sumados entre sí
     * dan como resultado el propio número perfecto.
     * 
     * @param {$num}    Recibe un número perfecto por parámetro
     * 
     * @return {Array}  Devuelve un array con el conjunto numérico que suma el número perfecto
     */
    function getConjuntoNumPerf($num) {
        $conjunto = array();
        for ($i=1; $i<=$num/2; $i++) 
            if ($num%$i==0) array_push($conjunto,$i);
        return $conjunto;
    }

    /**
     * Devuelve un array con el conjunto númerico (array) de acada uno de los n primeros números perfectos
     * 
     * @param {$n}  Total de los primeros números perfectos a buscar
     * 
     * @return {Array}  Devuelve un array bidimensional indexado con el conjunto numérico (array) de cada número perfecto
     *                  ejemplo -> $salida[0] = (1,2,3)
     */
    function primerosNPerfectos($n) {
        $salida = array();      //Array que almacena el total de conjuntos que formarían números perfectos
        $numero = 6;            //Número a comprobar si es perfecto, el primero es el 6.
        $contador = 0;          //El total de números perfectos que hemos hallado.
        do {
            if (esPerfecto($numero)){
                array_push($salida,getConjuntoNumPerf($numero));
                $contador++;
            }
            $numero++;
        } while ($contador < $n);
        return $salida;
    }
?>