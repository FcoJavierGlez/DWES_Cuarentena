<?php

    class Pila {

        private $_array = array();

        public function __construct() {

        }

        /**
         * Añade un elemento arriba de la pila
         */
        public function addElement($a) {
            if ( sizeof($this->_array) == 10 ) throw new Exception();   //Tope de 10 elementos, suficiente para ver su funcionamiento
            $a = limpiarDatos($a);
            array_unshift($this->_array, $a);
        }

        /**
         * Elimina el elemento de arriba de la pila
         */
        public function delElement() {
            array_shift($this->_array);
        }

        /**
         * Borra el contenido de la pila
         */
        public function clear() {
            array_splice( $this->_array, 0, sizeof($this->_array) );
        }

        /**
         * Devuelve el elemento de arriba de la pila
         */
        public function getElement() {
            return $this->_array[0];
        }

        /**
         * Devuelve el total de elementos que contiene la pila
         */
        public function getNumElements() {
            return sizeof($this->_array);
        }

        /**
         * Imprime contenido de la pila
         */
        public function __toString() {
            echo "<b>Elementos de la pila:</b>"."<br>";
            for ($i=0; $i<sizeof($this->_array); $i++) 
                echo $this->_array[$i]."<br/>";
        }
    }
?>