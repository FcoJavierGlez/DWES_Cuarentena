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

        public function getDisponible ( $idLibro = '' ) {
            $this->query = "SELECT COUNT(id_libro) FROM bi_prestamos WHERE devuelto is null and id_libro = :id_libro";

            $this->parametros['id_libro'] = $idLibro;
            
            $this->get_results_from_query();
            $this->close_connection();

            return $this->rows;
        }

        public function getPrestamosUser ( $busqueda = '', $idUser = '' ) {
            if ( $busqueda !== '' ) {
                if ( $busqueda == '*' ) 
                    $this->query = "SELECT L.*, P.prestado, P.devuelto FROM bi_libros L, bi_prestamos P, bi_users U 
                        WHERE P.id_libro = L.id and P.id_user = U.id_user and U.id_user = :id_user";
                elseif ( preg_match_all('/^(978-|979-)?\d{1,5}(-)\d{1,6}(\2)\d{1,6}(\2)\d$/',$busqueda) ) {
                    $this->query = "SELECT L.*, P.prestado, P.devuelto FROM bi_libros L, bi_prestamos P, bi_users U 
                        WHERE P.id_libro = L.id and P.id_user = U.id_user and L.isbn = :isbn and U.id_user = :id_user";

                    $this->parametros['isbn'] = $busqueda;
                }
                else {
                    $this->query = "SELECT L.*, P.prestado, P.devuelto FROM bi_libros L, bi_prestamos P, bi_users U 
                        WHERE P.id_libro = L.id and P.id_user = U.id_user and LOWER( L.titulo ) = :titulo and U.id_user = :id_user";

                    $this->parametros['titulo'] = strtolower($busqueda);
                }
            } 
            else {
                $this->query = "SELECT L.*, P.prestado, P.devuelto FROM bi_libros L, bi_prestamos P, bi_users U 
                    WHERE P.id_libro = L.id and P.id_user = U.id_user and P.devuelto is null and U.id_user = :id_user ";

            }

            $this->parametros['id_user'] = $idUser;
            
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

        public function set ( $prestamos_data = array() ) {
            $this->query = "INSERT INTO bi_prestamos (id_user,id_libro,prestado) VALUES (:id_user,:id_libro,:prestado)";
            $this->parametros['id_user'] = $prestamos_data['id_user'];
            $this->parametros['id_libro'] = $prestamos_data['id_libro'];
            $this->parametros['prestado'] = $prestamos_data['prestado'];
            
            $this->get_results_from_query();
            $this->close_connection();

            return $this->rows;
        }

        //SELECT * FROM bi_libros WHERE id NOT IN (SELECT id_libro FROM bi_prestamos WHERE devuelto IS null)

        //CREATE TRIGGER libroPrestado AFTER INSERT ON bi_prestamos FOR EACH ROW UPDATE bi_libros SET disponible = 0 WHERE id = NEW.id_libro
        //CREATE TRIGGER libroDisponible AFTER UPDATE ON bi_prestamos FOR EACH ROW UPDATE bi_libros SET disponible = 1 WHERE id = OLD.id_libro

    }

?>