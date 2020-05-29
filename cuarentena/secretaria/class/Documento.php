<?php

    class Documento extends DBAbstractModel {

        private static $_instancia;
        private $_coordClave = array();

        public function __construct() {

        }
        
        public static function singleton() {
            if (!isset(self::$_instancia)) {
                $miClase = __CLASS__;
                self::$_instancia = new $miClase;
            }
            return self::$_instancia;
        }

        public function __clone() {
            trigger_error('La clonación no es permitida.', E_USER_ERROR);
        }

        public function getAllDocumentsByUser( $idUser ) {
            $this->query = "SELECT * FROM sevi_documentos WHERE idUsuario = :idUser";

            $this->parametros['idUser'] = $idUser;

            $this->get_results_from_query();
            $this->close_connection();

            return $this->rows;
        }

        public function getDocumentByUser( $idUser, $busqueda = '' ) {
            $this->query = "SELECT * FROM sevi_documentos WHERE idUsuario = :idUsuario 
                            AND descripcion LIKE :filtro";

            $this->parametros['idUsuario']  = $idUser;
            $this->parametros['filtro']     = "%".$busqueda."%";

            $this->get_results_from_query();
            $this->close_connection();

            return $this->rows;
        }

        private function setDocument( $document_data = array() ) {
            $this->query = "INSERT INTO sevi_documentos (idUsuario,descripcion,fichero,estado) 
                            VALUES (:idUsuario,:descripcion,:fichero,:estado)";

            $this->parametros['idUsuario']      = $document_data['idUsuario'];
            $this->parametros['descripcion']    = $document_data['descripcion'];
            $this->parametros['fichero']        = $document_data['fichero'];
            $this->parametros['estado']         = "Pendiente";

            $this->get_results_from_query();
            $this->close_connection();
        }

        public function subirFichero( $user, $fichero) {

            //almacenamiento del fichero
            //ingreso en el regitro BD

        }

    }

?>