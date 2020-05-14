<?php

    class Cola {

        private $_array = array();

        public function __construct() {

        }

        /**
         * Añade un elemento a la cola
         */
        public function addElement($a) {
            if (sizeof($this->_array)==10) throw new Exception();   //Tope de 10 elementos, suficiente para ver su funcionamiento
            $a = limpiarDatos($a);
            array_push($this->_array,$a);
        }

        /**
         * Elimina el elemento de arriba de la cola
         */
        public function delElement() {
            array_shift($this->_array);
        }

        /**
         * Borra el contenido de la cola
         */
        public function clear() {
            array_splice($this->_array,0,sizeof($this->_array));
        }

        /**
         * Devuelve el elemento de arriba de la cola
         */
        public function getElement() {
            return $this->_array[0];
        }

        /**
         * Devuelve el total de elementos que contiene la cola
         */
        public function getNumElements() {
            return sizeof($this->_array);
        }

        /**
         * Imprime contenido de la cola
         */
        public function __toString() {
            //print_r($this->_array);
            echo "<b>Elementos de la cola:</b>"."<br>";
            for ($i=0; $i<sizeof($this->_array); $i++) 
                echo $this->_array[$i]."<br/>";
        }
    }
?>