<?php 
    /**
     * Esta clase hace uso de la librería PHPMailer 5.2: https://github.com/PHPMailer/PHPMailer/tree/5.2-stable
     */
    require "phpmailer/class.phpmailer.php";

    
    class Mail {

        private $_mail      = NULL;

        public function __construct() {
            $this->_mail = new PHPMailer;
        }

        /**
         * Envía un correo electrónico, con o sin fichero adjunto, 
         * al destinatario pasado por parámetro.
         * 
         * @param {$destinatario}       Dirección a la que va dirigido el correo
         * @param {$nomreDest}          Nombre del propietario/a del correo destinatario
         * @param {$remitente}          Dirección desde donde se manda el correo
         * @param {$nombreRem}          Nombre de la persona que manda el correo
         * @param {$titulo}             Título del correo                                   {opcional}
         * @param {$mensaje}            Mensaje contenido en el correo
         * @param {$ficheroAdjunto}     Fichero que se adjunta                              {opcional}
         */
        public function enviarmail( $destinatario = '', $nombreDest = '', $remitente = '', 
                                    $nombreRem = '', $titulo = '', $mensaje = '', $ficheroAdjunto = NULL ) {
            $this->_mail->CharSet  = "utf-8";
            $this->_mail->From     = $remitente;
            $this->_mail->FromName = $nombreRem;
            $this->_mail->Subject  = $titulo;

            $this->_mail->addAddress( $destinatario, $nombreDest );
            $this->_mail->msgHTML( $mensaje );

            if ( $ficheroAdjunto !== NULL )
                $this->_mail->addAttachment( $ficheroAdjunto );

            return $this->_mail->send();
        }

    }

?>