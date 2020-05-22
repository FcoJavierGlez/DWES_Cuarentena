<?php

    class Usuario extends DBAbstractModel {

        private static $instancia;

        public function __construct() {

        }
        
        public static function singleton() {
            if (!isset(self::$instancia)) {
                $miClase = __CLASS__;
                self::$instancia = new $miClase;
            }
            return self::$instancia;
        }

        public function __clone() {
            trigger_error('La clonación no es permitida.', E_USER_ERROR);
        }

        public function prueba() {
            echo "Hola";
        }

        public function get ( $busqueda = '' ) {
            if ( $busqueda !== '' ) {
                if ( is_numeric($busqueda) ) {
                    $this->query = "SELECT * FROM bi_users WHERE id_user = :id_user";
                    $this->parametros['id_user'] = $busqueda;
                } elseif( $busqueda == '*' ) {
                    $this->query = "SELECT * FROM bi_users";
                } else {
                    $this->query = "SELECT * FROM bi_users WHERE lower( user ) = :user";
                    $this->parametros['user'] = strtolower( $busqueda );
                }
            }
            else {
                $this->query = "SELECT * FROM bi_users WHERE perfil = :perfil";
                $this->parametros['perfil'] = "lector";
            }
            
            $this->get_results_from_query();
            $this->close_connection();

            return $this->rows;
        }

        public function getDNI ( $dni = '' ) {
            $this->query = "SELECT * FROM bi_users WHERE dni = :dni";

            $this->parametros['dni'] = $dni;
            
            $this->get_results_from_query();
            $this->close_connection();

            return $this->rows;
        }

        public function set ( $user_data = array() ) {
            if ( sizeof( $this->get( $user_data['user'] ) ) )      //Si existe ese nick invalidamos el registro
                throw new UserExistException();
            elseif ( !$this->validaDni($user_data['dni']) )
                throw new DniInvalidException();
            elseif ( sizeof( $this->getDNI( strtoupper( preg_replace('/(-|\s)/',"",$user_data['dni']) ) ) ) == 1 )
                throw new DniExistException();
            else {
                $this->query = "INSERT INTO bi_users (user,pass,perfil,estado,nombre,apellidos,dni,telefono,email,img) 
                                VALUES (:user,:pass,:perfil,:estado,:nombre,:apellidos,:dni,:telefono,:email,:img)";

                $this->parametros['user'] = $user_data['user'];
                $this->parametros['pass'] = $user_data['pass'];
                $this->parametros['perfil'] = $user_data['perfil'];
                $this->parametros['estado'] = $user_data['estado'];
                $this->parametros['nombre'] = $user_data['nombre'];
                $this->parametros['apellidos'] = $user_data['apellidos'];
                $this->parametros['dni'] = strtoupper( preg_replace('/(-|\s)/',"",$user_data['dni']) );
                $this->parametros['telefono'] = $user_data['telefono'];
                $this->parametros['email'] = $user_data['email'];
                $this->parametros['img'] = $user_data['img'];

                $this->get_results_from_query();
                $this->close_connection();
            }
        }

        public function edit ( $user_data = array() ) {
            /* $this->query = "INSERT INTO bi_users (user,pass,perfil,estado,nombre,apellidos,dni,telefono,email,img) 
                                VALUES (:user,:pass,:perfil,:estado,:nombre,:apellidos,:dni,:telefono,:email,:img)";
            $this->parametros['user'] = $user_data['user'];
            $this->parametros['pass'] = $user_data['pass'];
            $this->parametros['perfil'] = $user_data['perfil'];
            $this->parametros['estado'] = $user_data['estado'];
            $this->parametros['nombre'] = $user_data['nombre'];
            $this->parametros['apellidos'] = $user_data['apellidos'];
            $this->parametros['dni'] = $user_data['dni'];
            $this->parametros['telefono'] = $user_data['telefono'];
            $this->parametros['email'] = $user_data['email'];
            $this->parametros['img'] = $user_data['img'];
            $this->get_results_from_query();
            $this->close_connection(); */
        }

        public function editEstado ( $user_data = array() ) {
            $this->query = "UPDATE bi_users SET estado = :estado WHERE id_user = :id_user";
            $this->parametros['estado'] = $user_data['estado'];
            $this->parametros['id_user'] = $user_data['id_user'];
            $this->get_results_from_query();
            $this->close_connection();
        }

        private function validaDni( $dni ) {
            return preg_match_all('/^\d{8}(-|\s)?\w$/i',$dni);
        }

    }

?>