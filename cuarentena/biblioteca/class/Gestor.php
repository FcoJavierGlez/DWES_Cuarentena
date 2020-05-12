<?php
    include "resource/funciones.php";
    include "class/error/UserExistException.php";
    include "class/error/UserInvalidException.php";

    class Gestor {

        private $_USUARIO = "root";
        private $_CONTRASENNA = "";
        private $_users = array();
        private $_totalUsers = 0;
        private $_db;

        public function __construct() {
            
        }

        /**
         * Conecta con la BD
         */
        private function conectaDB(){
            try{
                $db = new PDO('mysql:host=localhost;dbname=autentificacion;charset=utf8',$this->_USUARIO,$this->_CONTRASENNA);
                $db -> setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY,true);
    
                return ($db);
            }
            catch(PDOException $e){
                echo "Error";
                exit();
            }
        }

        /**
         * Guarda en el array de usuarios el conjunto de usuarios almacenados en la base de datos
         */
        public function importUsers() {
            $this->_db = $this->conectaDB();                //Conectamos a la BD

            $consulta = $this->_db->prepare("SELECT user, pass FROM users");    //Preparamos la consulta
            $consulta->execute();                                               //La ejecutamos

            $this->_users = $consulta->fetchAll(PDO::FETCH_ASSOC);              //Almacenamos los usuarios en el array _users

            $this->_db = null;                              //Cerramos la conexión con la BD

            $this->_totalUsers = sizeof($this->_users);     //Guardamos la cantidad inicial de usuarios
        }

        /**
         * Guarda en la base de datos la lista de usuarios y sus contraseñas
         */
        public function exportUsers() {
            if (sizeof($this->_users) - $this->_totalUsers == 0) return;     //Si no hay usuarios nuevos no es necesario exportar
            
            $this->_db = $this->conectaDB();       //Conectamos a la BD

            for ($i = $this->_totalUsers; $i < sizeof($this->_users); $i++) { 
                $consulta = $this->_db->prepare("INSERT INTO users (user, pass) VALUES (?,?)"); //Preparamos la consulta
                $consulta->execute(array($this->_users[$i]['user'],$this->_users[$i]['pass'])); //La ejecutamos pasándole los parámetros
            }

            $this->_db = null;
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
         * 
         * @param {$user}       Nombre (o nick) de usuario que se desea comprobar si ha sido previamente añadido al sistema
         * 
         * @return {Boolean}    True si el usuario ya está dentro del sistema, false si nolo está.
         */
        private function checkUserExist($user) {
            for ($i=0; $i<sizeof($this->_users); $i++) 
                if($user == $this->_users[$i]['user']) return true;
            return false;
        }

        /**
         * Valida que los campos de registr de usuario son válidos
         * 
         * @param {$user}       Nombre (o nick) de usuario que se desea validar
         * @param {$pass}       Contraseña que se desea validar
         * 
         * @return {Boolean}    True si el usuario y la contraseña son correctos, false si alguno no lo es
         */
        private function validarCampos($user,$pass) {
            return preg_match('/^\w{4,}$/',$user) && preg_match('/^(\w|\W){4,}$/',$pass);
        }

        /**
         * Añade un nuevo usuario y su password al array de usuarios.
         * En caso de añadir un usuario previamente añadido lanzará UserExistException.
         * Si se intruducen campos inválidos se lanzará UserInvalidException.
         * 
         * @param {$user}   Nombre de usuario a añadir
         * @param {$pass}   Contraseña del usuario a añadir
         */
        public function addUser($user,$pass) {
            $user = limpiarDatos($user);
            $pass = limpiarDatos($pass);
            if (!$this->validarCampos($user,$pass)) throw new UserInvalidException();   //Si los campos no son válidos
            if ($this->checkUserExist($user)) throw new UserExistException();           //Si el usuario ya existe en el sistema
            array_push($this->_users,array("user" => $user, "pass" => $pass));  //Añadimos usuario, limpiando campos e incrementados contador
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