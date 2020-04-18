<?php
    /**
     * 
     */
    include "class/Barco.php";

    class Tablero {

        private $_tablero = array();
        private $_tableroVisible = array();
        private $_listaBarcos = array();

        private $_svg = array(
            "<svg width='45' height='45'>
            <rect width='45' height='45' fill='white' stroke-width='1' stroke='black' rx='10' />
            </svg>",
            "<svg width='45' height='45'>
            <rect width='45' height='45' fill='red' stroke-width='1' stroke='black' rx='10' />
            </svg>",
            "<svg width='45' height='45'>
            <rect width='45' height='45' fill='grey' stroke-width='1' stroke='black' rx='10' />
            </svg>",
            "<svg width='45' height='45'>
            <rect width='45' height='45' fill='orange' stroke-width='1' stroke='black' rx='10' />
            </svg>",
            "<svg width='45' height='45'>
            <rect width='45' height='45' fill='dodgerblue' stroke-width='1' stroke='black' rx='10' />
            </svg>"
        );

        public function __construct() {
            for ($i=0; $i<10; $i++) {
                array_push($this->_tablero, array(0,0,0,0,0,0,0,0,0,0));
                array_push($this->_tableroVisible, array(0,0,0,0,0,0,0,0,0,0));
            }
        }

        /**
         * Valida que el barco no se saldrá del tablero.
         * 
         * @param {$fila}       Fila del módulo inicial
         * @param {$columna}    Columna del módulo inicial
         * @param {$tipo}       Longitud del barco
         * @param {$direccion}  Dirección del barco (0-3)
         * 
         * @return {Boolean}    True si la posición es correcta, false si no lo es
         */
        private function longitudValida($fila,$columna,$tipo,$direccion) {
            switch ($direccion) {
                case 0:
                    return ($fila+$tipo<=10);
                case 1:
                    return ($columna-$tipo>=0);
                case 2:
                    return ($fila-$tipo>=0);
                case 3:
                    return ($columna+$tipo<=10);
            }
        }

        /**
         * Valida que el area del barco que queremos inscribir en el tablero está libre
         * de otros barcos.
         * 
         * @param {$fila}           Fila del módulo inicial
         * @param {$columna}        Columna del módulo inicial
         * @param {$tipo}           Longitud del barco
         * @param {$incrementoFil}  El incremento de la fila (si el barco es horizontal valdrá 0) si se escribe
         *                          de abajo a arriba valdrá -1, de arriba a abajo valdrá 1.
         * @param {$incrementoCol}  El incremento de la columna (si el barco es vertical valdrá 0) si se escribe
         *                          de derecha a izquierda valdrá -1, de izquierda a derecha valdrá 1.
         * 
         * @return {Boolean}        True si el área es válida, false si no lo es. 
         */
        private function validarArea($fila,$columna,$tipo,$incrementoFil,$incrementoCol) {
            $filaFinal = $fila+($tipo-1)*$incrementoFil;
            $columnaFinal = $columna+($tipo-1)*$incrementoCol;

            $inicioFilaArea = ($fila<=$filaFinal) ? max($fila-1,0) : max($filaFinal-1,0);
            $finalFilaArea = ($fila>=$filaFinal) ? min($fila+1,9) : min($filaFinal+1,9);
            
            $inicioColumnaArea = ($columna<=$columnaFinal) ? max($columna-1,0) : max($columnaFinal-1,0);
            $finalColumnaArea = ($columna>=$columnaFinal) ? min($columna+1,9) : min($columnaFinal+1,9);

            for ($i=$inicioFilaArea; $i<$finalFilaArea+1; $i++) 
                for ($j=$inicioColumnaArea; $j<$finalColumnaArea+1; $j++) 
                    if (!$this->_tablero[$i][$j]==0) 
                        return false;
            
            return true;
        }

        /**
         * Devuelve si la ubicación dónde se desea insertar el barco es válida o no
         * tras comprobar que el área esté libre de posibles colisiones con otros barcos.
         * 
         * @param {$fila}           Fila del módulo inicial
         * @param {$columna}        Columna del módulo inicial
         * @param {$tipo}           Longitud del barco
         * @param {$direccion}      Dirección a la que apunta el barco (0-3)
         */
        private function ubicacionValida($fila,$columna,$tipo,$direccion) {
            switch ($direccion) {
                case 0:
                    return $this->validarArea($fila,$columna,$tipo,1,0);
                case 1:
                    return $this->validarArea($fila,$columna,$tipo,0,-1);
                case 2:
                    return $this->validarArea($fila,$columna,$tipo,-1,0);
                case 3:
                    return $this->validarArea($fila,$columna,$tipo,0,1);
            }
        }

        /**
         * Inserta en el tablero numérico el valor del tipo de barco.
         * 
         * @param {$fila}           Fila del módulo inicial
         * @param {$columna}        Columna del módulo inicial
         * @param {$tipo}           Longitud del barco
         * @param {$incrementoFil}  El incremento de la fila (si el barco es horizontal valdrá 0) si se escribe
         *                          de abajo a arriba valdrá -1, de arriba a abajo valdrá 1.
         * @param {$incrementoCol}  El incremento de la columna (si el barco es vertical valdrá 0) si se escribe
         *                          de derecha a izquierda valdrá -1, de izquierda a derecha valdrá 1.
         */
        private function insertar($fila,$columna,$tipo,$incrementoFil,$incrementoCol) {
            $filaFinal = $fila+$tipo*$incrementoFil;
            $columnaFinal = $columna+$tipo*$incrementoCol;

            while (!($fila==$filaFinal && $columna==$columnaFinal)) {
                //$this->_tablero[$fila][$columna] = $tipo;
                $this->_tablero[$fila][$columna] = 2;
                
                $fila += $incrementoFil;
                $columna += $incrementoCol;
            }
        }

        /**
         * Inserta un barco en el tablero numérico.
         * 
         * @param {$fila}       Fila del módulo inicial
         * @param {$columna}    Columna del módulo inicial
         * @param {$tipo}       Longitud del barco
         * @param {$direccion}  Dirección del barco (0-3)
         */
        private function insertaBarco($fila,$columna,$tipo,$direccion) {
            switch ($direccion) {
                case 0:
                    return $this->insertar($fila,$columna,$tipo,1,0);
                case 1:
                    return $this->insertar($fila,$columna,$tipo,0,-1);
                case 2:
                    return $this->insertar($fila,$columna,$tipo,-1,0);
                case 3:
                    return $this->insertar($fila,$columna,$tipo,0,1);
            }
        }

        /**
         * Añade un barco en el tablero de juego tras comprobar que la ubicación 
         * para el mismo es válida.
         * 
         * @param {$fila}       Fila del módulo inicial
         * @param {$columna}    Columna del módulo inicial
         * @param {$tipo}       Longitud del barco
         * @param {$direccion}  Dirección del barco (0-3)
         */
        public function addBarco($fila,$columna,$tipo,$direccion) {
            if (($fila<0 || $fila>9) || ($columna<0 || $columna>9))
                throw new Exception('Fila/columna incorrectas');
            if (!($this->longitudValida($fila,$columna,$tipo,$direccion) && $this->ubicacionValida($fila,$columna,$tipo,$direccion)))
                throw new Exception('Posición inválida. El barco toca con otro ya ubicado o se sale del tablero en esa posición.');
            
            $this->insertaBarco($fila,$columna,$tipo,$direccion);
            array_push($this->_listaBarcos, new Barco($fila,$columna,$tipo,$direccion));
        }

        /**
         * Incrementa el total de barcos hundidos de cada tipo.
         * 
         * @param {$tipo} Longitud del barco que acaba de hundirse
         */
        private function incrementaListaHundidos($tipo) {
            switch ($tipo) {
                case 1:
                    $_SESSION['submarinosHundidos']++;
                    break;
                case 2:
                    $_SESSION['acorazadosHundidos']++;
                    break;
                case 3:
                    $_SESSION['destructoresHundidos']++;
                    break;
                case 4:
                    $_SESSION['portaavionesHundidos']++;
                    break;
            }
        }

        /**
         * Se recibe las coordenadas del impacto
         */
        public function impacto($fila,$columna) {
            if ($this->_tableroVisible[$fila][$columna]!=0) return;
            else {
                if (!$this->_tablero[$fila][$columna]==0) {
                    for ($i=0; $i<sizeof($this->_listaBarcos); $i++) { 
                        if ($this->_listaBarcos[$i]->comprobarImpacto($fila,$columna)) {    //comprobar cuál es el barco impactado
                            $this->_listaBarcos[$i]->destruirModulo($fila,$columna);
                            if ($this->_listaBarcos[$i]->getHundido()) {                    //determinar si el barco se ha hundido
                                $_SESSION['mensajes'] = $this->_listaBarcos[$i]->getMensajeHundido();
                                $this->incrementaListaHundidos($this->_listaBarcos[$i]->getTipo());
                                array_splice($this->_listaBarcos,$i,1);
                            } 
                            else 
                                $_SESSION['mensajes'] = "";
                            break;
                        }
                    }
                    $this->_tableroVisible[$fila][$columna] = 1;
                }
                else {
                    $this->_tableroVisible[$fila][$columna] = 4;
                    $_SESSION['mensajes'] = "";
                }
            }
        }

        /**
         * Devuelve un booleano con el estado de la partida
         * 
         * @return {Boolean} True si la partida ha finalizado, false si no.
         */
        public function finDePartida() {
            return sizeof($this->_listaBarcos) == 0;
        }

        /**
         * Imprime la lista de los barcos con la información de cada uno.
         */
        public function imprimirListaBarcos() {
            for ($i=0; $i<sizeof($this->_listaBarcos); $i++) { 
                echo "<br/>Barco ".($i+1).":<br/>";
                echo "======<br/>";
                $this->_listaBarcos[$i]->imprimeInfoBarco();
            }
        }

        /**
         * Imprime el tablero con la ubicación de los barcos
         */
        public function imprimir() {
            //include_once "resources/datos.php";
            echo "<table>";
            for ($i=0; $i<sizeof($this->_tablero); $i++) { 
                echo "<tr>";
                for ($j=0; $j<sizeof($this->_tablero); $j++)
                    echo "<td>".$this->_svg[$this->_tablero[$i][$j]]."</td>";
                echo "</tr>";
            }
            echo "</table>";
        }

        /**
         * Imprime el tablero visible. Si la partida ha finalizado se imprime una versión
         * sin enlaces.
         * 
         * @param {$finPartida} Booleano, true si la partida ha finalizado.
         */
        public function imprTabVis($finPartida) {
            //include_once "resources/datos.php";
            echo "<table>";
            for ($i=0; $i<sizeof($this->_tableroVisible); $i++) { 
                echo "<tr>";
                for ($j=0; $j<sizeof($this->_tableroVisible); $j++) {
                    if ($finPartida)
                        echo "<td>".$this->_svg[$this->_tableroVisible[$i][$j]]."</td>";
                    else
                        echo ($this->_tableroVisible[$i][$j]!=0) ?  
                        "<td>".$this->_svg[$this->_tableroVisible[$i][$j]]."</td>" :
                        "<td><a href=".$_SERVER['PHP_SELF']."?fila=".$i."&columna=".$j.">".$this->_svg[$this->_tableroVisible[$i][$j]]."</a></td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        }
    }
?>