<?php
    include "class/Tablero.php";

    class Jugador {

        /**
         * Atributos:
         * 
         * -tablero (objeto de la clase tablero)
         * -nombre: nombre del jugador
         * -numDisparos: número de disparos que ha realizado el jugador
         */
    
        protected $_tablero;
        protected $_nombre;
        protected $_numDisparos;
        protected $_barcosHundidos;

        public function __construct($nombre) {
            $this->_tablero = new Tablero();
            $this->colocarBarcos();
            $this->_nombre = $nombre;
            $this->_numDisparos = 0;
            $this->_barcosHundidos = array(
                array(
                    "tipo" => "Submarinos",
                    "hundidos" => 0
                ),
                array(
                    "tipo" => "Acorazados",
                    "hundidos" => 0
                ),array(
                    "tipo" => "Destructures",
                    "hundidos" => 0
                ),array(
                    "tipo" => "Portaaviones",
                    "hundidos" => 0
                ));
        }

        /**
         * getTablero: devuelve el tablero (tablero es protected y necesita un método público)
         * colocarBarcos: añade los barcos del jugador en su tablero
         * disparar: dispara a las coordenadas pasadas por parámetro del tablero del jugador enemigo
         */

        /**
         * 
         */
        private function longitudBarco($i) {
            switch ($i) {
                case 1:
                    return 4;
                case 2:
                case 3:
                    return 3;
                case 4:
                case 5:
                case 6:
                    return 2;
                case 7:
                case 8:
                case 9:
                case 10:
                    return 1;
            }
        }

        /**
         * Añade 10 barcos en el tablero del jugador:
         * 
         * -De longitud 4    x1
         * -De longitud 3    x2
         * -De longitud 2    x3
         * -De longitud 1    x4
         */
        private function colocarBarcos() {
            for ($i=1; $i<11; $i++) {               //Añadimos los barcos en posiciones válidas
                do {
                    $fila = rand(0,9);
                    $columna = rand(0,9);
        
                    $sentido = rand(0,3);
                    
                    try {
                        $this->_tablero->addBarco($fila,$columna,longitudBarco($i),$sentido);
                        $ubicarBarco = false;
                    } catch (Exception $e) {
                        $ubicarBarco = true;
                    }
                } while ($ubicarBarco);
            }
        }

        /**
         * Devuelve el nombre del jugador.
         * 
         * @return {String} Nombre del jugador.
         */
        public function getNombre() {
            return $this->_nombre;
        }

        /**
         * Devuelve el objeto tablero del jugador
         * 
         * @return {Object} Tablero
         */
        public function getTablero() {
            return $this->_tablero;
        }

        /**
         * Devuelve un booleano informando si el juegador ha sido derrotado
         * 
         * @return {Boolean} True si el juegador ha perdido, false si no.
         */
        public function getDerrotado() {
            return sizeof($this->getTablero()->getListaBarcos())==0;
        }

        /**
         * Devuelve el números de disparos realizados por el jugador.
         * 
         * @return {int} Total de disparos realizados por el jugador.
         */
        public function getDisparos() {
            return $this->_numDisparos;
        }

        /**
         * Incrementa el total de barcos hundidos en función del tipo de barco que se le pase como parámetro
         * 
         * @param {$tipoBarco}  El tipo de barco que se deseaincrementar
         */
        public function incrementaBarcosHundidos($tipoBarco) {
            $this->_barcosHundidos[$tipoBarco-1]["hundidos"]++;
        }

        /**
         * Imprime la lista de barcos hundidos por el jugador.
         */
        public function imprimeBarcosHundidos() {
            echo "<table>";
            for ($i=0; $i<sizeof($this->_barcosHundidos); $i++) 
                echo "<tr><td>".$this->_barcosHundidos[$i]["tipo"]."</td><td>x".$this->_barcosHundidos[$i]["hundidos"]."</td></tr>";
            echo "</table>";
        }

        public function disparar($fila,$columna,$tableroEnemigo) {   //Este método pasará a clase Jugador y debe ser limpiado
            if ($this->_tablero->getValorTableroJuego($fila,$columna)!=0) return;
            if (!$tableroEnemigo->getValorTablero($fila,$columna)==0) {     //!$this->_tablero[$fila][$columna]==0
                for ($i=0; $i<sizeof($tableroEnemigo->getListaBarcos()); $i++) { 
                    if ($tableroEnemigo->getListaBarcos()[$i]->comprobarImpacto($fila,$columna)) {    //comprobar cuál es el barco impactado
                        $tableroEnemigo->getListaBarcos()[$i]->destruirModulo($fila,$columna);
                        if ($tableroEnemigo->getListaBarcos()[$i]->getHundido()) {                    //determinar si el barco se ha hundido
                            $_SESSION['mensajesJ1'] = $tableroEnemigo->getListaBarcos()[$i]->getMensajeHundido();
                            $this->incrementaBarcosHundidos($tableroEnemigo->getListaBarcos()[$i]->getTipo());
                            $tableroEnemigo->setHundirBarco($i);
                        } 
                        else 
                            $_SESSION['mensajesJ1'] = "";
                        break;
                    }
                }
                $this->getTablero()->setValorTableroJuego($fila,$columna,1);
                $tableroEnemigo->setValorTablero($fila,$columna,1);
            }
            else {
                $this->getTablero()->setValorTableroJuego($fila,$columna,4);
                $tableroEnemigo->setValorTablero($fila,$columna,4);
                $_SESSION['mensajesJ1'] = "";
            }
            $this->_numDisparos++;
        }
    }
?>