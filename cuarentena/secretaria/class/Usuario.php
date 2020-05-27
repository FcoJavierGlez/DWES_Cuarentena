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

        /* public function getUsers ( $busqueda = '' ) {
            if ( $busqueda !== '' ) {
                if ( is_numeric($busqueda) ) {
                    $this->query = "SELECT * FROM sevi_usuarios WHERE id = :id";
                    $this->parametros['id'] = $busqueda;
                } elseif( $busqueda == '*' ) {
                    $this->query = "SELECT * FROM sevi_usuarios";
                } else {
                    $this->query = "SELECT * FROM sevi_usuarios WHERE lower( nick ) = :nick";
                    $this->parametros['nick'] = strtolower( $busqueda );
                }
            }
            else {
                $this->query = "SELECT * FROM sevi_usuarios WHERE perfil = :perfil";
                $this->parametros['perfil'] = "user";
            }
            
            $this->get_results_from_query();
            $this->close_connection();

            return $this->rows;
        } */

        public function getUserByNick ( $busqueda = '' ) {
            if ( $busqueda !== '' ) {
                $this->query = "SELECT * FROM sevi_usuarios WHERE lower( nick ) = :nick";
                $this->parametros['nick'] = strtolower( $busqueda );

                $this->get_results_from_query();
                $this->close_connection();
            }

            return $this->rows;
        }

        public function getUserByEmail ( $email = '' ) {
            $this->query = "SELECT * FROM sevi_usuarios WHERE email = :email";

            $this->parametros['email'] = $email;
            
            $this->get_results_from_query();
            $this->close_connection();

            return $this->rows;
        }

        public function setUser ( $user_data = array() ) {
            if ( sizeof( $this->getUserByNick( $user_data['nick'] ) ) )      //Si existe ese nick invalidamos el registro
                throw new UserExistException();
            /* elseif ( sizeof( $this->getUserByEmail( strtoupper( $user_data['dni'] ) ) ) )
                throw new DniExistException(); // VERIFICAR EMAIL */
            elseif ( $user_data['pass'] !== $user_data['pass2'])
                throw new PassCheckException();
            else {
                $this->query = "INSERT INTO sevi_usuarios (nick,pass,perfil,estado,nombre,apellidos,email) 
                                VALUES (:nick,:pass,:perfil,:estado,:nombre,:apellidos,:email)";

                $this->parametros['nick'] = $user_data['nick'];
                $this->parametros['pass'] = $user_data['pass'];
                $this->parametros['perfil'] = "user";
                $this->parametros['estado'] = "pendiente";
                $this->parametros['nombre'] = $user_data['nombre'];
                $this->parametros['apellidos'] = $user_data['apellidos'];
                $this->parametros['email'] = $user_data['email'];
                //$this->parametros['dni'] = strtoupper( preg_replace('/(-|\s)/',"",$user_data['dni']) );
                //$this->parametros['telefono'] = $user_data['telefono'];
                //$this->parametros['img'] = $user_data['img'];

                $this->get_results_from_query();
                $this->close_connection();
            }
        }

        /* public function editPass ( $user_data = array() ) {
            if ( $this->getUsers( $user_data['id_user'] )[0]['pass'] !== $user_data['old_pass'] )      //Si la contraseña vieja no coincide con la alamacenada
                throw new CheckOldPassException();
            elseif ( $user_data['new_pass'] !== $user_data['new_pass2'])
                throw new PassCheckException();
            else {
                $this->query = "UPDATE bi_users SET pass = :pass WHERE id_user = :id";

                $this->parametros['id'] = $user_data['id_user'];
                $this->parametros['pass'] = $user_data['new_pass'];

                $this->get_results_from_query();
                $this->close_connection();
            }
        } */

        /* public function editUser ( $user_data = array() ) {
            if ( !$this->validaDni($user_data['dni']) )
                throw new DniInvalidException();
            elseif ( $this->get($user_data['id_user'])[0]['dni'] !== strtoupper( preg_replace('/(-|\s)/',"",$user_data['dni']) ) &&
                        sizeof( $this->getUserByEmail( strtoupper( preg_replace('/(-|\s)/',"",$user_data['dni']) ) ) ) )
                throw new DniExistException();
            else {
                if ( $user_data['img'] == '' )
                    $this->query = "UPDATE bi_users SET nombre = :nombre, apellidos = :apellidos, dni = :dni,
                                            telefono = :telefono, email = :email WHERE id_user = :id_user";
                else
                    $this->query = "UPDATE bi_users SET nombre = :nombre, apellidos = :apellidos, dni = :dni,
                                            telefono = :telefono, email = :email, img = :img WHERE id_user = :id_user";

                $this->parametros['id_user'] = $user_data['id_user'];
                $this->parametros['nombre'] = $user_data['nombre'];
                $this->parametros['apellidos'] = $user_data['apellidos'];
                $this->parametros['dni'] = strtoupper( preg_replace('/(-|\s)/',"",$user_data['dni']) );
                $this->parametros['telefono'] = $user_data['telefono'];
                $this->parametros['email'] = $user_data['email'];
                $this->parametros['img'] = $user_data['img'];

                $this->get_results_from_query();
                $this->close_connection();
            }
        } */

        public function editEstado ( $user_data = array() ) {
            $this->query = "UPDATE sevi_usuarios SET estado = :estado WHERE id = :id";
            $this->parametros['estado'] = $user_data['estado'];
            $this->parametros['id'] = $user_data['id'];
            $this->get_results_from_query();
            $this->close_connection();
        }

        private function validaDni( $dni ) {
            return preg_match_all('/^\d{8}(-|\s)?\w$/i',$dni);
        }

    }

?>