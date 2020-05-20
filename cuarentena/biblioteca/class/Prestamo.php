<?php

    class Prestamo extends DBAbstractModel {

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
                if ( $busqueda == '*' ) {
                    $this->query = "SELECT L.*, U.id_user, U.nombre, U.apellidos, U.telefono, U.email, U.dni,
                        P.prestado, P.devuelto, P.id_pres
                        FROM bi_libros L, bi_users U, bi_prestamos P 
                        WHERE P.id_user = U.id_user and P.id_libro = L.id";
                }
                elseif ( preg_match_all('/^(978-|979-)?\d{1,5}(-)\d{1,6}(\2)\d{1,6}(\2)\d$/',$busqueda) ) {
                    $this->query = "SELECT L.*, U.id_user, U.nombre, U.apellidos, U.telefono, U.email, U.dni,
                        P.prestado, P.devuelto, P.id_pres
                        FROM bi_libros L, bi_users U, bi_prestamos P 
                        WHERE P.id_user = U.id_user and P.id_libro = L.id and L.isbn = :isbn";

                    $this->parametros['isbn'] = $busqueda;
                }
                elseif ( is_numeric($busqueda) ) {
                    $this->query = "SELECT L.*, U.id_user, U.nombre, U.apellidos, U.telefono, U.email, U.dni,
                        P.prestado, P.devuelto, P.id_pres
                        FROM bi_libros L, bi_users U, bi_prestamos P 
                        WHERE P.id_user = U.id_user and P.id_libro = L.id and P.id_pres = :id_pres";

                    $this->parametros['id_pres'] = $busqueda;
                }
            }
            else
                $this->query = "SELECT L.*, U.id_user, U.nombre, U.apellidos, U.telefono, U.email, U.dni,
                    P.prestado, P.devuelto, P.id_pres
                    FROM bi_libros L, bi_users U, bi_prestamos P 
                    WHERE P.id_user = U.id_user and P.id_libro = L.id and P.devuelto IS null ";
            
            $this->get_results_from_query();
            $this->close_connection();

            return $this->rows;
        }

        public function edit ( $prestamos_data = array() ) {
            $this->query = "UPDATE bi_prestamos SET devuelto = :devuelto WHERE id_pres = :id_pres";
            $this->parametros['devuelto'] = $prestamos_data['devuelto'];
            $this->parametros['id_pres'] = $prestamos_data['id_pres'];
            
            $this->get_results_from_query();
            $this->close_connection();

            return $this->rows;
        }

    }

?>