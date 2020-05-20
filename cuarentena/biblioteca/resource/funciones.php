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

    /**
     * Imprime la información de cada libro
     */
    function imprimeInfoLibro( $libros ) {
        if ( sizeof($libros) == 0 ) echo "<b>No se ha encontrado ningún libro con título: ".limpiarDatos($_POST['nombre_libro'])."</b>";
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
            echo "<th>ID</th><th>NICK</th><th>EMAIL</th><th>ESTADO</th><th>ACTIVAR</th><th>BLOQUEAR</th><th>ELIMINAR</th>";
                foreach ($users as $user) {
                    echo "<tr>";
                        echo "<td>".$user['id_user']."</td>";
                        echo "<td>".$user['user']."</td>";
                        echo "<td>".$user['email']."</td>";
                        echo ( ( $user['estado'] == "bloqueado" ) ? 
                                "<td class='bloqueado'>".$user['estado']."</td>" : "<td>".$user['estado']."</td>" );
                        echo ( ( ( $user['estado'] == "pendiente" || $user['estado'] == "bloqueado" )  && $user['perfil'] !== "administrador" ) ? 
                            "<td><a href=".$_SERVER['PHP_SELF']."?aceptar=".$user['id_user']."><button class='boton_sq aceptar'>Aceptar</button></a></td>" : "<td>---</td>" );
                        echo ( ( $user['estado'] == "activo" ) ? 
                            "<td><a href=".$_SERVER['PHP_SELF']."?bloquear=".$user['id_user']."><button class='boton_sq cancelar'>Bloquear</button></a></td>" : "<td>---</td>" );
                        echo ( (  $user['perfil'] !== "administrador"  ) ? 
                            "<td><a href=".$_SERVER['PHP_SELF']."?borrar=".$user['id_user']."><button class='boton_sq cancelar'>Eliminar</button></a></td>" : "<td>---</td>" );
                    echo "</tr>";
                }
            echo "</table>";
        }
    }

        /**
     * Imprime la ficha de cada préstamo
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
                            echo "<div><a href="."".$prestamo['id_user']."><button class='boton_sq aceptar'>Contactar lector</button></a></div>";
                            echo "<div><a href="."".$prestamo['id_user']."><button class='boton_sq cancelar'>Bloquear lector</button></a></div>";
                        echo "</div>";
                    }

                echo "</div>";
            }
    }
?>