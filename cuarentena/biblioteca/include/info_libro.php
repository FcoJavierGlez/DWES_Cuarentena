<?php

    function imprimeInfo( $libros ) {
        if ( sizeof($libros) == 0 ) echo "No se ha encontrado ningún libro con título: ".limpiarDatos($_POST['nombre_libro'])."";
        else 
            foreach ($libros as $libro) {
                echo "<div class='info_libro'>";
                    echo "<img src="."img/books/".( ($libro['img'] == null) ? "0.png" : $libro['img'] ).">";
                    /* echo "<img src="."img/books/0.png".">"; */
                    echo "<div class='info_contenido'>";
                        echo "<div class='info'>";
                            echo "<div><b>Título: </b>".$libro['titulo']."</div>";
                            echo "<div><b>Editorial: </b>".( ($libro['editorial'] == null) ? "N/D" : $libro['editorial'] )."</div>";
                            echo "<div><b>Autor: </b>".$libro['autor']."</div>";
                            echo "<div><b>Publicado: </b>".( ($libro['anno_publicacion'] == null) ? "N/D" : $libro['anno_publicacion'] )."</div>";
                            echo "<div><b>ISBN: </b>".$libro['isbn']."</div>";
                        echo "</div>";
                        echo "<div class='info_enlaces'>";
                            echo "<a href='#'>Editar</a>  |  <a href='#'>Eliminar</a>";
                        echo "</div>";
                    echo "</div>";
                echo "</div>";
            }
        
    }

    if ( isset($_POST['consulta']) )
        imprimeInfo( $_SESSION['libro']->get( limpiarDatos($_POST['nombre_libro']) ) );
    else
        imprimeInfo( $_SESSION['libro']->get( '' ) );


?>