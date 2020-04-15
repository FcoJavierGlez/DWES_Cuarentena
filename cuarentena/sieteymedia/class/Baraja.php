<?php
    include "class/Carta.php";

    class Baraja {

        private $_mazo = array();

        public function __construct() {
            for ($i=0; $i<40; $i++)
                array_push($this->_mazo,new Carta(intval($i/10),(($i+1)%10==0) ? 10 : (($i+1)%10)));
        }

        public function mostrarBaraja() {
            for ($i=0; $i<sizeof($this->_mazo); $i++)
                echo "<img src=".$this->_mazo[$i]->getUrlImg()." alt=".$this->_mazo[$i]->getNombreCarta()." title=".$this->_mazo[$i]->getNombreCarta().">";
        }
    }
?>