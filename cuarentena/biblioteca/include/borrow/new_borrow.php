<?php
    if ( isset($_GET['solicitar']) )
        $libro = $_SESSION['libro']->getID( $_GET['solicitar'] );
?>
<div>
    <h3>Reservar</h3>
</div>
<div class="filtro">
    
</div>
<div class="add_editar">
    <h3>Está a punto de solicitar en préstamo este libro:</h3>
    <div class='ficha_prestamo'>
        <h3>Ficha de libro</h3>
        <div class='ficha_pres_libro'>
            <img src="<?php echo "img/books/".( ($libro[0]['img'] == null) ? "0.png" : $libro[0]['img'] ) ?>">
            <div class='info_prestamo w100'>
                <div><b>Título:</b></div> <div><?php echo $libro[0]['titulo'] ?></div>
                <div><b>Autor:</b></div> <div><?php echo $libro[0]['autor'] ?></div>
                <div><b>ISBN:</b></div> <div><?php echo $libro[0]['isbn'] ?></div>
                <div><b>Editorial:</b></div> <div><?php echo $libro[0]['editorial'] ?></div>
            </div>
        </div>
    </div>
    <form action="prestamos.php" method="post">
        <input type="hidden" name="id" value="<?php echo $libro[0]['id'] ?>">
        
        ¿Desea realizar la solicitud? <input type="submit" value="Aceptar" name="solicitar" class=" boton_sq aceptar"> 
                                        <input type="submit" value="Cancelar" class=" boton_sq cancelar">
    </form>
</div>