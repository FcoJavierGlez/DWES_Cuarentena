<div>
    <h3>Reservar</h3>
</div>
<div class="filtro">
    <!-- <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        Buscar por ID préstamo o ISBN:  <input type="text" name="busq_prestamo">
        <input type="submit" value="Enviar" name="consulta">
    </form> -->
</div>
<div class="add_editar">
    <?php
        /* if ( isset($_POST['consulta']) )
            imprimeFichaPrestamos( $_SESSION['prestamo']->get( limpiarDatos($_POST['busq_prestamo']) ) );
        else
            imprimeFichaPrestamos( $_SESSION['prestamo']->get() ); */
        /* echo "ID = 3: ".$_SESSION['prestamo']->getDisponible( 3 )[0]['COUNT(id_libro)']."<br/>"; //Devuelve 0 reservas
        echo "ID = 5: ".$_SESSION['prestamo']->getDisponible( 5 )[0]['COUNT(id_libro)'];         //Devuelve 1 reservas */
        
    ?>
    <h3>Está a punto de solicitar en préstamo este libro:</h3>
    <div class='ficha_prestamo'>
        <h3>Ficha de libro</h3>
        <div class='ficha_pres_libro'>
            <img src='img/books/0.png'>
            <div class='info_prestamo w100'>
                <div><b>Título:</b></div> <div>titulo</div>
                <div><b>Autor:</b></div> <div>autor</div>
                <div><b>ISBN:</b></div> <div>isbn</div>
                <div><b>Editorial:</b></div> <div>editorial</div>
            </div>
        </div>
    </div>
    <form action="prestamos.php" method="post">
        ¿Desea realizar la solicitud? <input type="submit" value="Aceptar" name="solicitar" class=" boton_sq aceptar"> 
                                        <input type="submit" value="Cancelar" class=" boton_sq cancelar">
    </form>
</div>