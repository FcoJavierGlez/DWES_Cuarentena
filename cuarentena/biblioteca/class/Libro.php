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

        public function get ( $busqueda = '' ) {
            if ( $busqueda !== '' ) {
                if ( preg_match_all('/^(978-|979-)?\d{1,5}(-)\d{1,6}(\2)\d{1,6}(\2)\d$/',$busqueda) ) {
                    $this->query = "SELECT * FROM bi_libros WHERE isbn = :isbn";
                    $this->parametros['isbn'] = $busqueda;
                } else {
                    $this->query = "SELECT * FROM bi_libros WHERE lower( titulo ) = :titulo";
                    $this->parametros['titulo'] = strtolower( $busqueda );
                }
            }
            else
                $this->query = "SELECT * FROM bi_libros";
            
            $this->get_results_from_query();
            $this->close_connection();

            return $this->rows;
        }

        public function getID ( $id = '' ) {
            if ( $id !== '' ) {
                if ( is_numeric($id) ) {
                    $this->query = "SELECT * FROM bi_libros WHERE id = :id";
                    $this->parametros['id'] = $id;
                }
            }
            else
                $this->query = "SELECT * FROM bi_libros";
            
            $this->get_results_from_query();
            $this->close_connection();

            return $this->rows;
        }

        public function set ( $book_data = array() ) {
            $this->query = "INSERT INTO bi_libros (titulo,autor,isbn,editorial,anno_publicacion,img) 
                                VALUES (:titulo,:autor,:isbn,:editorial,:anno_publicacion,:img)";
            $this->parametros['titulo'] = $book_data['titulo'];
            $this->parametros['autor'] = $book_data['autor'];
            $this->parametros['isbn'] = $book_data['isbn'];
            $this->parametros['editorial'] = $book_data['editorial'];
            $this->parametros['anno_publicacion'] = $book_data['anno_publicacion'];
            $this->parametros['img'] = $book_data['img'];
            $this->get_results_from_query();
            $this->close_connection();
        }

        public function edit ( $book_data = array() ) {
            if ( $book_data['img'] == '' ) {
                $this->query = "UPDATE bi_libros SET titulo = :titulo, autor = :autor, isbn = :isbn,
                                editorial = :editorial, anno_publicacion = :anno_publicacion WHERE id = :id";
            } else {
                $this->query = "UPDATE bi_libros SET titulo = :titulo, autor = :autor, isbn = :isbn,
                                editorial = :editorial, anno_publicacion = :anno_publicacion, img = :img WHERE id = :id";
                $this->parametros['img'] = $book_data['img'];
            }
            $this->parametros['titulo'] = $book_data['titulo'];
            $this->parametros['autor'] = $book_data['autor'];
            $this->parametros['isbn'] = $book_data['isbn'];
            $this->parametros['editorial'] = $book_data['editorial'];
            $this->parametros['anno_publicacion'] = $book_data['anno_publicacion'];
            $this->parametros['id'] = $book_data['id'];
            $this->get_results_from_query();
            $this->close_connection();
        }

        public function del ( $id = '' ) {
            if ( $id !== '' && is_numeric($id) ) {
                $this->query = "DELETE FROM bi_libros WHERE id = :id";
                $this->parametros['id'] = $id;
                $this->get_results_from_query();
                $this->close_connection();
            }
        }
    }

?>