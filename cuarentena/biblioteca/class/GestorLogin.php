<?php
    

    abstract class GestorLogin {

        private static $_USUARIO = "root";
        private static $_CONTRASENNA = "";
        private static $_db;

        /**
         * Conecta con la BD
         */
        private static function conectaDB(){
            try{
                $db = new PDO('mysql:host=localhost;dbname=autentificacion;charset=utf8',SELF::$_USUARIO,SELF::$_CONTRASENNA);
                $db -> setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY,true);
    
                return ($db);
            }
            catch(PDOException $e){
                echo "Error";
                exit();
            }
        }

        /**
         * Devuelve el perfil de la persona que se está logeando.
         * 
         * @param {$user}   Nombre de usuario que trata de logearse
         * @param {$pass}   Contraseña del usuario que trata de logearse
         * 
         * @return {String} Nombre de perfil en función de la validación de login (administrador | usuario | invitado)
         */
        public static function getPerfil($user,$pass) {
            $user = limpiarDatos($user);
            $pass = limpiarDatos($pass);
            if (SELF::validarLogin($user,$pass,"admins")) return "administrador";
            elseif (SELF::validarLogin($user,$pass,"users")) return "usuario";
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
        private function validarLogin($user,$pass,$nombreTabla) {
            SELF::$_db = SELF::conectaDB();       //Conectamos a la BD

            $consulta = SELF::$_db->prepare("SELECT user, pass FROM $nombreTabla WHERE user = :user");    //Preparamos la consulta
            $consulta->execute(array(":user" => $user));                                            //La ejecutamos pasándole los parámetros

            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC -> array asociativo | PDO::FETCH_NUM -> array indexado

            SELF::$_db = null;                    //Cerramos la conexión

            if (sizeof($resultado) == 0) return false;
            elseif ($resultado[0]['pass'] == $pass) return true;
            return false;
        }
    }
?>