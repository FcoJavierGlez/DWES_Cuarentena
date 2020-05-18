<div>
    <h3>Registrarse</h3>
</div>
<div class="center">
    <a href="index.php"><button>Volver a Home</button></a>
</div>
<div class="add_editar">
    <form action="register.php" method="post">
        <div class="col2">Foto: <input type='file' name='img'></div>
        <div class="col2">Nick: <input type='text' name='user' value="" required></div>
        <div class="col2">Contraseña: <input type='password' name='pass' value="" required></div>
        <div class="col2">Repetir contraseña: <input type='password' name='pass2' value="" required></div>
        <div class="col2">Nombre: <input type='text' name='nombre' value="" required></div>
        <div class="col2">Apellidos: <input type='text' name='apellidos' value="" required></div>
        <div class="col2">Telefono de contacto: <input type='text' name='telefono' value="" required></div>
        <div class="col2">Email: <input type='email' name='email' value="" required></div>
        <input type='submit' value='Registrarse' name='add_user'>
    </form>
</div>
