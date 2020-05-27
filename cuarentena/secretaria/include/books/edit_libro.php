<?php
    $_SESSION['id_libro'] = ( !empty($_GET['edit']) ) ? $_GET['edit'] : $_SESSION['id_libro'];
    $libro = $_SESSION['libro']->getID( $_SESSION['id_libro'] );

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
    <div class="ficha_prestamo h90 align_center">
        <form action="<?php echo "libros.php?edit=".$_SESSION['id_libro'] ?>" method="post">
            <div class="col2">Portada: <img src="<?php echo "img/books/".$portada.""; ?>" alt="Portada actual" class='portada'><br/>
                        <input type='file' name='img' value="<?php echo $libro[0]['img']; ?>"></div>
            <div class="col2">Título: <input type='text' name='titulo' value="<?php echo $libro[0]['titulo']; ?>"></div>
            <div class="col2">Autor: <input type='text' name='autor' value="<?php echo $libro[0]['autor'] ?>"></div>
            <div class="col2">
                ISBN: <input type='text' name='isbn' value="<?php echo ( ( isset($_POST['isbn']) ) ? $_POST['isbn'] : $libro[0]['isbn'] )?>"
                        class="<?php echo ( $eiie || $eiee ? "input_error" : "" ) ?>">
                <div></div><span class='bloqueado'><b>
                    <?php echo ( $eiie ? "Formato ISBN incorrecto</b></span>" : "" ) ?>
                    <?php echo ( $eiee ? "<div></div><span class='bloqueado'><b>ISBN ya registrado" : "" ) ?>
                </b></span>
            </div>
            <div class="col2">Editorial: <input type='text' name='editorial' value="<?php echo $libro[0]['editorial'] ?>"></div>
            <div class="col2">Año de publicación: <input type='date' name='anno_publicacion' value="<?php echo $libro[0]['anno_publicacion'] ?>"><br/>
            <input type='number' name='id' value="<?php echo $libro[0]['id'] ?>" hidden>
            <input type='submit' value='Actualizar' name='ed_libro'>
        </form>
    </div>
</div>
