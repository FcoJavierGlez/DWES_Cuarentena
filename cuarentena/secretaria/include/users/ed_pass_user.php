<div>
    <h3>Editar contraseña</h3>
</div>
<div>
    
</div>
<div class="add_editar">
    <div class="ficha_prestamo h90">
        <div class="foto_claves">
            <img src="img/users/0.png" class="img_perfil">
            <div></div>
        </div>
        <form action="index.php" method="post" class="w55">
            <div class="col2">
                Inserte la contraseña actual: <input type='password' name='old_pass' value="" class="<?php echo ( $oldPassError ? "input_error" : "" ); ?>" >
                <div></div><span class='bloqueado'><b>
                    <?php echo ( $oldPassError ? "Contraseña incorrecta" : "" ) ?>
                </b></span>
            </div>
            <div class="col2">
                Inserte la nueva contraseña: <input type='password' name='new_pass' value="" class="<?php echo ( $checkPassError ? "input_error" : "" ) ?>" >
            </div>
            <div class="col2">
                Repita la nueva contraseña: <input type='password' name='new_pass2' value=""
                        <?php echo ( $checkPassError ? "class='input_error'" : "" ); ?> >
                <div></div><span class='bloqueado'><b>
                    <?php echo ( $checkPassError ? "La nueva contraseña y su validación no coinciden." : "" ); ?>
                </b></span>
            </div>
            <hr class="dashed"/>
            <div class="pie_ficha c2">
                <input type='submit' value='Aceptar' name='change_pass' class="boton_sq aceptar">
                <input type='submit' value='Cancelar' name='cancel_pass' class="boton_sq cancelar">
            </div>
        </form>
    </div>
</div>
