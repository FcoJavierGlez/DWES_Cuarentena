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
     * Imprime la ficha de cada préstamo para el administrador
     */
    function imprimeFichaPrestamos( $prestamos ) {
        if ( sizeof($prestamos) == 0 ) echo "<b>No se obtuvo ningún resultado.</b>";
        else 
            foreach ($prestamos as $prestamo) {
                echo "<div class='ficha_prestamo'>";

                    echo "<h3>Ficha de préstamo: ".$prestamo['id_pres']."</h3>";
                    echo "<div class='ficha_pres_libro'>";
                        echo "<img src="."img/books/".( ($prestamo['img'] == null) ? "0.png" : $prestamo['img'] ).">";
                        echo "<div class='info_prestamo w100'>";
                            echo "<div><b>Título:</b></div> <div>".$prestamo['titulo']."</div>";
                            echo "<div><b>Autor:</b></div> <div>".$prestamo['autor']."</div>";
                            echo "<div><b>ISBN:</b></div> <div>".$prestamo['isbn']."</div>";
                            echo "<div><b>Editorial:</b></div> <div>".$prestamo['editorial']."</div>";
                        echo "</div>";
                    echo "</div>";
                    echo "<div class='pie_ficha c3'>";
                        echo "<div><b>Prestado: </b>".$prestamo['prestado']."</div>";
                        echo "<div>".( ($prestamo['devuelto'] == null) ? 
                            "<a href="."prestamos.php?devolver=".$prestamo['id_pres']."><button class='boton_sq aceptar'>Devuelto</button></a>" : "<b>Devuelto: </b>".$prestamo['devuelto'] )."</div>";
                        echo "<div><a href="."libros.php?view=".$prestamo['id']."><button class='boton_sq editar'>Ficha libro</button></a></div>";
                    echo "</div>";

                    echo "<hr>";

                    echo "<h3>Prestado a:</h3>";
                    echo "<div class='info_prestamo w90'>";
                        echo "<div><b>Nombre: </b></div> <div>".$prestamo['nombre']."</div>";
                        echo "<div><b>Apellidos: </b></div> <div>".$prestamo['apellidos']."</div>";
                        echo "<div><b>DNI: </b></div> <div>".$prestamo['dni']."</div>";
                        echo "<div><b>Teléfono: </b></div> <div>".$prestamo['telefono']."</div>";
                        echo "<div><b>Email: </b></div> <div>".$prestamo['email']."</div>";
                    echo "</div>";
                    if ( $prestamo['devuelto'] == null ) {
                        echo "<div class='pie_ficha c2'>";
                            echo "<div><a href="."usuarios.php?contactar=".$prestamo['id_user']."><button class='boton_sq aceptar'>Contactar lector</button></a></div>";
                            echo "<div><a href="."usuarios.php?bloquear=".$prestamo['id_user']."><button class='boton_sq cancelar'>Bloquear lector</button></a></div>";
                        echo "</div>";
                    }

                echo "</div>";
            }
    }

    /**
     * Imprime la ficha de cada libro
     */
    function imprimeFichaLibros( $libros ) {
        if ( sizeof($libros) == 0 ) echo "<b>No se obtuvo ningún resultado.</b>";
        else 
            foreach ($libros as $libro) {
                echo "<div class='ficha_prestamo'>";
                    echo "<h3>Ficha de libro</h3>";
                    echo "<div class='ficha_pres_libro'>";
                        echo "<img src="."img/books/".( ($libro['img'] == null) ? "0.png" : $libro['img'] ).">";
                        echo "<div class='info_prestamo w100'>";
                            echo "<div><b>Título:</b></div> <div>".$libro['titulo']."</div>";
                            echo "<div><b>Autor:</b></div> <div>".$libro['autor']."</div>";
                            echo "<div><b>ISBN:</b></div> <div>".$libro['isbn']."</div>";
                            echo "<div><b>Editorial:</b></div> <div>".( ($libro['editorial'] == null) ? "N/D" : $libro['editorial'] )."</div>";
                            echo "<div><b>Publicado:</b></div> <div>".( ($libro['anno_publicacion'] == null) ? "N/D" : $libro['anno_publicacion'] )."</div>";
                        echo "</div>";
                    echo "</div>";
                    echo "<div class='pie_ficha'>";
                        if ( $libro['disponible'] )
                            echo "<div><a href="."prestamos.php?solicitar=".$libro['id']."><button class='boton_sq aceptar'>Solicitar préstamo</button></a></div>";
                        else
                            echo "<div class='bloqueado'>Actualmente en préstamo</div>";
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