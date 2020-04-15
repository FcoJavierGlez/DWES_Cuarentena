<?php
    /**
     * 
     */

    include "resources/datos.php";
    include "class/Barco.php";

    class Tablero {

        private $_tablero = array();
        private $_tableroVisible = array();
        private $_listaBarcos = array();

        public function __construct() {
            for ($i=0; $i<10; $i++) {
                array_push($this->_tablero, array(0,0,0,0,0,0,0,0,0,0));
                array_push($this->_tableroVisible, array(0,0,0,0,0,0,0,0,0,0));
            }
        }

        /**
         * 
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
         * 
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
         * 
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
         * 
         */
        private function insertar($fila,$columna,$tipo,$incrementoFil,$incrementoCol) {
            $filaFinal = $fila+$tipo*$incrementoFil;
            $columnaFinal = $columna+$tipo*$incrementoCol;

            while (!($fila==$filaFinal && $columna==$columnaFinal)) {
                $this->_tablero[$fila][$columna] = $tipo;
                
                $fila += $incrementoFil;
                $columna += $incrementoCol;
            }
        }

        /**
         * 
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
         * 
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
         * 
         */
        public function getValor($fila,$columna) {
            return $this->_tablero[$fila-1][$columna-1];
        }

        /**
         * 
         */
        public function impacto($fila,$columna) {
            if ($this->_tableroVisible[$fila][$columna]!=0) return;
            else {
                $this->_tableroVisible[$fila][$columna] = ($this->_tablero[$fila][$columna]==0) ? 4 : 1;
            }
        }

        /**
         * 
         */
        public function imprimirListaBarcos() {
            for ($i=0; $i<sizeof($this->_listaBarcos); $i++) { 
                echo "<br/>Barco ".($i+1).":<br/>";
                echo "======<br/>";
                $this->_listaBarcos[$i]->imprimeInfoBarco();
            }
        }

        /**
         * 
         */
        public function imprimir() {
            echo "<table>";
            for ($i=0; $i<sizeof($this->_tablero); $i++) { 
                echo "<tr>";
                for ($j=0; $j<sizeof($this->_tablero); $j++)
                    echo "<td>".CASILLAS_SVG[$this->_tablero[$i][$j]]."</td>";
                echo "</tr>";
            }
            echo "</table>";
        }

        /**
         * 
         */
        public function imprTabVis() {
            echo "<table>";
            for ($i=0; $i<sizeof($this->_tableroVisible); $i++) { 
                echo "<tr>";
                for ($j=0; $j<sizeof($this->_tableroVisible); $j++)
                    echo ($this->_tableroVisible[$i][$j]!=0) ?  
                    "<td>".CASILLAS_SVG[$this->_tableroVisible[$i][$j]]."</td>" :
                    "<td><a href=".$_SERVER['PHP_SELF']."?fila=".$i."&columna=".$j.">".CASILLAS_SVG[$this->_tableroVisible[$i][$j]]."</a></td>";
                echo "</tr>";
            }
            echo "</table>";
        }
    }
?>