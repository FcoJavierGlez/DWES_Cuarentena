<?php
    
    class Jugador {

        private $_mano;
        private $_estadoJuego;

        public function __construct() {
            $this->_mano = array();
            $this->_estadoJuego = 1;
        }

        /**
         * El jugador toma una carta de la baraja y la añade a su mano
         */
        public function pideCarta() {
            $carta = rand(0,sizeof($_SESSION['baraja']->getMazo())-1);
            array_push($this->_mano, new Carta($_SESSION['baraja']->getMazo()[$carta]->getPalo(),$_SESSION['baraja']->getMazo()[$carta]->getNumero()));
            $_SESSION['baraja']->sacarCarta($carta);
        }

        /**
         * Devuelve el total de puntos que suma la mano del jugador
         * 
         * @return {Double} Total de puntos que vale la mano del jugador
         */
        public function getPuntos() {
            $total = 0;
            for ($i=0; $i<sizeof($this->_mano); $i++) 
                $total += ($this->_mano[$i]->getOculta()) ? 0 : $this->_mano[$i]->getValor();
            return $total;
        }

        /**
         * Imprime en pantalla la mano que posee el jugador
         */
        public function mostrarMano() {
            for ($i=0; $i<sizeof($this->_mano); $i++)
                echo "<img src=".$this->_mano[$i]->getUrlImg()." alt=".$this->_mano[$i]->getNombreCarta()." 
                        title=".$this->_mano[$i]->getNombreCarta().">";
        }

        /**
         * Devuelve la situación de juego en la que se encuentra el jugador
         * -1: Ha perdido
         * 0: Se ha plantado
         * 1: Actualmente en juego
         * 
         * @return {int} Valor numérito del estado de juego: -1 (perdido), 0 (plantado), 1 (jugando)
         */
        public function getEstadoJuego() {
            return $this->_estadoJuego;
        }

        /**
         * Asigna la situación de juego en la que se encuentra el jugador
         * -1: Ha perdido
         * 0: Se ha plantado
         * 1: Actualmente en juego
         * 
         * @param {int} Valor numérito del estado de juego: -1 (perdido), 0 (plantado), 1 (jugando)
         */
        public function setEstadoJuego($num) {
            if ($num<-1 || $num>1) return;
            $this->_estadoJuego = $num;
        }

        /**
         * El jugador puede ocultar una carta
         */
        public function ocultarCarta($num,$valor) {
            $this->_mano[$num]->setOculta($valor);
        }
    }
?>