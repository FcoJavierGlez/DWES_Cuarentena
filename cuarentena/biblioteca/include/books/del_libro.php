<?php
    $libro = $_SESSION['libro']->getID( $_GET['del']);

    $portada = ($libro[0]['img'] == null) ? "0.png" : $libro[0]['img'];
?>
<div>
    <h3>Eliminar libro</h3>
</div>
<div class="filtro">
    <form action=<?php echo $_SERVER['PHP_SELF']; ?> method="post">
        Buscar libro:  <input type="text" name="nombre_libro">
        <input type="submit" value="Buscar" name="consulta"  class="boton_sq editar">
    </form>
</div>
<div class="add_editar">
    <div class="alert">
        <h3>¡ATENCIÓN!</h3>
        <h4>Estás a punto de eliminar este libro:</h4>
        <div class="col2"><div>Portada: </div><img src="<?php echo "img/books/".$portada.""; ?>" alt="Portada actual" class='portada'></div>
        <div class="col2"><div>Título: </div><?php echo $libro[0]['titulo']; ?></div>
        <div class="col2"><div>Autor: </div><?php echo $libro[0]['autor'] ?></div>
        <div class="col2"><div>ISBN: </div><?php echo $libro[0]['isbn'] ?></div>
        <div class="col2"><div>Editorial: </div><?php echo $libro[0]['editorial'] ?></div>
        <div class="col2"><div>Año de publicación: </div><?php echo $libro[0]['anno_publicacion'] ?></div>
        <div></div>
        <div class="opciones">
            ¿Deseas continuar?
            <form action="libros.php" method="post">
                <input type="text" name="id" value="<?php echo $libro[0]['id']; ?>" hidden>
                <input type='submit' value='Aceptar' name='delete_libro' class="boton_sq aceptar">
                <input type='submit' value='Cancelar' name=''  class="boton_sq cancelar">
            </form>
        </div>
    </div>
</div>
