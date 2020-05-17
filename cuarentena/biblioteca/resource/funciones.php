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
        if ( sizeof($libros) == 0 ) echo "No se ha encontrado ningún libro con título: ".limpiarDatos($_POST['nombre_libro'])."";
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
                            echo "<a href=".$_SERVER['PHP_SELF']."?edit=".$libro['id'].">Editar</a>  |  <a href=".$_SERVER['PHP_SELF']."?del=".$libro['id'].">Eliminar</a>";
                        echo "</div>";
                    echo "</div>";
                echo "</div>";
            }
    }
?>