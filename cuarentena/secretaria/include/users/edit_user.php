<?php
    if ( !isset( $_SESSION['user'] ) || $_SESSION['user']['estado'] !== "activo" ) {
        header('Location:index.php');
    }
?>
<div>
    <h3>Editar perfil</h3>
</div>
<div>
    
</div>
<div class="add_editar">
    <div class="ficha_prestamo h90">
        <div class="foto_claves">
            <img src="img/users/0.png" class="img_perfil">
            <div></div>
        </div>
        <form action="index.php?edit_perfil" method="post" class="w55">
            <div class="col2">
                Nick: <input type='text' name='nick' value="<?php echo $_SESSION['user']['nick'] ?>"
                        class="<?php echo ( $nickExist ? "input_error" : "" ); ?>" disabled>
                <div></div><span class='bloqueado'><b>
                    <?php echo ( $nickExist ? "El nick no está disponible" : "" ); ?>
                </b></span>
            </div>
            <div class="col2">Nombre: <input type='text' name='nombre' value="<?php echo ( isset($_POST['up_perfil']) ? $_POST['nombre'] : $_SESSION['user']['nombre'] ); ?>" required></div>
            <div class="col2">Apellidos: <input type='text' name='apellidos' value="<?php echo ( isset($_POST['up_perfil']) ? $_POST['apellidos'] : $_SESSION['user']['apellidos'] ); ?>" required></div>
            <!-- <div class="col2">Telefono de contacto: <input type='text' name='telefono' value="<?php echo ( ( isset($_POST['up_perfil']) ) ? $_POST['telefono'] : $_SESSION['user']['telefono'] ); ?>" required></div> -->
            <div class="col2">
                Email: <input type='text' name='email' value="<?php echo ( isset($_POST['up_perfil']) ? $_POST['email'] : $_SESSION['user']['email'] ); ?>" 
                        class="<?php echo ( $mailInvalido || $mailExistente  ? "input_error" : "" ); ?>" required>
                <div></div><span class='bloqueado'><b>
                    <?php echo ( $mailInvalido ? "Formato incorrecto" : "" ); ?>
                    <?php echo ( $mailExistente ? "Mail ya registrado" : "" ); ?>
                </b></span>
            </div>
            <div class="col2">
                <input type='submit' value='Cambiar contraseña' name='ed_pass' class="boton_sq pass">
                <input type='password' name='pass' value="<?php echo imprimePassCensurada( $_SESSION['user']['pass'] )?>" disabled>
            </div>
            <hr class="dashed"/>
            <div class="pie_ficha c2">
                <input type='submit' value='Aceptar' name='up_perfil' class="boton_sq aceptar">
                <input type='submit' value='Cancelar' name='cancel_up_perfil' class="boton_sq cancelar">
            </div>
        </form>
    </div>
    
</div>
