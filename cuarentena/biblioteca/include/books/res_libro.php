<div>
    <h3>Listado de títulos</h3>
</div>
<div class="filtro">
    <form action=<?php echo $_SERVER['PHP_SELF']; ?> method="post">
        Buscar por título:  <input type="text" name="nombre_libro">
        <input type="submit" value="Enviar" name="consulta">
    </form>
</div>
<div class="listado">
    <?php
        if ( isset($_POST['consulta']) )
            imprimeFichaLibros( $_SESSION['libro']->get( limpiarDatos($_POST['nombre_libro']) ) );
        else
            imprimeFichaLibros( $_SESSION['libro']->get() );

        /* echo "<div class='ficha_prestamo'>";
            echo "<h3>Ficha de libro</h3>";
            echo "<div class='ficha_pres_libro'>";
                echo "<img src='img/books/0.png'>";
                echo "<div class='info_prestamo w100'>";
                    echo "<div><b>Título:</b></div> <div>titulo</div>";
                    echo "<div><b>Autor:</b></div> <div>autor</div>";
                    echo "<div><b>ISBN:</b></div> <div>isbn</div>";
                    echo "<div><b>Editorial:</b></div> <div>editorial</div>";
                echo "</div>";
            echo "</div>";
            echo "<div class='pie_ficha'>";
                echo "<div><a href="."prestamos.php?solicitar=id_libro"."><button class='boton_sq aceptar'>Solicitar préstamo</button></a></div>";
            echo "</div>";
        echo "</div>"; */
    ?>
</div>