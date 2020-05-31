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

        /**
         * Muestra todos los documentos del usuario especificado
         */
        public function getAllDocumentsByUser( $idUser ) {
            $this->query = "SELECT D.*, U.directorio FROM sevi_usuarios U, sevi_documentos D 
                            WHERE D.idUsuario = U.id AND U.id = :idUser";

            $this->parametros['idUser'] = $idUser;

            $this->get_results_from_query();
            $this->close_connection();

            return $this->rows;
        }

        /**
         * Busca un documento concreto del usuario especificado
         */
        public function getDocumentByUser( $idUser, $busqueda = '' ) {
            $this->query = "SELECT D.*, U.directorio FROM sevi_usuarios U, sevi_documentos D 
                            WHERE D.idUsuario = U.id AND U.id = :idUser AND descripcion LIKE :filtro";

            $this->parametros['idUsuario']  = $idUser;
            $this->parametros['filtro']     = "%".$busqueda."%";

            $this->get_results_from_query();
            $this->close_connection();

            return $this->rows;
        }

        /**
         * Muestra el documento seleccionado y en propiedad del usuario logeado
         */
        public function getDocumentById( $id, $idUser ) {
            $this->query = "SELECT D.*, U.directorio FROM sevi_usuarios U, sevi_documentos D 
                            WHERE D.idUsuario = U.id AND D.idUsuario = :idUser AND D.id = :id";
            
            $this->parametros['id']     = $id;
            $this->parametros['idUser'] = $idUser;

            $this->get_results_from_query();
            $this->close_connection();

            return $this->rows;
        }

        /**
         * Muestra el documento seleccionado para su firma
         */
        public function getDocumentTosign( $id, $idUser ) {
            $this->query = "SELECT D.*, U.* FROM sevi_usuarios U, sevi_documentos D 
                            WHERE D.idUsuario = U.id AND D.idUsuario = :idUser AND D.id = :id";
            
            $this->parametros['id'] = $id;
            $this->parametros['idUser'] = $idUser;

            $this->get_results_from_query();
            $this->close_connection();

            return $this->rows;
        }

        /**
         * Muestra el documento seleccionado y en propiedad del usuario logeado
         */
        private function deleteDocument( $idFichero, $idUser ) {
            $this->query = "DELETE FROM sevi_documentos 
                            WHERE idUsuario = :idUsuario 
                            AND id = :id";
            
            $this->parametros['idUsuario']  = $idUser;
            $this->parametros['id']         = $idFichero;

            $this->get_results_from_query();
            $this->close_connection();

            return $this->rows;
        }

        /**
         * Añade un nuevo documento para el usuario
         */
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

        /**
         * Sube un nuevo documento al directorio del usuario y lo añade a la BD
         */
        public function subirFichero( $user, $fichero, $descripcion ) {

            preg_match('/(.\w+)$/',$fichero['name'], $matches);     //Capturamos la extensión del fichero

            //Datos almacenamiento del fichero
            $document_data = array(
                'idUsuario'     => $user['id'],
                'descripcion'   => $descripcion,
                'fichero'       => "file".date("HisdmY").$user['id'].$matches[0],
            );

            if ( move_uploaded_file( $fichero['tmp_name'], "users/".$user['directorio']."/".$document_data['fichero'] ) ) {
                $this->setDocument( $document_data );
                return true;
            } 
            else
                return false;
        }

        /**
         * Firmar un documento
         */
        public function firmarDocumento ( $idFichero, $fechaHora ) {
            $this->query = "UPDATE sevi_documentos SET estado = :estado, fechaFirma = :fechaFirma 
                            WHERE id = :id";

            $this->parametros['id']         = $idFichero;
            $this->parametros['estado']     = "Firmado";
            $this->parametros['fechaFirma'] = $fechaHora;

            $this->get_results_from_query();
            $this->close_connection();
        }

        /**
         * Elimina el documento especificado de su propietario tanto del servidor como de su registro en la BD
         */
        public function borrarFichero( $user, $idFichero ) {

            $fichero = $this->getDocumentById( $idFichero, $user['id'] )[0];

            if ( file_exists("users/".$user['directorio']."/".$fichero['fichero']) ) {
                unlink( "users/".$user['directorio']."/".$fichero['fichero'] );
                $this->deleteDocument( $idFichero, $user['id'] );
            }
        }

    }

?>