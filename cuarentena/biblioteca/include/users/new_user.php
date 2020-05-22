<div>
    <h3>Registrarse</h3>
</div>
<div>

</div>
<div class="add_editar">
    <form action="register.php" method="post" class="registro">
        <div class="col2">Foto: <input type='file' name='img'></div>
        <div class="col2">
            Nick: <input type='text' name='user' value="<?php echo ( ( isset($_POST['add_user']) ) ? $_POST['user'] : "" ); ?>"
                    <?php echo ( ( ($uee) ) ? "class='input_error'" : "" ); ?> required>
            <?php echo ( ($uee) ? "<div></div><span class='bloqueado'><b>El nick no está disponible</b></span>" : "" ); ?>
        </div>
        <div class="col2">
            Contraseña: <input type='password' name='pass' value=""
                    <?php echo ( ( ($cpe) ) ? "class='input_error'" : "" ); ?> required>
        </div>
        <div class="col2">
            Repetir contraseña: <input type='password' name='pass2' value=""
                    <?php echo ( ( ($cpe) ) ? "class='input_error'" : "" ); ?> required>
            <?php echo ( ($cpe) ? "<div></div><span class='bloqueado'><b>Las contraseñas no coinciden.</b></span>" : "" ); ?>
        </div>
        <div class="col2">Nombre: <input type='text' name='nombre' value="<?php echo ( ( isset($_POST['add_user']) ) ? $_POST['nombre'] : "" ); ?>" required></div>
        <div class="col2">Apellidos: <input type='text' name='apellidos' value="<?php echo ( ( isset($_POST['add_user']) ) ? $_POST['apellidos'] : "" ); ?>" required></div>
        <div class="col2">
            DNI: <input type='text' name='dni' value="<?php echo ( ( isset($_POST['add_user']) ) ? $_POST['dni'] : "" ); ?>" 
                    <?php echo ( ( ($die || $dee) ) ? "class='input_error'" : "" ); ?> required>
            <?php echo ( ($die) ? "<div></div><span class='bloqueado'><b>DNI inválido.</b></span>" : "" ); ?>
            <?php echo ( ($dee) ? "<div></div><span class='bloqueado'><b>Ya posees una cuenta registrada a este DNI</b></span>" : "" ); ?>
        </div>
        <div class="col2">Telefono de contacto: <input type='text' name='telefono' value="<?php echo ( ( isset($_POST['add_user']) ) ? $_POST['telefono'] : "" ); ?>" required></div>
        <div class="col2">Email: <input type='email' name='email' value="<?php echo ( ( isset($_POST['add_user']) ) ? $_POST['email'] : "" ); ?>" required></div>
        <hr class="dashed"/>
        <div class="pie_ficha">
            <input type='submit' value='Registrarse' name='add_user' class="boton_sq aceptar">
        </div>
    </form>
</div>
