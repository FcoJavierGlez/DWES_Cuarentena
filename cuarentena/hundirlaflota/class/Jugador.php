<?php
    include "class/Tablero.php";

    class Jugador {
    
        protected $_tablero;            //Objeto de la clase tablero
        protected $_nombre;             //Nombre del jugador/a
        protected $_numDisparos;        //Total de disparods hechos por el jugador
        protected $_barcosHundidos;     //Array con la lista de barcos hundidos al enemigo

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
         * Devuelve la longitud del barco a crear según el número de barcos que se hayan creado
         * 
         * @param {$i}  Número de barcos creados
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
         * Incrementa el numDisparos del jugador
         */
        /* public function incrementaDisparos() {      //MÉTODO TEMPORAL PARA PRUEBAS
            $this->_numDisparos++;
        } */

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

        /**
         * Devuelve el número del índice del array donde está almacenado el barco enemigo impactado
         * 
         * @param {$fila}               Fila donde se ha producido el impacto
         * @param {$columna}            Columna donde se ha producido el impacto
         * @param {$tableroEnemigo}     Objeto tablero del jugador contrario
         * 
         * @return {int}                Índice donde está almacenado el barco
         */
        /* protected function getIndexBarcoImpactado($fila,$columna,$tableroEnemigo) {
            for ($i=0; $i<sizeof($tableroEnemigo->getListaBarcos()); $i++) 
                if ($tableroEnemigo->getListaBarcos()[$i]->comprobarImpacto($fila,$columna)) 
                    return $i;
            return -1;
        } */

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