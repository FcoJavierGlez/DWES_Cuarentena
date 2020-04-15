<?php
    class Serie {

        private $_nombre;
        private $_plataforma;
        private $_fechaLanzamiento;
        private $_idiomasDisponibles;
        private $_clasEdad;
        private $_temporadas;

        public function __construct($nombre,$plataforma,$temporadas,$fechaLanz,$idiomas,$edad) {
            $this->_nombre = $nombre;
            $this->_plataforma = $plataforma;
            $this->_fechaLanzamiento = ($fechaLanz=="") ? "N/D" : $fechaLanz;
            $this->_idiomasDisponibles = $idiomas;
            $this->_clasEdad = $this->asignaEdad($edad);
            $this->_temporadas = $temporadas;
        }

        private function asignaEdad($clasEdad) {
            switch ($clasEdad) {
                case 0:
                    return "TP";
                case 1:
                    return "+7";
                case 2:
                    return "+12";
                case 3:
                    return "+16";
                default:
                    return "18";
            }
        }

        public function getNombre() {
            return $this->_nombre;
        }

        public function getPlataforma() {
            return $this->_plataforma;
        }

        public function getFechaLanzamiento() {
            return $this->_fechaLanzamiento;
        }

        public function getIdiomas() {
            return $this->_idiomasDisponibles;
        }

        public function getClasEdad() {
            return $this->_clasEdad;
        }

        public function getNumTemporadas() {
            return $this->_temporadas;
        }

    }
?>