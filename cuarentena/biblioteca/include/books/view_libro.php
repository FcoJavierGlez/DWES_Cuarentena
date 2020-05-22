<?php
    if (isset($_GET['view']) ) $libro = $_SESSION['libro']->getID( $_GET['view'] );
?>
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
    <div class='ficha_prestamo'>
        <div class='ficha_pres_libro'>
            <img src="<?php echo "img/books/".( ($libro[0]['img'] == null) ? "0.png" : $libro[0]['img'] );?>">
            <div class='info_prestamo w100'>
                <div><b>Título:</b></div> <div> <?php echo $libro[0]['titulo'] ?> </div>
                <div><b>Autor:</b></div> <div> <?php echo $libro[0]['autor'] ?> </div>
                <div><b>ISBN:</b></div> <div> <?php echo $libro[0]['isbn'] ?> </div>
                <div><b>Editorial:</b></div> <div> <?php echo $libro[0]['editorial'] ?> </div>
                <div><b>Año publicación:</b></div> <div> <?php echo ( ($libro[0]['anno_publicacion'] == null) ? "N/D" : $libro[0]['anno_publicacion']) ?> </div>
            </div>
        </div>
        <div><a href="<?php echo "libros.php?del=".$libro[0]['id'] ?>"><button class="boton_sq cancelar">Eliminar libro</button></a></div>
    </div>
</div>