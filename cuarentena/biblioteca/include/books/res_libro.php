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
    ?>
</div>