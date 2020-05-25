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
    <div class="ficha_prestamo h90 align_center">
        <form action="libros.php?add" method="post">
            <div class="col2">Portada: <input type='file' name='img'></div>
            <div class="col2">Título: <input type='text' name='titulo' value="<?php echo ( ( isset($_POST['add_libro']) ) ? $_POST['titulo'] : "" ); ?>" required></div>
            <div class="col2">Autor: <input type='text' name='autor' value="<?php echo ( ( isset($_POST['add_libro']) ) ? $_POST['autor'] : "" ); ?>" required></div>
            <div class="col2">
                ISBN: <input type='text' name='isbn' value="<?php echo ( ( isset($_POST['add_libro']) ) ? $_POST['isbn'] : "" ); ?>"
                        class="<?php echo ( $eiie || $eiee ? "input_error" : "" ) ?>" required>
                <div></div><span class='bloqueado'><b>
                    <?php echo ( $aiie ? "Formato código ISBN incorrecto." : "" ); ?>
                    <?php echo ( $aiee ? "Libro con ISBN ya registrado." : "" ); ?>
                </b></span>
            </div>
            <div class="col2">Editorial: <input type='text' name='editorial' value="<?php echo ( ( isset($_POST['add_libro']) ) ? $_POST['editorial'] : "" ); ?>"></div>
            <div class="col2">Año de publicación: <input type='date' name='anno_publicacion' value="<?php echo ( ( isset($_POST['add_libro']) ) ? $_POST['anno_publicacion'] : "" ); ?>"><br/>
            <input type='submit' value='Añadir' name='add_libro'>
        </form>
    </div>
</div>
