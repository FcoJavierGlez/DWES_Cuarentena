<?php
    class DNI {

        private static $letras = array('T','R','W','A','G','M','Y','F','P','D','X','B','N','J','Z','S','Q','V','H','L','C','K','E');
        
        public static function validarDNI($dni) {
            if (preg_match('/^(\d{8})(-|\s)?(\w)$/i',$dni,$matches)) 
                return (strtoupper($matches[3])==DNI::$letras[$matches[1]%23]);
            else
                return false;
        }

    }
?>