<?php
    if ( !isset($_SESSION['user']) || ( $_SESSION['user']['perfil'] !== "user" && $_SESSION['user']['estado'] !== "activo" ) ) {
        header('Location:index.php');
    }
?>
<div>
    <h3>Mis documentos</h3>
</div>
<div class="filtro">
    <form action="index.php?documentos" method="POST">
        Buscar documento:  <input type="text" name="nombre_documento">
        <input type="submit" value="Buscar" name="consulta" class="boton_sq editar">
    </form>  |  <a href="index.php?add_document"><button class="boton_sq aceptar">Nuevo documento</button></a>
</div>
<div class="add_editar scroll">
    <?php
        /* if ( isset($_POST['consulta']) && $_POST['nombre_user'] !== '' )
            imprimeInfoUser( $_SESSION['usuario']->getUser( limpiarDatos($_POST['nombre_user']) ) );
        else
            imprimeInfoUser( $_SESSION['usuario']->getAllUsers() ); */
    ?>
</div>