<?php
    if ( !isset($_SESSION['user']) || $_SESSION['user']['perfil'] !== "admin" ) {
        header('Location:index.php');
    }
?>
<div>
    <h3>Listado de usuarios</h3>
</div>
<div class="filtro">
    <form action="index.php?usuarios" method="POST">
        Buscar usuario:  <input type="text" name="nombre_user">
        <input type="submit" value="Buscar" name="consulta" class="boton_sq editar">
    </form>
</div>
<div class="add_editar scroll">
    <?php
        if ( isset($_POST['consulta']) && $_POST['nombre_user'] !== '' )
            imprimeInfoUser( $_SESSION['usuario']->getUser( limpiarDatos($_POST['nombre_user']) ) );
        else
            imprimeInfoUser( $_SESSION['usuario']->getAllUsers() );
    ?>
</div>