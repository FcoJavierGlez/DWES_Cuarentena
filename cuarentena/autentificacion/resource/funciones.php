<?php
    /**
     * 
     */
    function limpiarDatos($campo) {
        $campo=trim($campo);
        $campo=stripslashes($campo);
        $campo=htmlspecialchars($campo);
        return $campo;
    }

    

        /**
         * Comprueba si el usuario que se está logeando está dentro del sistema (admin | user)
         * 
         * @param {$cadena}                 Cadena formada por el nombre de usuario y la contraseña "user,pass"
         * @param {$cadenombreFicherona}    Nombre del fichero en el que se desea buscar a la persona que se está logeando
         * 
         * @return {Boolean}                True si el usuario que logea se haya en el sistema, false si no
         */
        function validarLogin($cadena,$nombreFichero) {
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
        function getPerfil($user,$pass) {
            $cadena = limpiarDatos($user).",".limpiarDatos($pass);
            if (validarLogin($cadena,"admins")) return "administrador";
            elseif (validarLogin($cadena,"users")) return "usuario";
            else return "invitado";
        }

    /**
     * 
     */
    function cerrarSesion() {
        session_unset();
        session_destroy();
        session_start();
        session_regenerate_id();
        header('Location:index.php');
    }
?>