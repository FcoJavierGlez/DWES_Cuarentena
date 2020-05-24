<div>
    <h3>Editar contraseña</h3>
</div>
<div>
    
</div>
<div class="add_editar">
    <div class="ficha_prestamo h90">
        <img src="<?php echo "img/users/".( ( $_SESSION['user']['img'] == NULL ) ? "0.png" : $_SESSION['user']['img'] ) ?>" class="img_perfil">
        <form action="privado.php" method="post" class="w55">
            
            <div class="col2">
                Inserte la contraseña actual: <input type='password' name='old_pass' value=""
                        <?php echo ( ( ($ope || $cve) ) ? "class='input_error'" : "" ); ?> >
                <?php echo ( ( ($ope) ) ? "<div></div><span class='bloqueado'><b>Contraseña incorrecta</b></span>" : "" ); ?>
            </div>
            <div class="col2">
                Inserte la nueva contraseña: <input type='password' name='new_pass' value=""
                        <?php echo ( ( ($cpe || $cve) ) ? "class='input_error'" : "" ); ?> >
            </div>
            <div class="col2">
                Repita la nueva contraseña: <input type='password' name='new_pass2' value=""
                        <?php echo ( ( ($cpe || $cve) ) ? "class='input_error'" : "" ); ?> >
                <?php echo ( ( ($cpe) ) ? "<div></div><span class='bloqueado'><b>Nueva contraseña y check no coinciden</b></span>" : "" ); ?>
                <?php echo ( ( ($cve) ) ? "<div></div><span class='bloqueado'><b>No pueden haber campos vacíos.</b></span>" : "" ); ?>
            </div>
            
            <hr class="dashed"/>
            <div class="pie_ficha c2">
                <input type='submit' value='Aceptar' name='change_pass' class="boton_sq aceptar">
                <input type='submit' value='Cancelar' name='cancel_pass' class="boton_sq cancelar">
            </div>
        </form>
    </div>
    
</div>
