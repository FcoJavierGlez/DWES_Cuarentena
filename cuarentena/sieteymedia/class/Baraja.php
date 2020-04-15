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
            for ($i=0; $i<sizeof($this->_mazo); $i++)
                echo "<img src=".$this->_mazo[$i]->getUrlImg()." alt=".$this->_mazo[$i]->getNombreCarta()." 
                        title=".$this->_mazo[$i]->getNombreCarta().">";
        }

        /**
         * Devuelve el array que compone el mazo
         * 
         * @return {Array} Array de objetos carta
         */
        public function getMazo() {
            return $this->_mazo;
        }

        /**
         * Saca o elimina una carta del mazo, se elimina la posición que se pase como parámetro
         * 
         * @param {int} Índice de la carta a eliminar del mazo
         */
        public function sacarCarta($num) {
            array_splice($this->_mazo,$num,1);
        }
    }
?>