<?php
    $libro = $_SESSION['libro']->getID( $_GET['edit']);

    $portada = ($libro[0]['img'] == null) ? "0.png" : $libro[0]['img'];
?>
<div>
    <h3>Editar libro</h3>
</div>
<div class="filtro">
    <form action=<?php echo $_SERVER['PHP_SELF']; ?> method="post">
        Buscar título:  <input type="text" name="nombre_libro">
        <input type="submit" value="Enviar" name="consulta">
    </form>
</div>
<div class="add_editar">
    <form action="libros.php" method="post">
        <div class="col2">Portada: <img src="<?php echo "img/books/".$portada.""; ?>" alt="Portada actual" class='portada'><br/>
                    <input type='file' name='img' value="<?php echo $libro[0]['img']; ?>"></div>
        <div class="col2">Título: <input type='text' name='titulo' value="<?php echo $libro[0]['titulo']; ?>" required></div>
        <div class="col2">Autor: <input type='text' name='autor' value="<?php echo $libro[0]['autor'] ?>" required></div>
        <div class="col2">ISBN: <input type='text' name='isbn' value="<?php echo $libro[0]['isbn'] ?>" required></div>
        <div class="col2">Editorial: <input type='text' name='editorial' value="<?php echo $libro[0]['editorial'] ?>"></div>
        <div class="col2">Año de publicación: <input type='date' name='anno_publicacion' value="<?php echo $libro[0]['anno_publicacion'] ?>"><br/>
        <input type='number' name='id' value="<?php echo $libro[0]['id'] ?>" hidden>
        <input type='submit' value='Actualizar' name='ed_libro'>
    </form>
</div>
