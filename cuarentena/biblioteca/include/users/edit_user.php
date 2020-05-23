<div>
    <h3>Editar perfil</h3>
</div>
<div>
    
</div>
<div class="add_editar">
    <div class="ficha_prestamo h90">
        <img src="<?php echo "img/users/".( ( $_SESSION['user']['img'] == NULL ) ? "0.png" : $_SESSION['user']['img'] ) ?>" class="img_perfil">
        <form action="privado.php" method="post" class="w55">
            <div class="col2">Cambiar foto: <input type='file' name='img'></div>
            <div class="col2">
                Nick: <input type='text' name='user' value="<?php echo ( ( isset($_POST['up_perfil']) ) ? $_POST['user'] : $_SESSION['user']['user'] ); ?>"
                        <?php echo ( ( ($uee) ) ? "class='input_error'" : "" ); ?> disabled>
                <?php echo ( ($uee) ? "<div></div><span class='bloqueado'><b>El nick no está disponible</b></span>" : "" ); ?>
            </div>
            <div class="col2">Nombre: <input type='text' name='nombre' value="<?php echo ( ( isset($_POST['up_perfil']) ) ? $_POST['nombre'] : $_SESSION['user']['nombre'] ); ?>" required></div>
            <div class="col2">Apellidos: <input type='text' name='apellidos' value="<?php echo ( ( isset($_POST['up_perfil']) ) ? $_POST['apellidos'] : $_SESSION['user']['apellidos'] ); ?>" required></div>
            <div class="col2">
                DNI: <input type='text' name='dni' value="<?php echo ( ( isset($_POST['up_perfil']) ) ? $_POST['dni'] : $_SESSION['user']['dni'] ); ?>" 
                        <?php echo ( ( ($die || $dee) ) ? "class='input_error'" : "" ); ?> required>
                <?php echo ( ($die) ? "<div></div><span class='bloqueado'><b>DNI inválido.</b></span>" : "" ); ?>
                <?php echo ( ($dee) ? "<div></div><span class='bloqueado'><b>Ya posees una cuenta registrada a este DNI</b></span>" : "" ); ?>
            </div>
            <div class="col2">Telefono de contacto: <input type='text' name='telefono' value="<?php echo ( ( isset($_POST['up_perfil']) ) ? $_POST['telefono'] : $_SESSION['user']['telefono'] ); ?>" required></div>
            <div class="col2">Email: <input type='email' name='email' value="<?php echo ( ( isset($_POST['up_perfil']) ) ? $_POST['email'] : $_SESSION['user']['email'] ); ?>" required></div>
            <div class="col2">
                Contraseña: <input type='password' name='pass' value="<?php echo ( ( isset($_POST['up_perfil']) ) ? $_POST['user'] : $_SESSION['user']['pass'] ); ?>"
                        <?php echo ( ( ($cpe) ) ? "class='input_error'" : "" ); ?> required>
            </div>
            <div class="col2">
                Repetir contraseña: <input type='password' name='pass2' value="<?php echo ( ( isset($_POST['up_perfil']) ) ? $_POST['user'] : $_SESSION['user']['pass'] ); ?>"
                        <?php echo ( ( ($cpe) ) ? "class='input_error'" : "" ); ?> required>
                <?php echo ( ($cpe) ? "<div></div><span class='bloqueado'><b>Las contraseñas no coinciden.</b></span>" : "" ); ?>
            </div>
            <hr class="dashed"/>
            <div class="pie_ficha c2">
                <input type='submit' value='Aceptar' name='up_perfil' class="boton_sq aceptar">
                <!-- <input type='submit' value='Cancelar' name='cancelar' class="boton_sq cancelar"> -->
                <a href="privado.php"><button class="boton_sq cancelar">Cancelar</button></a>
            </div>
        </form>
    </div>
    
</div>
