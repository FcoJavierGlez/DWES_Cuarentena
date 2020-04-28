<?php
    /**
     * Limpia los datos de entrada eliminando espacios en blanco o caracteres que no sean letras.
     */
    function limpiarDatos($campo) {
        $campo=trim($campo);
        $campo=stripslashes($campo);
        $campo=htmlspecialchars($campo);
        return $campo;
    }
    
    /**
     * Cierra la sesión
     */
    function cerrarSesion() {
        session_unset();
        session_destroy();
        session_start();
        session_regenerate_id();
        header('Location:index.php');
    }

    function sumaNumeros($num) {
        $salida = 0;
        if (strlen($num)==1) return strval($num);
        else {
            //$salida += strval(substr($num,0,1));
            echo substr($num,0,strlen($num)-1);
            $salida += strval(sumaNumeros(substr($num,0,strlen($num)-1)));
            /* $salida += strval(substr($num,0,1));
            $salida += strval(sumaNumeros(substr($num,1,strlen($num)-1))); */
        }
        return $salida;
    }
?>