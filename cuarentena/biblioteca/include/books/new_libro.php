<div>
    <h3>Añadir libro</h3>
</div>
<div class="filtro">
    <form action="libros.php" method="post">
        Buscar libro:  <input type="text" name="nombre_libro">
        <input type="submit" value="Buscar" name="consulta" class="boton_sq editar">
    </form>
</div>
<div class="add_editar">
    <form action="add_libro.php" method="post">
        <div class="col2">Portada: <input type='file' name='img'></div>
        <div class="col2">Título: <input type='text' name='titulo' value="<?php echo ( ( isset($_POST['add_libro']) ) ? $_POST['titulo'] : "" ); ?>" required></div>
        <div class="col2">Autor: <input type='text' name='autor' value="<?php echo ( ( isset($_POST['add_libro']) ) ? $_POST['autor'] : "" ); ?>" required></div>
        <div class="col2">
            ISBN: <input type='text' name='isbn' value="<?php echo ( ( isset($_POST['add_libro']) ) ? $_POST['isbn'] : "" ); ?>"
                    <?php echo ( ( $iie || $iee ) ? "class='input_error'" : "" ); ?> required>
            <?php echo ( ($iie) ? "<div></div><span class='bloqueado'><b>Formato código ISBN incorrecto.</b></span>" : "" ); ?>
            <?php echo ( ($iee) ? "<div></div><span class='bloqueado'><b>Libro con ISBN ya registrado.</b></span>" : "" ); ?>
        </div>
        <div class="col2">Editorial: <input type='text' name='editorial' value="<?php echo ( ( isset($_POST['add_libro']) ) ? $_POST['editorial'] : "" ); ?>"></div>
        <div class="col2">Año de publicación: <input type='date' name='anno_publicacion' value="<?php echo ( ( isset($_POST['add_libro']) ) ? $_POST['anno_publicacion'] : "" ); ?>"><br/>
        <input type='submit' value='Añadir' name='add_libro'>
    </form>
</div>
