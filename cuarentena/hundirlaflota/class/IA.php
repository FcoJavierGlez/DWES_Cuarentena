<?php
    class IA extends Jugador {

        /**
         * Lista de Atributos de la IA:
         * 
         * coordPrimerImpacto: Almacena las coordenadas del primer impacto a un barco
         * puntero: Posición que señala el último disparo realizado en la fase de barco detectado
         * faseHundir[0], faseHundir[1], faseHundir[2]: booleanos que marcan en qué fase se encuentra la IA para hundir un barco (una vez detectado)
         * 
         */

        private $_faseHundir = array(false,false,false);
        private $_direccionValida = array(true,true,true,true);
        private $_direccionDiparo = 0;
        private $_coordImpacto = array(0,0);    //Coordenadas del primer impacto a un barco ($_coordImpacto[0]=fila,$_coordImpacto[1]=columna)
        private $_coordPuntero = array(0,0);    //Coordenadas del puntero que se actualiza disparo tras disparo
        private $_heDisparado = false;          //Indica si la IA ha disparado en su turno.
        
        public function __construc() {
            parent::__construct();
        }

        /**
         * Determina si está activo el sistema de hundimiento de barco (este sistema se activa tras impactar en un barco)
         * 
         * @return {Boolean}    True si el sistema estáa ctivo, false si no lo está
         */
        private function activoSistemaHundir() {
            for ($i=0; $i<sizeof($this->_faseHundir); $i++) 
                if ($this->_faseHundir[$i]) return true;
            return false;
        }

        /**
         * Resetea el sistema de hundimiento de barco
         */
        private function resetearSistemaHundir() {
            for ($i=0; $i<sizeof($this->_faseHundir); $i++) 
                $this->_faseHundir[$i] = false;
            for ($i=0; $i<sizeof($this->_direccionValida); $i++) 
                $this->_direccionValida[$i] = true;
        }

        /**
         * Añade el valor pasado por parámetro al tablero de la IA para las coordendas indicadas y
         * resta en 1 el valor de las coordenadas que haya alrededor salvo si éstas valen 0 ó -1.
         * 
         * @param {$fila}      Fila donde se ha producido el impacto
         * @param {$columna}   Columna donde se ha producido el impacto
         * @param {$valor}     Valor a insertar en la coordenada del impacto (0 si es agua, -1 si es barco)
         */
        private function impacto($fila,$columna,$valor) {
            for ($i=max($fila-1,0); $i<=min($fila+1,9); $i++) { 
                for ($j=max($columna-1,0); $j<min($columna+1,9); $j++) { 
                    if ($i == $fila && $j == $columna)
                        $this->getTablero()->setValorTableroIA($i,$j,$valor);
                    elseif (!($this->getTablero()->getValorTableroIA($i,$j) == 0 || $this->getTablero()->getValorTableroIA($i,$j) == -1))
                        $this->getTablero()->setValorTableroIA($i,$j,$this->getTablero()->getValorTableroIA($i,$j)-1);
                }
            }
        }

        /**
         * Añade las coordenadas del impacto al array coordImpacto y coordPuntero,
         * éste método tiene como finalidad guardar las coordenadas del primer 
         * impacto realizado a un barco.
         * 
         * @param {$fila}      Fila donde se ha producido el impacto
         * @param {$columna}   Columna donde se ha producido el impacto
         */
        private function setCoordImpacto($fila,$columna) {
            $this->_coordImpacto[0] = $fila;
            $this->_coordImpacto[1] = $columna;
            $this->_coordPuntero[0] = $fila;
            $this->_coordPuntero[1] = $columna;
        }

        /**
         * Impacta con valor 0 (agua) las casillas alrededor del barco que esté hundido
         * 
         * @param {$fila}           Fila del módulo inicial
         * @param {$columna}        Columna del módulo inicial
         * @param {$tipo}           Longitud del barco
         * @param {$incrementoFil}  El incremento de la fila (si el barco es horizontal valdrá 0) si se escribe
         *                          de abajo a arriba valdrá -1, de arriba a abajo valdrá 1.
         * @param {$incrementoCol}  El incremento de la columna (si el barco es vertical valdrá 0) si se escribe
         *                          de derecha a izquierda valdrá -1, de izquierda a derecha valdrá 1.
         */
        private function rodaConAgua($fila,$columna,$tipo,$incrementoFil,$incrementoCol) {
            $filaFinal = $fila+($tipo-1)*$incrementoFil;
            $columnaFinal = $columna+($tipo-1)*$incrementoCol;

            $inicioFilaArea = ($fila<=$filaFinal) ? max($fila-1,0) : max($filaFinal-1,0);
            $finalFilaArea = ($fila>=$filaFinal) ? min($fila+1,9) : min($filaFinal+1,9);
            
            $inicioColumnaArea = ($columna<=$columnaFinal) ? max($columna-1,0) : max($columnaFinal-1,0);
            $finalColumnaArea = ($columna>=$columnaFinal) ? min($columna+1,9) : min($columnaFinal+1,9);

            for ($i=$inicioFilaArea; $i<$finalFilaArea+1; $i++) 
                for ($j=$inicioColumnaArea; $j<$finalColumnaArea+1; $j++) 
                    if ($this->getTablero()->getValorTableroIA($i,$j)>0) 
                        $this->impacto($i,$j,0);
        }

        /**
         * Este método es llamado tras haber hundido un barco lo rodeamos con agua
         * 
         * @param {$fila}           Fila del módulo inicial
         * @param {$columna}        Columna del módulo inicial
         * @param {$tipo}           Longitud del barco
         * @param {$direccion}      Dirección a la que apunta el barco (0-3)
         */
        private function rodearConAgua($fila,$columna,$tipo,$direccion) {
            switch ($direccion) {
                case 0:
                    return $this->rodaConAgua($fila,$columna,$tipo,1,0);
                case 1:
                    return $this->rodaConAgua($fila,$columna,$tipo,0,-1);
                case 2:
                    return $this->rodaConAgua($fila,$columna,$tipo,-1,0);
                case 3:
                    return $this->rodaConAgua($fila,$columna,$tipo,0,1);
            }
        }

        /**
         * La IA dispara en el tablero enemigo en las coordenadas dadas
         */
        private function dispara($fila,$columna,$tableroEnemigo) {
            if ($tableroEnemigo->getValorTablero($fila,$columna)==0) {          //Si el disparo impacta en agua
                $tableroEnemigo->setValorTablero($fila,$columna,4);
                $this->impacto($fila,$columna,0);
                if ($this->_faseHundir[1]) {                                    //Si estamos en la 2a fase de hundir negamos dirección
                    $this->_direccionValida[$this->_direccionDiparo] = false;
                    $this->desplazaPuntero(4);
                }
                if ($this->_faseHundir[2])                                      //Si estamos en la 3a fase de hundir invertimos disparo
                    $this->invierteDireccionDisparo();
            } else {                                                            //Si el disparo impacta en un barco
                $tableroEnemigo->setValorTablero($fila,$columna,1);
                $this->impacto($fila,$columna,-1);
                $indexBarco = $tableroEnemigo->getIndexBarcoImpactado($fila,$columna);
                $tableroEnemigo->getListaBarcos()[$indexBarco]->destruirModulo($fila,$columna);
                if (!$tableroEnemigo->getListaBarcos()[$indexBarco]->getHundido()) {                //Si el barco no está hundido
                    if (!$this->activoSistemaHundir()) {
                        $this->setCoordImpacto($fila,$columna);
                        $this->_faseHundir[0] = true;
                    } elseif($this->_faseHundir[1]) {           //Si verificamos impacto estando en fase 2 y no se ha hundido el barco activamos la fase 3
                        $this->_faseHundir[1] = false;
                        $this->_faseHundir[2] = true;
                    }
                } else {                                                                            //Si el barco está hundido
                    $_SESSION['mensajesJ1'] .= (($_SESSION['mensajesJ1']=="") ? "" : "<br/>").
                        $this->_nombre." ha hundido nuestro ".$tableroEnemigo->getListaBarcos()[$indexBarco]->getNombreTipo();
                    $this->rodearConAgua(
                        $tableroEnemigo->getListaBarcos()[$indexBarco]->getCoordModInicial()[0],    //Fila del módulo inicial del barco
                        $tableroEnemigo->getListaBarcos()[$indexBarco]->getCoordModInicial()[1],    //Columna del módulo inicial del barco
                        $tableroEnemigo->getListaBarcos()[$indexBarco]->getTipo(),                  //Total módulos (longitud) del barco
                        $tableroEnemigo->getListaBarcos()[$indexBarco]->getDireccion());            //Dirección a la que apunta el barco
                    $tableroEnemigo->setHundirBarco($indexBarco);
                    $this->resetearSistemaHundir();
                }
                
            }
            $this->_numDisparos++;
            $this->_heDisparado = true;
        }

        /**
         * Un disparo a unas coordenadas aleatorias
         */
        private function disparoRandom($tableroEnemigo) {
            do {
                $fila = rand(0,9);
                $columna = rand(0,9);
            } while ($this->getTablero()->getValorTableroIA($fila,$columna)==0 || $this->getTablero()->getValorTableroIA($fila,$columna)==-1);
            $this->dispara($fila,$columna,$tableroEnemigo);
        }

        /**
         * Valida de las 4 direcciones posibles de disparo. Sí encuentra que alguna de las direcciones
         * de disparo para las coordenadas almacenadas no es válida niega esa dirección
         * 
         * @param {$i}          Dirección de disparo a validar.
         * 
         * @return {Boolean}    True si la dirección es válida, false si no lo es.
         */
        private function validarDirecciones($i) {
            switch ($i) {
                case 0:     //arriba (fila -1, columna 0)
                    if (($this->_coordPuntero[0]-1)<0 || $this->getTablero()->getValorTableroIA($this->_coordPuntero[0]-1,$this->_coordPuntero[1])==0)
                        return false;
                    else
                        return true;
                case 1:     //derecha (fila 0, columna +1)
                    if (($this->_coordPuntero[1]+1)>9 || $this->getTablero()->getValorTableroIA($this->_coordPuntero[0],$this->_coordPuntero[1]+1)==0)
                        return false;
                    else
                        return true;
                case 2:     //abajo (fila +1, columna 0)
                    if (($this->_coordPuntero[0]+1)>9 || $this->getTablero()->getValorTableroIA($this->_coordPuntero[0]+1,$this->_coordPuntero[1])==0)
                        return false;
                    else
                        return true;
                default:    //izquierda (fila 0, columna -1)
                    if (($this->_coordPuntero[1]-1)<0 || $this->getTablero()->getValorTableroIA($this->_coordPuntero[0],$this->_coordPuntero[1]-1)==0)
                        return false;
                    else
                        return true;
            }
        }

        /**
         * Desplaza el puntero en la dirección pasada por parámetro
         * 
         * * @param {$direccion}    Dirección en la que se debe desplazar el puntero:
         *                          0: arriba
         *                          1: derecha
         *                          2: abajo
         *                          3: izquierda
         *                          4: origen impacto (devuelve al puntero a las coordenadas donde se originó el primer impacto al barco)
         * 
         */
        private function desplazaPuntero($direccion) {
            switch ($direccion) {
                case 0:
                    $this->_coordPuntero[0]--;
                    break;
                case 1:
                    $this->_coordPuntero[1]++;
                    break;
                case 2:
                    $this->_coordPuntero[0]++;
                    break;
                case 3:
                    $this->_coordPuntero[1]--;
                    break;
                case 4:
                    $this->_coordPuntero[0] = $this->_coordImpacto[0];
                    $this->_coordPuntero[1] = $this->_coordImpacto[1];
                    break;
            }
        }

        /**
         * Invierte la dirección en la que debe seguir disparando la IA hasta hundir el barco detectado y
         * devuelve el puntero de disparo a las coordenadas del primer impacto.
         * 
         * @return {int}    Dirección de disparo invertida.
         */
        private function invierteDireccionDisparo() {
            $this->desplazaPuntero(4);
            switch ($this->_direccionDiparo) {
                case 0:
                    return 2;
                case 1:
                    return 3;
                case 2:
                    return 0;
                default:
                    return 1;
            }
        }

        /**
         * Primera fase del siste de hundimiento (validar direcciones posibles de disparo)
         */
        private function primeraFaseHundir() {
            for ($i=0; $i<sizeof($this->_direccionValida); $i++) 
                $this->_direccionValida[$i] = $this->validarDirecciones($i);
            $this->_faseHundir[0]=false;
            $this->_faseHundir[1]=true;
        }

        /**
         * Segunda fase de hundimiento (descubrir alineamiento del barco -> "horizontal" | "vertical")
         */
        private function segundaFaseHundir($tableroEnemigo) {
            do {
                $this->_direccionDiparo = rand(0,3);
            } while (!$this->_direccionValida[$this->_direccionDiparo]);
            $this->desplazaPuntero($this->_direccionDiparo);
            $this->dispara($this->_coordPuntero[0],$this->_coordPuntero[1],$tableroEnemigo);
        }

        /**
         * Tercera fase de hundimiento (continuar los disparos hasta terminar de hundir el barco en caso de no haberlo hundido antes (3+ módulos))
         */
        private function terceraFaseHundir($tableroEnemigo) {
            if ($this->validarDirecciones($this->_direccionDiparo)) {       //Si la siguiente coordenada de disparo no es válida (sale de tablero o hay agua)
                $this->_direccionDiparo = $this->invierteDireccionDisparo();//Invierte dirección de disparo y devuelve puntero a origen de impacto
                $this->desplazaPuntero($this->_direccionDiparo);            //Desplaza el puntero desde el origen en la nueva dirección
            }
            else
                $this->desplazaPuntero($this->_direccionDiparo);
            $this->dispara($this->_coordPuntero[0],$this->_coordPuntero[1],$tableroEnemigo);
        }

        /**
         * Sistema de hundimiento de barco
         */
        private function hundirBarco($tableroEnemigo) {
            if ($this->_faseHundir[0]) 
                $this->primeraFaseHundir();
            if ($this->_faseHundir[1] && !$this->_heDisparado) 
                $this->segundaFaseHundir($tableroEnemigo);
            elseif ($this->_faseHundir[2] $$ !$this->_heDisparado) 
                $this->terceraFaseHundir($tableroEnemigo);
        }

        /**
         * La IA juega, si ha detectado un barco antes usa el sistema de hundimiento
         * si no hay ningún barco detectado y lleva más de 20 disparos activa el sistema de rastreo, 
         * si no hace un disparo random.
         * 
         * Tras su disparo incrementa en 1 su número de disparos.
         * 
         * @param {Object}  Tablero enemigo.
         */
        public function jugar($tableroEnemigo) {
            $this->_heDisparado = false;
            if ($this->activoSistemaHundir())
                $this->hundirBarco($tableroEnemigo);
            elseif ($this->_numDisparos>20 && !$this->_heDisparado) 
                //instr
            elseif (!$this->_heDisparado)
                $this->disparoRandom($tableroEnemigo);
        }
    }
?>