<div>
    <h3>Listado de títulos</h3>
</div>
<div class="filtro">
    <form action=<?php echo $_SERVER['PHP_SELF']; ?> method="post">
        Buscar libro:  <input type="text" name="libro">
        <input type="submit" value="Buscar" name="consulta" class="boton_sq editar">
    </form>
</div>
<div class="listado scroll">
    <?php
        if ( isset($_POST['consulta']) && $_POST['libro'] !== '' )
            imprimeFichaLibros( $_SESSION['libro']->get( limpiarDatos($_POST['libro']) ) );
        else
            imprimeFichaLibros( $_SESSION['libro']->getLibrosDiponibles() );
    ?>
</div>