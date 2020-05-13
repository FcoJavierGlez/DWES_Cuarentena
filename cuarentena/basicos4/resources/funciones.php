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

    /**
     * Suma los dígitos del número pasado por parámetro. Si el número contiene
     * algún caracter no numérico lanza una excepción.
     * 
     * @param {$num}    Número entero, pasado en forma de cadena.
     * 
     * @return {int}    Suma de los dígitos del número
     */
    function sumaNumeros($num) {
        if (!is_numeric(substr($num,0,1))) throw new Exception();               //Si la posición 0 de $num no es un número
        $salida = 0;
        if (strlen($num)==1) return strval($num);
        else {
            $salida += strval(substr($num,0,1));
            $salida += strval(sumaNumeros(substr($num,1,strlen($num)-1)));
        }
        return $salida;
    }
?>