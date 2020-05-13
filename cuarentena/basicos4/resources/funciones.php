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
     * Suma los dígitos del array pasado por parámetro. Si el número contiene
     * algún caracter no numérico lanza una excepción.
     * 
     * @param {$i}      Posición de índice del array
     * @param {$num}    Array de números enteros
     * 
     * @return {int}    Suma de los dígitos del array
     */
    function sumaNumeros($i, $num) {
        if ( !is_numeric( $num[$i] ) ) throw new Exception();               //Si la posición $i de $num no es un número
        if ( $i + 1 == sizeof( $num ) ) return $num[$i];
        else {
            $salida = 0;
            $salida += strval( $num[$i] );
            $salida += strval( sumaNumeros($i + 1, $num) );
        }
        return $salida;
    }
?>