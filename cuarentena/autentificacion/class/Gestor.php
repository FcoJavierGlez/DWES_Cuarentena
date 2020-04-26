<?php
    include "resource/funciones.php";

    class Gestor {

        private $_users = array();
        private $_numAdds = 0;

        public function __construct() {

        }

        /**
         * Guarda en el array de usuarios el conjunto de usuarios almacenados en el fichero users
         */
        public function importUsers() {
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
        public function exportUsers() {
            if ($this->_numAdds==0) return;     //Si el contador de usuarios añadidos es cero no es necesario exportar al fichero
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
         * Devuelve el total de usuarios almacenados en el array de users.
         * 
         * @return {Array}  Total de usuarios almacenados
         */
        public function getUsers() {
            return $this->_users;
        }

        /**
         * Comprueba si el usuario ha sido añadido con anterioridad
         */
        private function checkUserExist($user) {
            for ($i=0; $i<sizeof($this->_users); $i++) 
                if($user==explode(",",$this->_users[$i])[0]) return true;
            return false;
        }

        /**
         * Añade un nuevo usuario y su password al array de usuarios.
         * En caso de añadir un usuario previamente añadido lanzará una excepción.
         * 
         * @param {$user}   Nombre de usuario a añadir
         * @param {$pass}   Contraseña del usuario a añadir
         */
        public function addUser($user,$pass) {
            if ($this->checkUserExist($user)) throw new Exception("El usuario ya está registrado en el sistema.");
            array_push($this->_users,limpiarDatos($user).",".limpiarDatos($pass));  //Añadimos usuario, limpiando campos e incrementados contador
            $this->_numAdds++;
        }

        /**
         * Imprime los datos contenidos en el fichero que se indique por parámetro (users | admins)
         * 
         * @param {$nombre} Nombre del fichero (sin extensión) del que se quiere imprimir su contenido
         */
        public function imprimeDatos($nombre) {
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