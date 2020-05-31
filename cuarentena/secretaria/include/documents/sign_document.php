<?php
    if ( !isset($_SESSION['user']) || !( $_SESSION['user']['perfil'] == "user" && $_SESSION['user']['estado'] == "activo" ) ) {
        header('Location:index.php');
    }
?>
<div>
    <h3>Firmar documento</h3>
</div>
<div class="filtro">
    <!-- <form action="index.php?documentos" method="POST">
        Buscar documento:  <input type="text" name="nombre_documento">
        <input type="submit" value="Buscar" name="consulta" class="boton_sq editar">
    </form>  |  <a href="index.php?add_document"><button class="boton_sq aceptar">Nuevo documento</button></a> -->
</div>
<div class="add_editar scroll">
    <div class="ficha_prestamo">
        <h4>Está a punto de firmar el siguiente documento:</h4>
        <?php
            imprimeFichaDocumento( $_SESSION['documento']->getDocumentTosign( $_GET['firmar'], $_SESSION['user']['id'] ) );
        ?>
        <h4>Para firmarlo deberá utilizar su clave de firmas personal.</h4>
        <form action="index.php?documentos" method="post"><!-- echo $_SERVER['PHP_SELF'] -->
            <?php
                $fil1 = rand(0, 7);
                $col1 = rand(0, 7);
                $fil2 = rand(0, 7);
                $col2 = rand(0, 7);
                echo "Introduzca el valor en ".($col1+1).getLetterFromRow( $fil1 ).": 
                        <input type='text' value='' name="."input[".$fil1."][".$col1."]"."><br/>";
                echo "Introduzca el valor en ".($col2+1).getLetterFromRow( $fil2 ).": 
                        <input type='text' value='' name="."input[".$fil2."][".$col2."]"."><br/>";
            ?>
            <input type="hidden" name="fecha" value="<?php echo date("Y-m-d") ?>">
            <input type="hidden" name="hora" value="<?php echo date("H:i:s") ?>">
            <input type="hidden" name="idFichero" value="<?php echo $_GET['firmar'] ?>">
            <div class="pie_ficha c2">
                <input type="submit" value="Aceptar" name="sign" class="boton_sq aceptar">
                <input type="submit" value="Cancelar" name="" class="boton_sq cancelar">
            </div>
        </form>
    </div>
</div>