<?php
    include "resources/funciones.php";

    class Pila {

        private $_array = array();

        public function __construct() {

        }

        /**
         * Añade un elemento arriba de la pila
         */
        public function addElement($a) {
            $a = limpiarDatos($a);
            array_unshift($this->_array,$a);
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
            array_splice($this->_array,0,sizeof($this->_array));
        }

        /**
         * Devuelve el elemento de arriba de la pila
         */
        public function getElement() {
            return $this->_array[0];
        }

        /**
         * Imprime contenido de la pila
         */
        public function __toString() {
            print_r($this->_array);
            for ($i=0; $i<sizeof($this->_array); $i++) 
                echo $this->_array[$i]."<br/>";
        }
    }
?>