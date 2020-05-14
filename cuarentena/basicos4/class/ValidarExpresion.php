<?php
    /**
     * Utilizando las estructuras creadas, crea un programa que determine si una expresión con paréntesis está equilibrada.
     * (x + y * ( m / ( n - p  )  )  ) + ( x / y )
     */

    include "class/Pila.php";

    class ValidarExpresion {

        private $_pila;

        public function __construct() {
            $this->_pila = new Pila();
        }

        /**
         * Valida que en una expresión todos los paréntesis abiertos queden
         * correctamente cerrados
         * 
         * @param {$string}     Expresión de entrada
         * 
         * @return {Boolean}    True si la expresión es correcta, false si no lo es.
         */
        public function valida($string) {
            for ( $i = 0; $i < strlen($string); $i++ ) { 
                if ( substr($string, $i, 1) == "(" ) 
                    $this->_pila->addElement( "(" );
                elseif ( substr($string, $i, 1) == ")" && $this->_pila->getNumElements() < 1 )
                    return false;
                elseif ( substr($string, $i, 1) == ")")
                    $this->_pila->delElement();
            }
            return $this->_pila->getNumElements() == 0;
        }

    }

?>