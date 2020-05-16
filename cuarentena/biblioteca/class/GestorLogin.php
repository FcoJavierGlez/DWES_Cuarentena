<?php

    class GestorLogin extends DBAbstractModel {

        private static $_instancia;
        private $_user;
        private $_pass;
        private $_tabla;

        public function __construct() {

        }

        public static function singleton() {
            if (!isset(self::$_instancia)) {
                $miClase = __CLASS__;
                self::$_instancia = new $miClase;
            }
            return self::$_instancia;
        }

        protected function get( $user_data = array(), $nombreTabla='' ) {
            $this->query = "
                    SELECT id, user, pass
                    FROM $nombreTabla
                    WHERE user = :user";
            $this->parametros['user'] = $user_data['user'];	
            $this->get_results_from_query();
            
            $this->close_connection();
        }

        /**
         * Devuelve el perfil de la persona que se está logeando.
         * 
         * @param {$user}   Nombre de usuario que trata de logearse
         * @param {$pass}   Contraseña del usuario que trata de logearse
         * 
         * @return {String} Nombre de perfil en función de la validación de login (administrador | usuario | invitado)
         */
        public function getPerfil($user,$pass) {
            $this->_user = limpiarDatos($user);
            $this->_pass = limpiarDatos($pass);
            if ( $this->validarLogin( array('user'=>$this->_user, 'pass'=>$this->_pass ),"bi_admins") ) return "administrador";
            elseif ( $this->validarLogin( array('user'=>$this->_user, 'pass'=>$this->_pass ),"bi_users") ) return "usuario";
            else return "invitado";
        }

        /**
         * Comprueba si el usuario que se está logeando está dentro del sistema (admin | user)
         * 
         * @param {$user}                   Nombre de usuario que trata de logearse
         * @param {$pass}                   Contraseña del usuario que trata de logearse
         * @param {$nombreTabla}            Nombre de la tabla que debe consultarse
         * 
         * @return {Boolean}                True si el usuario que logea se haya en el sistema, false si no
         */
        private function validarLogin( $user_data=array(), $nombreTabla ) {
            $this->get( $user_data, $nombreTabla );

            if ( sizeof($this->rows) == 0 ) return false;
            elseif ($this->rows[0]['pass'] == $this->_pass) return true;
            return false;
        }
    }
?>