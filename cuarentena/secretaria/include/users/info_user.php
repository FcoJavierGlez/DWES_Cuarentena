<div>
    <h3>Listado de usuarios</h3>
</div>
<div class="filtro">
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        Buscar usuario:  <input type="text" name="nombre_user">
        <input type="submit" value="Buscar" name="consulta" class="boton_sq editar">
    </form>
</div>
<div class="add_editar scroll">
    <?php
        if ( isset($_POST['consulta']))
            imprimeInfoUser( $_SESSION['usuario']->get( limpiarDatos($_POST['nombre_user']) ) );
        else
            imprimeInfoUser( $_SESSION['usuario']->get() );
    ?>
</div>