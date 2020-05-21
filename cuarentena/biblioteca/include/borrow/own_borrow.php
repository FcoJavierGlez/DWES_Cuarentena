<?php

    /* 
        Consulta que devuelve todos los préstamos activos de un usuario:

        SELECT L.* FROM bi_libros L, bi_prestamos P, bi_users U 
        WHERE P.id_libro = L.id and P.id_user = U.id_user and P.devuelto is null and U.id_user = 2 
    
    */

    /* 
        Historial de préstamos de un usuario:

        SELECT L.* FROM bi_libros L, bi_prestamos P, bi_users U 
        WHERE P.id_libro = L.id and P.id_user = U.id_user and U.id_user = 1
    */
?>
<div>
    <h3>Mis préstamos</h3>
</div>
<div class="filtro">
    <!-- <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        Buscar por ID préstamo o ISBN:  <input type="text" name="busq_prestamo">
        <input type="submit" value="Enviar" name="consulta">
    </form> -->
</div>
<div class="listado">
    <?php
        /* if ( isset($_POST['consulta']) )
            imprimeFichaPrestamos( $_SESSION['prestamo']->get( limpiarDatos($_POST['busq_prestamo']) ) );
        else
            imprimeFichaPrestamos( $_SESSION['prestamo']->get() ); */
        /* echo "ID = 3: ".$_SESSION['prestamo']->getDisponible( 3 )[0]['COUNT(id_libro)']."<br/>"; //Devuelve 0 reservas
        echo "ID = 5: ".$_SESSION['prestamo']->getDisponible( 5 )[0]['COUNT(id_libro)'];         //Devuelve 1 reservas */
        
    ?>
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
        <div class='pie_ficha'>
            <!-- <div><a href='#'><button class='boton_sq aceptar'>Solicitar préstamo</button></a></div> -->
        </div>
    </div>
</div>