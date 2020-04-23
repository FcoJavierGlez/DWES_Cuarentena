<?php
    include "resource/funciones.php";

    class Gestor {

        private $_users = array();

        public function __construct() {

        }

        /**
         * Comprueba si el usuario que se está logeando está dentro del sistema (admin | user)
         * 
         * @param {$cadena}                 Cadena formada por el nombre de usuario y la contraseña "user,pass"
         * @param {$cadenombreFicherona}    Nombre del fichero en el que se desea buscar a la persona que se está logeando
         * 
         * @return {Boolean}                True si el usuario que logea se haya en el sistema, false si no
         */
        private function validarLogin($cadena,$nombreFichero) {
            $file = fopen("db/".$nombreFichero.".txt", "r") or exit("No se ha encontrado el fichero");
            $i = 0;
            
            while (($line = fgets($file)) !== false) {
                if ($i>3) 
                    if ($cadena == $line) {
                        fclose($file);
                        return true;
                    }
                $i++;
            }
            fclose($file);
            return false;
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
            $cadena = limpiarDatos($user).",".limpiarDatos($pass);
            if ($this->validarLogin($cadena,"admins")) return "administrador";
            elseif ($this->validarLogin($cadena,"users")) return "usuario";
            else return "invitado";
        }

        /**
         * Guarda en el array de usuarios el conjunto de usuarios almacenados en el fichero users
         */
        public function getUsers() {
            $file = fopen("db/users.txt", "r") or exit("No se ha encontrado el fichero");
            $i = 0;
            
            while (($line = fgets($file)) !== false) {
                if ($i>3 && $line!=="") 
                    array_push($this->_users,str_replace("\n", "", $line));
                $i++;
            }
            fclose($file);
        }

        /**
         * Guarda en el fichero users.txt la lista de usuarios y sus contraseñas
         */
        public function setUsers() {
            $file = fopen("db/users.txt", "w") or exit("No se ha encontrado el fichero");
            $cabecera = array(
                "----------------------------------------"."\n",
                "                USUARIOS                "."\n",
                "----------------------------------------"."\n",
                "\n");

            for ($i=0; $i<sizeof($this->_users)+4; $i++) { 
                if ($i>3) 
                    fwrite($file, ($this->_users[$i-4].(($i==sizeof($this->_users)+3) ? "" : "\n"))); //Si es el último usuario no se añade \n
                else
                    fwrite($file, $cabecera[$i]);
            }
            fclose($file);
        }

        /**
         * Añade un nuevo usuario y su password al array de usuarios.
         * 
         * @param {$user}   Nombre de usuario a añadir
         * @param {$pass}   Contraseña del usuario a añadir
         */
        public function addUser($user,$pass) {
            array_push($this->_users,limpiarDatos($user).",".limpiarDatos($pass));
        }

        /**
         * Imprime los datos contenidos en el fichero que se indique por parámetro (users | admins)
         * 
         * @param {$nombre} Nombre del fichero (sin extensión) del que se quiere imprimir su contenido
         */
        function imprimeDatos($nombre) {
            $file = fopen("db/".$nombre.".txt", "r") or exit("No se ha encontrado el fichero");
            $i = 0;
            
            while (($line = fgets($file)) !== false) {
                if ($i>3) 
                    echo $line."<br/>";
                $i++;
            }
            fclose($file);
        }
    }
?>