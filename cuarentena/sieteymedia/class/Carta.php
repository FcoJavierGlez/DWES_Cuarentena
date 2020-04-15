<?php
    class Carta {
        private $_palo;     //Almacenamos un num 0-3
        private $_numero;
        private $_oculta;

        public function __construct($palo,$numero) {
            $this->_palo = $palo; 
            $this->_numero = $numero;
            $this->_oculta = false;
        }

        /**
         * Devuelve el palo de la carta
         * 
         * @return {int} Palo
         */
        public function getPalo() {
            return $this->_palo;
        }

        /**
         * Devuelve el número de la carta
         * 
         * @return {int} Numero
         */
        public function getNumero() {
            return $this->_numero;
        }

        /**
         * Devuelve el valor en puntos de la carta seleccionada
         * 
         * @return {Double} Valor en puntos 1-7 || 0.5
         */
        public function getValor() {
            switch ($this->_numero) {
                case 8:
                case 9:
                case 10:
                    return 0.5;
                default:
                    return $this->_numero;
            }
        }

        /**
         * Devuelve el nombre del palo de la carta
         * 
         * @return {String} Palo
         */
        private function getNombrePalo() {
            switch ($this->_palo) {
                case 0:
                    return "bastos";
                case 1:
                    return "copas";
                case 2:
                    return "espadas";
                case 3:
                    return "oros";
            }
        }

        /**
         * Devuelve nombre de la figura si es que posee una figura con nombre, 
         * de lo contrario devuelve el número de la carta
         * 
         * @return {String} Nombre de la figura o número de la carta (en caso no de ser figura)
         */
        private function getFigura() {
            switch ($this->_numero) {
                case 1:
                    return "As";
                case 8:
                    return "Sota";
                case 9:
                    return "Caballo";
                case 10:
                    return "Rey";
                default:
                    return $this->_numero;
            }
        }

        /**
         * Devuelve el nombre de la carta, por ejemplo "Rey de bastos" o "3 de espadas"
         * 
         * @return {String} Nombre de la carta
         */
        public function getNombreCarta() {
            return $this->getFigura()." de ".$this->getNombrePalo();
        }

        /**
         * Devuelve la url del recurso de la carta
         * 
         * @return {String} URL de la imagen de la carta
         */
        public function getUrlImg() {
            return ($this->_oculta) ? "img/0.jpg" : "img/".$this->getNombrePalo()."/".$this->getNumero().".jpg";
        }

        /**
         * Asigna a una carta la propiedad de estar o no oculta (bocaabajo)
         * 
         * @param {Boolean} True o false en función de si queremos ocultar o desocultar la carta
         */
        public function setOculta($boolean) {
            $this->_oculta = $boolean;
        }
    }
?>