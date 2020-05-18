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
                } else {
                    $this->query = "SELECT * FROM bi_users WHERE lower( user ) = :user";
                    $this->parametros['user'] = strtolower( $busqueda );
                }
            }
            else
                $this->query = "SELECT * FROM bi_users";
            
            $this->get_results_from_query();
            $this->close_connection();

            return $this->rows;
        }

        public function set ( $user_data = array() ) {
            $this->query = "INSERT INTO bi_users (user,pass,estatus,nombre,apellidos,telefono,email,img) 
                                VALUES (:user,:pass,:estatus,:nombre,:apellidos,:telefono,:email,:img)";
            $this->parametros['user'] = $user_data['user'];
            $this->parametros['pass'] = $user_data['pass'];
            $this->parametros['estatus'] = $user_data['estatus'];
            $this->parametros['nombre'] = $user_data['nombre'];
            $this->parametros['apellidos'] = $user_data['apellidos'];
            $this->parametros['telefono'] = $user_data['telefono'];
            $this->parametros['email'] = $user_data['email'];
            $this->parametros['img'] = $user_data['img'];
            $this->get_results_from_query();
            $this->close_connection();
        }

    }

?>