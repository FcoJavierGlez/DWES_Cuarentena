<?php
    /**
     * 
     */
    include "resources/datos.php";

    /**
     * Genera un tablero cuadrado del tamaño que se le pase como parámetro
     */
    function generaTablero($tamanno) {
        $tablero = array();
        for ($i=0; $i<$tamanno; $i++) { 
            array_push($tablero, array());
            for ($j=0; $j<$tamanno; $j++) 
                array_push($tablero[$i], "");
        }
        return $tablero;
    }

    /**
     * Comprueba que el número de capital no esté ya elegida
     */
    function validarCapitalElegida($capitalesSeleccionadas, $capitalElegida) {
        for ($i=0; $i<sizeof($capitalesSeleccionadas); $i++) 
            if ($capitalesSeleccionadas[$i]==$capitalElegida) return false;
        return true;
    }

    /**
     * Devuelve un número aleatorio que no esté repetido en el array de capitalesSeleccionadas
     */
    function seleccionaCapital($capitalesSeleccionadas) {
        do {
            $capitalElegida = rand(0,29);
        } while (!validarCapitalElegida($capitalesSeleccionadas, $capitalElegida));

        return $capitalElegida;
    }

    /**
     * Devuelve en forma de Booleano si la longitud del nombre de la capital
     * cabe dentro del array en función al sentido y las coordenadas dadas
     * o si se sale del array.
     * 
     * @return Boolean True si la longitud cabe para las condiciones dadas, False si no cabe.
     */
    function validaLongitud($coordFila,$coordColumna,$lengthCapital,$sentido,$longitudTablero) {
        switch ($sentido) {
            case 0: //fila--
                return ($coordFila-$lengthCapital>=0);
            case 1: //fila--, columna++
                return ($coordFila-$lengthCapital>=0 && $coordColumna+$lengthCapital<=$longitudTablero-1);
            case 2: //columna++
                return ($coordColumna+$lengthCapital<=$longitudTablero-1);
            case 3: //fila++, columna++
                return ($coordFila+$lengthCapital<=$longitudTablero-1 && $coordColumna+$lengthCapital<=$longitudTablero-1);
            case 4: //fila++
                return ($coordFila+$lengthCapital<=$longitudTablero-1);
            case 5: //fila++, columna--
                return ($coordFila+$lengthCapital<=$longitudTablero-1 && $coordColumna-$lengthCapital>=0);
            case 6: //columna--
                return ($coordColumna-$lengthCapital>=0);
            case 7: //fila--, columna--
                return ($coordFila-$lengthCapital>=0 && $coordColumna-$lengthCapital>=0);
        }
    }

    function validarPosicionLetras($tablero,$coordFila,$coordColumna,$nombreCapital,$incrementoFil,$incrementoCol) {
        $coordFilaFinal = $coordFila+strlen($nombreCapital)*$incrementoFil;
        $coordColumnaFinal = $coordColumna+strlen($nombreCapital)*$incrementoCol;
        $indiceCapital = 0;
        while (!($coordFila==$coordFilaFinal && $coordColumna==$coordColumnaFinal)) {
            //Si la posición de tablero no es una cadena vacía o no coincide las letras con la letra de la capital a insertar 
            if (!($tablero[$coordFila][$coordColumna]== "" || 
            $tablero[$coordFila][$coordColumna] == substr($nombreCapital, $indiceCapital, 1)))
                return false;
            
            $coordFila += $incrementoFil;
            $coordColumna += $incrementoCol;
            $indiceCapital++;
        }
        return true;
    }

    function validaUbicacion($tablero,$coordFila,$coordColumna,$nombreCapital,$sentido) {
        switch ($sentido) {
            case 0: //fila--
                return ValidarPosicionLetras($tablero,$coordFila,$coordColumna,$nombreCapital,-1,0);
            case 1: //fila--, columna++
                return ValidarPosicionLetras($tablero,$coordFila,$coordColumna,$nombreCapital,-1,1);
            case 2: //columna++
                return ValidarPosicionLetras($tablero,$coordFila,$coordColumna,$nombreCapital,0,1);
            case 3: //fila++, columna++
                return ValidarPosicionLetras($tablero,$coordFila,$coordColumna,$nombreCapital,1,1);
            case 4: //fila++
                return ValidarPosicionLetras($tablero,$coordFila,$coordColumna,$nombreCapital,1,0);
            case 5: //fila++, columna--
                return ValidarPosicionLetras($tablero,$coordFila,$coordColumna,$nombreCapital,1,-1);
            case 6: //columna--
                return ValidarPosicionLetras($tablero,$coordFila,$coordColumna,$nombreCapital,0,-1);
            case 7: //fila--, columna--
                return ValidarPosicionLetras($tablero,$coordFila,$coordColumna,$nombreCapital,-1,-1);
        }
    }

    function insertar($tablero,$coordFila,$coordColumna,$nombreCapital,$incrementoFil,$incrementoCol) {
        $coordFilaFinal = $coordFila+strlen($nombreCapital)*$incrementoFil;
        $coordColumnaFinal = $coordColumna+strlen($nombreCapital)*$incrementoCol;
        $indiceCapital = 0;
        while (!($coordFila==$coordFilaFinal && $coordColumna==$coordColumnaFinal)) {
            //$tablero[$coordFila][$coordColumna] = "<b>".substr($nombreCapital, $indiceCapital, 1)."</b>";
            $tablero[$coordFila][$coordColumna] = substr($nombreCapital, $indiceCapital, 1);
            
            $coordFila += $incrementoFil;
            $coordColumna += $incrementoCol;
            $indiceCapital++;
        }
        return $tablero;
    }

    function insertaCapital($tablero,$coordFila,$coordColumna,$nombreCapital,$sentido) {
        switch ($sentido) {
            case 0: //fila--
                $tablero = insertar($tablero,$coordFila,$coordColumna,$nombreCapital,-1,0);
                return $tablero;
            case 1: //fila--, columna++
                $tablero = insertar($tablero,$coordFila,$coordColumna,$nombreCapital,-1,1);
                return $tablero;
            case 2: //columna++
                $tablero = insertar($tablero,$coordFila,$coordColumna,$nombreCapital,0,1);
                return $tablero;
            case 3: //fila++, columna++
                $tablero = insertar($tablero,$coordFila,$coordColumna,$nombreCapital,1,1);
                return $tablero;
            case 4: //fila++
                $tablero = insertar($tablero,$coordFila,$coordColumna,$nombreCapital,1,0);
                return $tablero;
            case 5: //fila++, columna--
                $tablero = insertar($tablero,$coordFila,$coordColumna,$nombreCapital,1,-1);
                return $tablero;
            case 6: //columna--
                $tablero = insertar($tablero,$coordFila,$coordColumna,$nombreCapital,0,-1);
                return $tablero;
            case 7: //fila--, columna--
                $tablero = insertar($tablero,$coordFila,$coordColumna,$nombreCapital,-1,-1);
                return $tablero;
        }
    }

    /**
     * Selecciona y añade 5 capitales de la lista de CAPITALES en el array tablero.
     * 
     * Éstas capitales pueden tener sentido vertical, horizontal o diagonal pudiendo curzarse entre sí 
     * en aquellas posiciones donde las letras de ambas capitales sean coincidentes.
     * 
     *   El sentido puede ser:
     * 
     * 0: Vertical (abajo->arriba)                      | fila--
     * 1: Diagonal (izquierda->derecha, abajo->arriba)  | fila--, columna++
     * 2: Horizontal (izquierda->derecha)               | columna++
     * 3: Diagonal (izquierda->derecha, arriba->abajo)  | fila++, columna++
     * 4: Vertical (arriba->abajo)                      | fila++
     * 5: Diagonal (derecha->izquierda, arriba->abajo)  | fila++, columna--
     * 6: Horizontal (derecha->izquierda)               | columna--
     * 7: Diagonal (derecha->izquierda. abajo->arriba)  | fila--, columna--
     */
    function colocaCapitales($tablero) {
        $capitalesSeleccionadas = array();
        for ($i=0; $i<15; $i++) { 
            array_push($capitalesSeleccionadas, seleccionaCapital($capitalesSeleccionadas));

            $sentido = rand(0,7);

            do {
                $coordFila = rand(0,sizeof($tablero[0])-1);
                $coordColumna = rand(0,sizeof($tablero[0])-1);
            } while (!(validaLongitud($coordFila,$coordColumna,strlen(CAPITALES[$capitalesSeleccionadas[$i]]),$sentido,sizeof($tablero[0]))
                        && validaUbicacion($tablero,$coordFila,$coordColumna,CAPITALES[$capitalesSeleccionadas[$i]],$sentido)));
            
            $tablero = insertaCapital($tablero,$coordFila,$coordColumna,CAPITALES[$capitalesSeleccionadas[$i]],$sentido);
        }
        
        return $tablero;
    }

    function rellena($tablero) {
        for ($i=0; $i<sizeof($tablero[0]); $i++) 
            for ($j=0; $j<sizeof($tablero[0]); $j++) 
                if ($tablero[$i][$j] == "") $tablero[$i][$j] = LETRAS[rand(0,26)];
        return $tablero;
    }

    function generaSopaLetras() {
        $tablero = generaTablero(20);
        $tablero = colocaCapitales($tablero);
        $tablero = rellena($tablero);
        return $tablero;
    }

    function imprimeSopaLetras($sopaLetras) {
        echo "<table>";
        for ($i=0; $i<sizeof($sopaLetras[0]); $i++) {
            echo "<tr>";
            for ($j=0; $j<sizeof($sopaLetras[0]); $j++) 
                echo "<td>".$sopaLetras[$i][$j]."</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
?>