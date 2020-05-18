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
                    $this->query = "SELECT * FROM bi_users WHERE id = :id";
                    $this->parametros['id'] = $busqueda;
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

        public function set ( $user_data = array() ) {
            $this->query = "INSERT INTO bi_users (user,pass,perfil,estado,nombre,apellidos,dni,telefono,email,img) 
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
            $this->close_connection();
        }

    }

?>