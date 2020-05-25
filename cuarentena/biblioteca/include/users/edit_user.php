<div>
    <h3>Editar perfil</h3>
</div>
<div>
    
</div>
<div class="add_editar">
    <div class="ficha_prestamo h90">
        <img src="<?php echo "img/users/".( $_SESSION['user']['img'] == NULL ? "0.png" : $_SESSION['user']['img'] ) ?>" class="img_perfil">
        <form action="privado.php" method="post" class="w55">
            <div class="col2">Cambiar foto: <input type='file' name='img'></div>
            <div class="col2">
                Nick: <input type='text' name='user' value="<?php echo ( isset($_POST['up_perfil']) ? $_POST['user'] : $_SESSION['user']['user'] ); ?>"
                        class="<?php echo ( $uee ? "input_error" : "" ); ?>" disabled>
                <div></div><span class='bloqueado'><b>
                    <?php echo ( $uee ? "El nick no está disponible" : "" ); ?>
                </b></span>
            </div>
            <div class="col2">Nombre: <input type='text' name='nombre' value="<?php echo ( isset($_POST['up_perfil']) ? $_POST['nombre'] : $_SESSION['user']['nombre'] ); ?>" required></div>
            <div class="col2">Apellidos: <input type='text' name='apellidos' value="<?php echo ( isset($_POST['up_perfil']) ? $_POST['apellidos'] : $_SESSION['user']['apellidos'] ); ?>" required></div>
            <div class="col2">
                DNI: <input type='text' name='dni' value="<?php echo ( isset($_POST['up_perfil']) ? $_POST['dni'] : $_SESSION['user']['dni'] ); ?>" 
                        class="<?php echo ( $die || $dee ? "input_error" : "" ); ?>" required>
                <div></div><span class='bloqueado'><b>
                    <?php echo ( $die ? "DNI inválido." : "" ); ?>
                    <?php echo ( $dee ? "Ya posees una cuenta registrada a este DNI" : "" ); ?>
                </b></span>
            </div>
            <div class="col2">Telefono de contacto: <input type='text' name='telefono' value="<?php echo ( ( isset($_POST['up_perfil']) ) ? $_POST['telefono'] : $_SESSION['user']['telefono'] ); ?>" required></div>
            <div class="col2">Email: <input type='email' name='email' value="<?php echo ( ( isset($_POST['up_perfil']) ) ? $_POST['email'] : $_SESSION['user']['email'] ); ?>" required></div>
            <div class="col2">
                <input type='submit' value='Cambiar contraseña' name='ed_pass' class="boton_sq pass">
                <input type='password' name='pass' value="<?php echo ( ( isset($_POST['up_perfil']) ) ? 
                        $_POST['user'] : $_SESSION['user']['pass'] ); ?>" disabled>
            </div>
            <hr class="dashed"/>
            <div class="pie_ficha c2">
                <input type='submit' value='Aceptar' name='up_perfil' class="boton_sq aceptar">
                <a href="privado.php"><button class="boton_sq cancelar">Cancelar</button></a>
            </div>
        </form>
    </div>
    
</div>
