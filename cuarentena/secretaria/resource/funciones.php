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

    function imprimePassCensurada( $pass ) {
        $salida = "";
        for ($i=0; $i < strlen($pass); $i++) 
            $salida .= "*";
        return $salida;
    }

    function getLetterFromRow( $fila ) {
        switch ($fila) {
            case 0:
                return "A";
            case 1:
                return "B";
            case 2:
                return "C";
            case 3:
                return "D";
            case 4:
                return "E";
            case 5:
                return "F";
            case 6:
                return "G";
            case 7:
                return "H";
        }
    }

    /**
     * Imprime la información de cada libro
     */
    function imprimeInfoLibro( $libros ) {
        if ( sizeof($libros) == 0 ) echo "<b>No se obtuvo ningún resultado.</b>";
        else 
            foreach ($libros as $libro) {
                echo "<div class='info_libro'>";
                    echo "<img src="."img/books/".( ($libro['img'] == null) ? "0.png" : $libro['img'] ).">";
                    echo "<div class='info_contenido'>";
                        echo "<div class='info'>";
                            echo "<div><b>Título: </b>".$libro['titulo']."</div>";
                            echo "<div><b>Editorial: </b>".( ($libro['editorial'] == null) ? "N/D" : $libro['editorial'] )."</div>";
                            echo "<div><b>Autor: </b>".$libro['autor']."</div>";
                            echo "<div><b>Publicado: </b>".( ($libro['anno_publicacion'] == null) ? "N/D" : $libro['anno_publicacion'] )."</div>";
                            echo "<div><b>ISBN: </b>".$libro['isbn']."</div>";
                        echo "</div>";
                        echo "<div class='info_enlaces'>";
                            echo "<a href=".$_SERVER['PHP_SELF']."?edit=".$libro['id']."><button class='boton_sq editar'>Editar</button></a>  
                                    |  <a href=".$_SERVER['PHP_SELF']."?del=".$libro['id']."><button class='boton_sq cancelar'>Eliminar</button></a>";
                        echo "</div>";
                    echo "</div>";
                echo "</div>";
            }
    }

    /**
     * Imprime una tabla con los usuarios en el sistema
     */
    function imprimeInfoUser( $users ) {
        if ( sizeof($users) == 0 ) echo "<b>No se obtuvo ningún resultado.</b>";
        else {
            echo "<table>";
            echo "<th>NOMBRE</th><th>APELLIDOS</th><th>EMAIL</th><th>ESTADO</th><th>ACTIVAR</th><th>BLOQUEAR</th>";
                foreach ($users as $user) {
                    echo "<tr>";
                        echo "<td>".$user['nombre']."</td>";
                        echo "<td>".$user['apellidos']."</td>";
                        echo "<td>".$user['email']."</td>";
                        echo ( ( $user['estado'] == "bloqueado" ) ? 
                                "<td class='bloqueado'>".$user['estado']."</td>" : "<td>".$user['estado']."</td>" );
                        echo ( ( ( $user['estado'] == "pendiente" || $user['estado'] == "bloqueado" )  && $user['perfil'] !== "administrador" ) ? 
                            "<td><a href="."index.php?activar=".$user['id']."><button class='boton_sq aceptar'>Activar</button></a></td>" : "<td>---</td>" );
                        echo ( ( $user['estado'] == "activo" && $user['perfil'] == "user" ) ? 
                            "<td><a href="."index.php?bloquear=".$user['id']."><button class='boton_sq cancelar'>Bloquear</button></a></td>" : "<td>---</td>" );
                    echo "</tr>";
                }
            echo "</table>";
        }
    }

    /**
     * Imprime una tabla con los usuarios en el sistema
     */
    function imprimeInfoDocument( $documents ) {
        if ( sizeof($documents) == 0 ) echo "<b>No se obtuvo ningún resultado.</b>";
        else {
            echo "<table>";
            echo "<th>DESCRIPCIÓN</th><th>ESTADO</th><th>FECHA FIRMA</th><th>FIRMAR</th><th>ELIMINAR</th><th>DESCARGAR</th>";
                foreach ($documents as $document) {
                    echo "<tr>";
                        echo "<td>".$document['descripcion']."</td>";
                        echo "<td>".$document['estado']."</td>";
                        echo "<td>".( $document['fechaFirma'] == NULL ? "---" : $document['fechaFirma'] )."</td>";
                        echo "<td>".( $document['fechaFirma'] == NULL ? 
                            "<a href="."index.php?firmar=".$document['id']."><button class='boton_sq aceptar'>Firmar</button></a>" : "---" )."</td>";
                        echo "<td><a href="."index.php?delete=".$document['id']."><button class='boton_sq cancelar'>Eliminar</button></a></td>";
                        echo "<td><a href="."users/".$document['directorio']."/".$document['fichero']." download><button class='boton_sq editar'>Descargar</button></a></td>";
                    echo "</tr>";
                }
            echo "</table>";
        }
    }

    /**
     * Imprime una tabla con los usuarios en el sistema
     */
    function imprimeInfoDocumentToDel( $documents ) {
        if ( sizeof($documents) == 0 ) echo "<b>No se obtuvo ningún resultado.</b>";
        else {
            echo "<table>";
            echo "<th>DESCRIPCIÓN</th><th>ESTADO</th><th>FECHA FIRMA</th>";
                foreach ($documents as $document) {
                    echo "<tr>";
                        echo "<td>".$document['descripcion']."</td>";
                        echo "<td>".$document['estado']."</td>";
                        echo "<td>".( $document['fechaFirma'] == NULL ? "---" : $document['fechaFirma'] )."</td>";
                    echo "</tr>";
                }
            echo "</table>";
        }
    }

    /**
     * Imprime la ficha de cada libro
     */
    function imprimeFichaDocumento( $documentos ) {
        if ( sizeof($documentos) == 0 ) echo "<b>No se obtuvo ningún resultado.</b>";
        else 
            foreach ($documentos as $documento) {
                echo "<div class='ficha_prestamo'>";
                    echo "<h3>Ficha de documento</h3>";
                    echo "<div class='w90'>";
                        //echo "<img src="."img/books/".( ($documento['img'] == null) ? "0.png" : $documento['img'] ).">";
                        echo "<div class='info_prestamo w100'>";
                            echo "<div><b>Descripción:</b></div> <div>".$documento['descripcion']."</div>";
                            echo "<div><b>Popietario/a:</b></div> <div>".$documento['apellidos'].",".$documento['nombre']."</div>";
                            echo "<div><b>Fecha:</b></div> <div>".date("H:i:s d/m/Y")."</div>";
                            echo "<div><b>Estado actual:</b></div> <div>Pendiente</div>";
                        echo "</div>";
                    echo "</div>";
                echo "</div>";
            }
    }

    /**
     * Imprime la ficha de cada préstamo
     */
    function imprimePrestamosLector( $prestamos ) {
        if ( sizeof($prestamos) == 0 ) echo "<b>No se obtuvo ningún resultado.</b>";
        else 
            foreach ($prestamos as $prestamo) {
                echo "<div class='ficha_prestamo'>";
                    echo "<h3>Ficha de libro</h3>";
                    echo "<div class='ficha_pres_libro'>";
                        echo "<img src="."img/books/".( ($prestamo['img'] == null) ? "0.png" : $prestamo['img'] ).">";
                        echo "<div class='info_prestamo w100'>";
                            echo "<div><b>Título:</b></div> <div>".$prestamo['titulo']."</div>";
                            echo "<div><b>Autor:</b></div> <div>".$prestamo['autor']."</div>";
                            echo "<div><b>ISBN:</b></div> <div>".$prestamo['isbn']."</div>";
                            echo "<div><b>Editorial:</b></div> <div>".$prestamo['editorial']."</div>";
                        echo "</div>";
                    echo "</div>";
                    echo "<div class='pie_ficha c2'>";
                        echo "<div><b>Prestado: </b>".$prestamo['prestado']."</div>";
                        if ( $prestamo['devuelto'] == null )
                            echo "<div><b>Devuelto: </b><span class='bloqueado'>Pendiente</span></div>";
                        else
                            echo "<div><b>Devuelto: </b>".$prestamo['devuelto']."</div>";
                    echo "</div>";
                echo "</div>";
            }
    }
?>