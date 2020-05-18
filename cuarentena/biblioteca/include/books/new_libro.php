<div>
    <h3>Añadir libro</h3>
</div>
<div class="filtro">
    <form action="libros.php" method="post">
        Buscar título:  <input type="text" name="nombre_libro">
        <input type="submit" value="Enviar" name="consulta">
    </form>
</div>
<div class="add_editar">
    <form action="add_libro.php" method="post">
        <div class="col2">Portada: <input type='file' name='img'></div>
        <div class="col2">Título: <input type='text' name='titulo' value="" required></div>
        <div class="col2">Autor: <input type='text' name='autor' value="" required></div>
        <div class="col2">ISBN: <input type='text' name='isbn' value="" required></div>
        <div class="col2">Editorial: <input type='text' name='editorial' value=""></div>
        <div class="col2">Año de publicación: <input type='date' name='anno_publicacion' value=""><br/>
        <input type='submit' value='Añadir' name='add_libro'>
    </form>
</div>
