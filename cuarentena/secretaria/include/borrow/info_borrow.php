<div>
    <h3>Listado de préstamos</h3>
</div>
<div class="filtro">
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        Buscar préstamo por ID o ISBN:  <input type="text" name="busq_prestamo">
        <input type="submit" value="Buscar" name="consulta" class="boton_sq editar">
    </form>
</div>
<div class="listado scroll">
    <?php
        if ( isset($_POST['consulta']) )
            imprimeFichaPrestamos( $_SESSION['prestamo']->get( limpiarDatos($_POST['busq_prestamo']) ) );
        else
            imprimeFichaPrestamos( $_SESSION['prestamo']->get() );
    ?>
</div>