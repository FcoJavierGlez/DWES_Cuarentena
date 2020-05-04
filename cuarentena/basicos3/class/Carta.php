<?php
    class Carta {

        private $_destinatarios = array();
        private $_lineasCarta = array();
        private $_enlacesDescarga = array();

        public function __construct() {
            
        }

        /**
         * Devuelve en forma de array el conjunto de enlaces de las cartas generadas
         */
        public function getEnlaces() {
            return $this->_enlacesDescarga;
        }

        /**
         * Imprime los enlaces de descarga para cada carta.
         */
        public function imprimeEnlaces() {
            for ($i=0; $i < sizeof($this->_enlacesDescarga); $i++) 
                echo "<a href=".$this->_enlacesDescarga[$i]." download>".$this->_destinatarios[$i][0].", ".$this->_destinatarios[$i][1]."</a><br/>";
        }

        /**
         * Importa los destinarios desde un fichero de origen pasado por parámetro.
         * 
         * El fichero de origen deberá separar cada destinatario en una única línea y
         * cada campo deberá estar separado del inmediatamente posterior con una tubería,
         * es decir, deberá tener el siguiente formato: 
         * 
         *                  apellidos|nombre|dirección
         * 
         * Los campos soportan letras mayúsculas, tildes y espacios en blanco
         */
        private function importarDestinatarios(/* $ruta */) {
            $file = fopen("./files/input/destinatarios.txt", "r") or exit("No se ha encontrado el fichero");
            //$file = fopen($ruta, "r") or exit("No se ha encontrado el fichero");

            $this->_destinatarios = array();                //Eliminamos posibles destinatarios importados anteriormente
            
            while (($line = fgets($file)) !== false) 
                array_push( $this->_destinatarios, explode( "|",str_replace( "\n", "", $line ) ) );
            
            fclose($file);
        }

        /**
         * 
         */
        private function importarCarta(/* $ruta */) {
            $file = fopen("./files/input/carta_default.txt", "r") or exit("No se ha encontrado el fichero");
            //$file = fopen($ruta, "r") or exit("No se ha encontrado el fichero");

            $this->_lineasCarta = array();                  //Eliminamos posibles líneas de una carta importada anteriormente
            
            while (($line = fgets($file)) !== false) 
                array_push( $this->_lineasCarta, str_replace( "\n", "", $line ) );
            
            fclose($file);
        }

        /**
         * 
         */
        private function crearCarta($destinatario) {
            $ruta = "./files/cartas/".str_replace(" ","_",$destinatario[0]).",".str_replace(" ","_",$destinatario[1]).".txt";
            $file = fopen($ruta, "w") or exit("No se ha encontrado el fichero");
            //$file = fopen($ruta, "r") or exit("No se ha encontrado el fichero");
            
            //Generamos carta
            for ($i=0; $i < sizeof($this->_lineasCarta); $i++) { 
                $cadena = str_replace("{apellidos}",$destinatario[0],$this->_lineasCarta[$i]);
                $cadena = str_replace("{nombre}",$destinatario[1],$cadena);
                $cadena = str_replace("{direccion}",$destinatario[2],$cadena);
                fwrite($file,$cadena);
            }

            //Guardamos enlace
            array_push($this->_enlacesDescarga,$ruta);
            
            fclose($file);
        }

        /**
         * Genera cartas a partir de un fichero con usuarios y 
         * la estructura de una carta generada por defecto.
         */
        public function generarCartas(/* $rutaDest,$rutaCarta */) {
            $this->importarDestinatarios(/* $rutaDest */);
            $this->importarCarta(/* $rutaDest */);
            $this->_enlacesDescarga = array();          //Eliminamos posibles enlaces de una carta anterior
            for ($i=0; $i<sizeof($this->_destinatarios); $i++) 
                $this->crearCarta($this->_destinatarios[$i]);
        }

    }
?>