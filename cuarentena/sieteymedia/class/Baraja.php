<?php
    include "class/Carta.php";

    class Baraja {

        private $_mazo = array();

        public function __construct() {
            for ($i=0; $i<40; $i++)
                array_push($this->_mazo,new Carta(intval($i/10),(($i+1)%10==0) ? 10 : (($i+1)%10)));
        }

        /**
         * Imprime en pantalla todas las cartas que componen actualmente la baraja la baraja
         */
        public function mostrarBaraja() {
            //array_splice($this->_mazo,10,1);
            for ($i=0; $i<sizeof($this->_mazo); $i++)
                echo "<img src=".$this->_mazo[$i]->getUrlImg()." alt=".$this->_mazo[$i]->getNombreCarta()." 
                        title=".$this->_mazo[$i]->getNombreCarta().">";
        }
    }
?>