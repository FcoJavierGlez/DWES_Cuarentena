<?php
    if ( !isset($_SESSION['user']) || !( $_SESSION['user']['perfil'] == "user" && $_SESSION['user']['estado'] == "activo" ) ) {
        header('Location:index.php');
    }
?>
<div>
    <h3>Nuevo documento</h3>
</div>
<div class="filtro">
    <form action="index.php?documentos" method="POST">
        Buscar documento:  <input type="text" name="nombre_documento">
        <input type="submit" value="Buscar" name="consulta" class="boton_sq editar">
    </form>  |  <a href="index.php?add_document"><button class="boton_sq aceptar">Nuevo documento</button></a>
</div>
<div class="add_editar scroll">
    <form enctype="multipart/form-data" action="index.php" method="post">
        <input type="hidden" name="MAX_FILE_SIZE" value="10485760" /><!-- 10MB Límite -->
        <div class="col2">Seleccione un fichero: <input name="fichero" type="file" /></div>
        <div class="col2">Breve descripción: <input type="text" name="descripcion" size="30"/></div>
        <div class="pie_ficha">
            <input type="submit" value="Subir Fichero" name="add_document" class="boton_sq aceptar">
        </div>
    </form>
</div>