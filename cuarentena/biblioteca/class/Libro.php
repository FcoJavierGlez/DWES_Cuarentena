<?php

    class Libro extends DBAbstractModel {
        
        private static $instancia;

        public function __construct() {

        }
        
        public static function singleton() {
            if (!isset(self::$instancia)) {
                $miClase = __CLASS__;
                self::$instancia = new $miClase;
            }
            return self::$instancia;
        }

        public function __clone() {
            trigger_error('La clonación no es permitida.', E_USER_ERROR);
        }

        public function get ( $titulo = '' ) {
            if ( $titulo !== '' ) {
                $this->query = "SELECT * FROM bi_libros WHERE lower( titulo ) = :titulo";
                $this->parametros['titulo'] = strtolower( $titulo );
            }
            else
                $this->query = "SELECT * FROM bi_libros";
            
            $this->get_results_from_query();
            $this->close_connection();

            return $this->rows;
        }

        public function set ( $book_data = array() ) {
            $this->query = "INSERT INTO bi_libros (titulo,autor,isbn) VALUES (:titulo,:autor,:isbn)";
            $this->parametros['titulo'] = $book_data['titulo'];
            $this->parametros['autor'] = $book_data['autor'];
            $this->parametros['isbn'] = $book_data['isbn'];
            $this->get_results_from_query();
            $this->mensaje = 'Usuario agregado exitosamente';
        }
        
    }

?>