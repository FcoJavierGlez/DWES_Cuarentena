<?php
    //include "class/Jugador.php";
    class IA extends Jugador {

        public function __construct() {
            parent::__construct();
        }

        /**
         * La IA, suponiendo que sea la banca, reparte las cartas en la mesa.
         * Una carta visible para el jugador humano y para la propia banca, además, 
         * una segunda carta para la banca que se reparte bocaabajo.
         */
        public function reparteCartas() {
            for ($i=0; $i<2; $i++)              //La banca se reparte dos cartas
                $this->pideCarta();
            $this->_mano[1]->setOculta(true);   //La segunda de sus cartas está bocaabajo (oculta)
            $_SESSION['jugador']->pideCarta();  //El jugador humano recibe su carta visible
        }

        /**
         * La IA comienza a jugar y pedirá carta mientras la puntuación 
         * de todas las cartas visibles en su mano sea inferior a la del
         * jugador humano.
         */
        public function jugar() {
            $this->_mano[1]->setOculta(false);  //La banca revela la carta que tenía oculta y empieza a pedir cartas si es necesario
            while ($this->getPuntos() < $_SESSION['jugador']->getPuntos()) 
                $this->pideCarta();
        }
    }
?>