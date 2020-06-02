<?php
    if ( !isset($_SESSION['user']) || !( $_SESSION['user']['perfil'] == "user" && $_SESSION['user']['estado'] == "activo" ) ) {
        header('Location:index.php');
    }

    $documento = $_SESSION['documento']->getDocumentTosign( $_GET['firmar'], $_SESSION['user']['id'] );

    $fil1 = rand(0, 7);
    $col1 = rand(0, 7);
    $fil2 = rand(0, 7);
    $col2 = rand(0, 7);
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
    <div class="ficha_prestamo h90">
        <h4>Está a punto de firmar el siguiente documento:</h4>
        <?php
            imprimeFichaDocumento( $documento );
        ?>
        <form action="index.php?documentos" method="post">
            <?php
                if ( sizeof($documento) ) {
                    echo "<h4>Para firmarlo deberá utilizar su clave de firmas personal.</h4>";
                    echo "Introduzca el valor en ".($col1+1).getLetterFromRow( $fil1 ).": 
                            <input type='text' value='' name="."input[".$fil1."][".$col1."]"."><br/>";
                    echo "Introduzca el valor en ".($col2+1).getLetterFromRow( $fil2 ).": 
                            <input type='text' value='' name="."input[".$fil2."][".$col2."]"."><br/>";
                } else {
                    echo "<b><span class='bloqueado justify_center'>SOLICITUD DENEGADA.</span></b><br/>";
                    echo "<b><span class='bloqueado'>No posee ningún documento de éstas características.</span></b>";
                }
            ?>
            <input type="hidden" name="fecha" value="<?php echo date("Y-m-d") ?>">
            <input type="hidden" name="hora" value="<?php echo date("H:i:s") ?>">
            <input type="hidden" name="idFichero" value="<?php echo $_GET['firmar'] ?>">
            <?php
                if ( sizeof($documento) ) {
                    echo "<div class='pie_ficha c2'>";
                        echo "<input type='submit' value='Aceptar' name='sign' class='boton_sq aceptar'>";
                        echo "<input type='submit' value='Cancelar' name='' class='boton_sq cancelar'>";
                    echo "</div>";
                }
            ?>
        </form>
    </div>
</div>