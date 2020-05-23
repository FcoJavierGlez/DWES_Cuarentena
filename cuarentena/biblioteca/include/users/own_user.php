<div>
    <h3>Mi perfil</h3>
</div>
<div>
    
</div>
<div class="add_editar">
    <div class="ficha_prestamo h90">
        <img src="<?php echo "img/users/".( ( $_SESSION['user']['img'] == NULL ) ? "0.png" : $_SESSION['user']['img'] ) ?>" class="img_perfil">
        <div class="dw55">
            <div class="col2">
                <div>Nick: </div> <div><?php echo $_SESSION['user']['user'] ?></div>
            </div>
            <div class="col2">
                <div>Nombre: </div> <div><?php echo $_SESSION['user']['nombre'] ?></div>
            </div>
            <div class="col2">
                <div>Apellidos: </div> <div><?php echo $_SESSION['user']['apellidos']?></div>
            </div>
            <div class="col2">
                <div>DNI: </div> <div><?php echo $_SESSION['user']['dni'] ?></div>
            </div>
            <div class="col2">
                <div>Telefono de contacto: </div> <div><?php echo $_SESSION['user']['telefono'] ?></div>
            </div>
            <div class="col2">
                <div>Email: </div> <div><?php echo $_SESSION['user']['email'] ?></div>
            </div>
            <div class="col2">
                <div>Contraseña: </div> <div><?php echo imprimePassCensurada( $_SESSION['user']['pass'] ) ?></div>
            </div>
        </div>
        <div class="pie_ficha">
            <a href="privado.php?edit=true"><button class="boton_sq editar">Editar</button></a>
        </div>
    </div>
    
</div>
