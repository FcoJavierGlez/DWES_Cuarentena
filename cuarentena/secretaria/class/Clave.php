<?php

    class Clave extends DBAbstractModel {

        private static $_instancia;
        private $_codGenNewKey          = "";
        private $_timeCreationCodGenKey = NULL;

        private $_coordClave = array();

        public function __construct() {

        }
        
        public static function singleton() {
            if (!isset(self::$_instancia)) {
                $miClase = __CLASS__;
                self::$_instancia = new $miClase;
            }
            return self::$_instancia;
        }

        public function __clone() {
            trigger_error('La clonación no es permitida.', E_USER_ERROR);
        }

        private function setKeyRowColumn( $id_user,$fila,$columna,$valor ) {
            $this->query = "INSERT INTO sevi_clavefirma (idUsuario,fila,columna,valor) 
                            VALUES (:idUsuario,:fila,:columna,:valor)";
            
            $this->parametros['idUsuario']  = $id_user;
            $this->parametros['fila']       = $fila;
            $this->parametros['columna']    = $columna;
            $this->parametros['valor']      = $valor;
            
            $this->get_results_from_query();
        }

        public function getKeyRowColumn( $id_user, $fila, $columna ) {
            $this->query = "SELECT valor FROM sevi_clavefirma 
                            WHERE idUsuario = :idUsuario 
                            AND fila = :fila AND columna = :columna";
            
            $this->parametros['idUsuario']  = $id_user;
            $this->parametros['fila']       = $fila;
            $this->parametros['columna']    = $columna;
            
            $this->get_results_from_query();
            $this->close_connection();

            return $this->rows[0]['valor'];
        }

        public function validarFirma( $idUser, $inputs ) {
            for ($i=0; $i < 8; $i++) { 
                for ($j=0; $j < 8; $j++) { 
                    if ( isset($inputs[$i][$j]) ) {
                        if ( $inputs[$i][$j] !== $this->getKeyRowColumn( $idUser, getLetterFromRow( $i ), $j+1) )
                            return false;
                    }
                }
            }
            return true;
        }

        /**
         * Borra las claves del usuario especificado
         * 
         * @param {$id_usuario} ID del usuario del que se desean eliminar las claves
         */
        public function borrarClaves( $id_usuario ) {
            $this->query = "DELETE FROM sevi_clavefirma WHERE idUsuario = :idUsuario";
            
            $this->parametros['idUsuario']  = $id_usuario;
            
            $this->get_results_from_query();
        }

        /**
         * Genera las coordenadas con las claves del usuario, 
         * las inserta en la base de datos del usuario y genera
         * un fichero que mandará por correo al usuario.
         * 
         * @param {$id_usuario}         ID del usuario del que se desea generar las claves
         * @param {$directorio_usuario} Directorio del usuario del que se desea generar las claves
         * 
         */
        public function crearClaves( $id_usuario, $directorio_usuario ) {
            $this->generarCoordClaves();
            $this->generarFicheroClaves( $directorio_usuario );
            $this->insertarClaveUser( $id_usuario );
        }

        /**
         * Genera 64 números aleatorios en un array bidimensional
         */
        private function generarCoordClaves() {
            for ($i=0; $i < 8; $i++) { 
                array_push( $this->_coordClave, array() );
                for ($j=0; $j < 8; $j++) 
                    array_push( $this->_coordClave[$i], rand(0,999) );
            }
        }

        /**
         * Devuelve la columna con la letra correspondiente a la fila actual
         */
        private function getColumnaLetra( $fila ) {
            switch ($fila) {
                case 0:
                    return " A |";
                case 1:
                    return " B |";
                case 2:
                    return " C |";
                case 3:
                    return " D |";
                case 4:
                    return " E |";
                case 5:
                    return " F |";
                case 6:
                    return " G |";
                case 7:
                    return " H |";
                default:
                    return " X |";
            }
        }

        /**
         * Genera el fichero con las coordenadas y las claves que recibirá el usuario.
         */
        private function generarFicheroClaves( $ruta ) {
            $file = fopen( $ruta."clave.txt", "w") or exit("Unable to open file!");
        
            for ($i = 0; $i < 8; $i++) { 
                if ( $i == 0 ) 
                    fwrite($file, "   | 1 | 2 | 3 | 4 | 5 | 6 | 7 | 8 |\n");
                for ($j = 0; $j < 8; $j++) { 
                    if ( $j == 0 ) {
                        $cadena = $this->getColumnaLetra( $i );
                        $cadena .= sprintf( "%3d|",  $this->_coordClave[$i][$j] );
                    } else
                        $cadena .= sprintf( "%3d|",  $this->_coordClave[$i][$j] );
                }
                fwrite($file, $cadena.( $i == 7 ? "" : "\n"));
            }
            fclose($file);
        }

        /**
         * Genera el fichero con las coordenadas y las claves que recibirá el usuario.
         */
        private function insertarClaveUser( $id_user ) {
            for ($i = 0; $i < 8; $i++) 
                for ($j = 0; $j < 8; $j++) 
                    $this->setKeyRowColumn( $id_user, $i+1, $j+1, $this->_coordClave[$i][$j] );
            
            $this->close_connection();
        }

        /**
         * 
         */
        private function getCharacterByValue( $i ) {
            switch ( $i ) {
                case 10:
                    return "a";
                case 11:
                    return "b";
                case 12:
                    return "c";
                case 13:
                    return "d";
                case 14:
                    return "e";
                case 15:
                    return "f";
                default:
                    return $i;
            }
        }

        /**
         * 
         */
        private function setCodGenNewKey( $codigo ) {
            $this->_codGenNewKey = $codigo;
        }

        /**
         * 
         */
        public function createCodGenNewKey() {
            $codigo = "";
            for ($i = 0; $i < 7; $i++) 
                $codigo .= $this->getCharacterByValue( rand(0,15) );
            $this->setCodGenNewKey( $codigo );
            $this->_timeCreationCodGenKey = new DateTime(date("H:i:s"));
        }

        /**
         * 
         */
        public function validateCodGenNewKey( $codigo ) {
            if ( $this->_timeCreationCodGenKey->diff( new DateTime( date("H:i:s") ) )->format('%i') >= 5 ) {    //Límite 5 min
                $this->resetCodGenNewKey();
                throw new TimeLimitException();
            }
            if ( $this->_codGenNewKey == strtolower( $codigo ) ) {  //En caso de ser válido
                $this->resetCodGenNewKey();
                return true;
            }
            return false;
        }

        /**
         * 
         */
        private function resetCodGenNewKey() {
            $this->_codGenNewKey = "";
        }

        /**
         * 
         */
        public function getCodGenNewKey() {
            return $this->_codGenNewKey;
        }

    }

?>