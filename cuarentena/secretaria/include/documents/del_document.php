<?php
    if ( !isset($_SESSION['user']) || !( $_SESSION['user']['perfil'] == "user" && $_SESSION['user']['estado'] == "activo" ) ) {
        header('Location:index.php');
    }
?>
<div>
    <h3>Borrar documento</h3>
</div>
<div class="filtro">
    <!-- <form action="index.php?documentos" method="POST">
        Buscar documento:  <input type="text" name="nombre_documento">
        <input type="submit" value="Buscar" name="consulta" class="boton_sq editar">
    </form>  |  <a href="index.php?add_document"><button class="boton_sq aceptar">Nuevo documento</button></a> -->
</div>
<div class="add_editar scroll">
    <div class="ficha_prestamo">
        <div>
            Está a punto de borrar este documento: 
            <?php
                imprimeInfoDocumentToDel( $_SESSION['documento']->getDocumentById( $_GET['delete'], $_SESSION['user']['id'] ) );
            ?>
            <form action="index.php" method="post">
                <input type="hidden" name="id" value="<?php echo $_GET['delete'] ?>">
                ¿Desea continuar?
                <input type="submit" value="Aceptar" name="acept_del" class="boton_sq aceptar">
                <input type="submit" value="Cancelar" name="cancel_del" class="boton_sq cancelar">
            </form>
        </div>
    </div>
</div>