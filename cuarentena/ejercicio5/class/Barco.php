<?php

    class Barco {

        private $_modulos;
        private $_tipo;

        public function __construct($fila,$columna,$totalModulos,$direccion) {
            $this->_tipo = $this->asignaTipo($totalModulos);
            $this->_modulos = $this->asignaModulos($fila,$columna,$totalModulos,$direccion);
        }

        /**
         * 
         */
        private function asignaTipo($totalModulos) {
            switch ($totalModulos) {
                case 1:
                    return "Fragata";
                case 2:
                    return "Acorazado";
                case 3:
                    return "Destructor";
                case 4:
                    return "Portaaviones";
            }
        }

        /**
         * 
         */
        private function creaModulos($fila,$columna,$totalModulos,$incrementoFila,$incrementoColumna) {
            $array = array();
            for ($i=0; $i<$totalModulos; $i++)
                array_push($array, array(
                    "numModulo" => ($i+1),
                    "fila" => ($fila+$i*$incrementoFila),
                    "columna" => ($columna+$i*$incrementoColumna),
                    "estado" => "intacto",
                ));
            return $array;
        }

        /**
         * 
         */
        private function asignaModulos($fila,$columna,$totalModulos,$direccion) {
            switch ($direccion) {
                case 0:
                    return $this->creaModulos($fila,$columna,$totalModulos,1,0);
                case 1:
                    return $this->creaModulos($fila,$columna,$totalModulos,0,-1);
                case 2:
                    return $this->creaModulos($fila,$columna,$totalModulos,-1,0);
                case 3:
                    return $this->creaModulos($fila,$columna,$totalModulos,0,1);
            }
        }

        /**
         * 
         */
        public function imprimeInfoBarco() {
            echo "<br/>Tipo de barco: ".$this->_tipo."<br/>";
            for ($i=0; $i<sizeof($this->_modulos); $i++) { 
                echo "Módulo ".$this->_modulos[$i]["numModulo"].": <br/>";
                echo "Fila: ".($this->_modulos[$i]["fila"]+1)." | Columna: ".($this->_modulos[$i]["columna"]+1)."<br/>";
                echo "Estado: ".$this->_modulos[$i]["estado"]."<br/>";
            }
        }
    }

?>