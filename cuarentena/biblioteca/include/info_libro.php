<div>
    <h3>Listado de títulos</h3>
</div>
<div class="filtro">
    <form action=<?php echo $_SERVER['PHP_SELF']; ?> method="post">
        Buscar título:  <input type="text" name="nombre_libro">
        <input type="submit" value="Enviar" name="consulta">
    </form>  |  <a href="add_libro.php"><button>Añadir libro</button></a>
</div>
<div class="listado">
    <?php
        if ( isset($_POST['consulta']) )
            imprimeInfoLibro( $_SESSION['libro']->get( limpiarDatos($_POST['nombre_libro']) ) );
        else
            imprimeInfoLibro( $_SESSION['libro']->get() );
    ?>
</div>