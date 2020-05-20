<div>
    <h3>Listado de préstamos</h3>
</div>
<div class="filtro">
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        Buscar por ID préstamo o ISBN:  <input type="text" name="busq_prestamo">
        <input type="submit" value="Enviar" name="consulta">
    </form>
</div>
<div class="listado">
    <?php
        if ( isset($_POST['consulta']) )
            imprimeFichaPrestamos( $_SESSION['prestamo']->get( limpiarDatos($_POST['busq_prestamo']) ) );
        else
            imprimeFichaPrestamos( $_SESSION['prestamo']->get() );
    ?>
</div>