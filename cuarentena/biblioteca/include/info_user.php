<div>
    <h3>Listado de usuarios</h3>

</div>
<div class="filtro">
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        Buscar usuario:  <input type="text" name="nombre_libro">
        <input type="submit" value="Enviar" name="consulta">
    </form>
</div>
<div class="listado">
    <?php
        //incluir aquí función
    ?>
</div>