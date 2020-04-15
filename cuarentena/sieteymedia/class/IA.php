<?php
    //include "class/Jugador.php";
    class IA extends Jugador {

        public function __construct() {
            parent::__construct();
        }

        public function reparteCartas() {
            for ($i=0; $i<2; $i++) 
                $this->pideCarta();
            $this->ocultarCarta(1,true);
            $_SESSION['jugador']->pideCarta();
        }

        public function jugar() {
            $this->ocultarCarta(1,false);
            while ($this->getPuntos() < $_SESSION['jugador']->getPuntos()) {
                $this->pideCarta();
            }
        }
    }
?>