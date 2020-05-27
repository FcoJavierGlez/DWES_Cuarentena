<div>
    <h3>Registrarse</h3>
</div>
<div>

</div>
<div class="add_editar">
    <form action="index.php?register" method="POST" class="registro w55 h70">
        <div class="col2">
            Nick: <input type='text' name='nick' value="<?php echo ( isset($_POST['add_user']) ? $_POST['nick'] : "" ); ?>"
                    class="<?php echo ( $addNickExist  ? "input_error" : "" ); ?>" required>
            <div></div><span class='bloqueado'><b>
                <?php echo ( $addNickExist ? "El nick no está disponible" : "" ); ?>
            </b></span>
        </div>
        <div class="col2">
            Contraseña: <input type='password' name='pass' value="" class="<?php echo ( $checkPassError ? "input_error" : "" ) ?>" required>
        </div>
        <div class="col2">
            Repetir contraseña: <input type='password' name='pass2' value=""
                    class="<?php echo ( $checkPassError ? "input_error" : "" ) ?>" required>
            <div></div><span class='bloqueado'><b>
                <?php echo ( $checkPassError ? "Las contraseñas no coinciden." : "" ); ?>
            </b></span>
        </div>
        <div class="col2">Nombre: <input type='text' name='nombre' value="<?php echo ( ( isset($_POST['add_user']) ) ? $_POST['nombre'] : "" ); ?>" required></div>
        <div class="col2">Apellidos: <input type='text' name='apellidos' value="<?php echo ( isset($_POST['add_user']) ? $_POST['apellidos'] : "" ); ?>" required></div>
        <div class="col2">
            Email: <input type='email' name='email' value="<?php echo ( isset($_POST['add_user']) ? $_POST['email'] : "" ); ?>" required>
        </div>
        <!-- <div class="col2">
            DNI: <input type='text' name='dni' value="<?php echo ( isset($_POST['add_user']) ? $_POST['dni'] : "" ); ?>" 
                    class="<?php echo ( $die || $dee ? "input_error" : "" ) ?>" required>
            <div></div><span class='bloqueado'><b>
                <?php echo ( $die ? "DNI inválido." : "" ); ?>
                <?php echo ( $dee ? "Ya posees una cuenta registrada a este DNI" : "" ); ?>
            </b></span>
        </div> -->
        <!-- <div class="col2">Telefono de contacto: <input type='text' name='telefono' value="<?php echo ( isset($_POST['add_user']) ? $_POST['telefono'] : "" ); ?>" required></div> -->
        <hr class="dashed"/>
        <div class="pie_ficha">
            <input type='submit' value='Registrarse' name='add_user' class="boton_sq aceptar">
        </div>
    </form>
</div>
