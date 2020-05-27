<div>
    <h3>Listado de títulos</h3>
</div>
<div class="filtro">
    <form action=<?php echo $_SERVER['PHP_SELF']; ?> method="post">
        Buscar libro:  <input type="text" name="nombre_libro">
        <input type="submit" value="Buscar" name="consulta" class="boton_sq editar">
    </form>  |  <a href="libros.php?add"><button class="boton_sq aceptar">Añadir libro</button></a>
</div>
<div class="listado scroll">
    <?php
        if ( isset($_POST['consulta']) )
            imprimeInfoLibro( $_SESSION['libro']->get( limpiarDatos($_POST['nombre_libro']) ) );
        else
            imprimeInfoLibro( $_SESSION['libro']->get() );
    ?>
</div>