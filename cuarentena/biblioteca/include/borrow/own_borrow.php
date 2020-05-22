<div>
    <h3>Mis préstamos</h3>
</div>
<div class="filtro">
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        Buscar por título o ISBN:  <input type="text" name="busq_prestamo">
        <input type="submit" value="Buscar" name="consulta" class="boton_sq editar">
    </form>
</div>
<div class="listado scroll">
    <?php
        if ( isset($_POST['consulta']) )
            imprimePrestamosLector( $_SESSION['prestamo']->getPrestamosUser( limpiarDatos($_POST['busq_prestamo']), $_SESSION['user']['id_user'] ) );
        else
            imprimePrestamosLector( $_SESSION['prestamo']->getPrestamosUser( '', $_SESSION['user']['id_user'] ) );
    ?>
</div>