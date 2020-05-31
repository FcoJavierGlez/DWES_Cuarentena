<?php
    if ( $_GET['step'] == 2 && $_SESSION['clave']->getCodGenNewKey() == "" ) {  //Generación y envío del código a validar
        $_SESSION['clave']->createCodGenNewKey();
        //Mandar correo con el código de validación
        $mail = $_SESSION['mail']->enviarMail(
            $_SESSION['user']['email'],
            $_SESSION['user']['nombre'],
            "developerdaw86@gmail.com",
            "Administración Secretaría Virtual",
            "Solicitud de nuevo juego de claves",

            "<h1 style='text-align: center;'>Solicitud de nuevo juego de claves</h1>
            
            <p style='text-align: justify;'>Estimado/a ".$_SESSION['user']['nombre']." ".$_SESSION['user']['apellidos'].", 
            ha solicitado la generación de un nuevo juego de claves para la plataforma de la Secretaría Virtual. Ingrese
            el código mostrado a continuación antes de 5 minutos para proceder a generar un nuevo juego de claves:</p>

            <p style='border:2px solid blue;padding: 15px;border-radius: 15px;
                width: 150px;font-size: 30px;text-align: center;'>".$_SESSION['clave']->getCodGenNewKey()."</p>

            <p style='text-align: justify;'><b>Si por el contrario no reconoce esta acción:</b> elimine este correo 
            y cambie inmediatamente la contraseña de acceso a su cuenta de la Secretaría Virtual.</p>",

            NULL    //No hay archivo adjunto en este correo
        );
    }
?>
<div>
    <h3>Generar claves nuevas</h3>
</div>
<div>
    
</div>
<div class="add_editar">
    <div class="ficha_prestamo h90">
        <?php
            if ( $_GET['step'] == 1 ) {                 //Paso 1: Aceptar el inicio de generar claves nuevas
                echo "<div class='col3'><h4>Está a punto de generar un nuevo juego de claves. ¿Desea continuar?</h4>";
                echo "<a href='index.php?step=2'><button class='boton_sq aceptar'>Continuar</button></a>";
                echo "<a href='index.php?perfil'><button class='boton_sq cancelar'>Regresar</button></a></div>";
            }
            elseif ( $_GET['step'] == 2 ) {             //Paso 2: Validación del código enviado por correo
                echo "<form action='index.php' method='post' class='align_center col3'>";
                    echo "Introduzca el código recibido: <input type='text' name='codigo'>  ";
                    echo "<input type='submit' value='Aceptar' name='change_key' class='boton_sq aceptar'>";
                echo "</form>";
            }
            elseif ( $_GET['step'] == "ok" )            //Todo ok
                echo "<div class='col2 align_center'><h4>Solicitud aceptada. En breve le llegará un correo.</h4>
                        <a href='index.php?perfil'><button class='boton_sq editar'>Volver</button></a></div>";
            elseif ( $_GET['step'] == "repeat" ) {      //El código no coincide, opción de reintentar o salir
                echo "<div class='col3'><h4>El código introducido no es correcto. ¿Desea volver a intentarlo?</h4>";
                echo "<a href='index.php?step=2'><button class='boton_sq aceptar'>Sí</button></a>";
                echo "<a href='index.php?perfil'><button class='boton_sq cancelar'>No</button></a></div>";
            }
            elseif ( $_GET['step'] == "error" ) {       //Límite de 5 min excedido
                echo "<div class='col3'><h4 class='bloqueado'>Ha excedido el límite de tiempo. ¿Desea repetir?</h4>";
                echo "<a href='index.php?step=1'><button class='boton_sq aceptar'>Sí</button></a>";
                echo "<a href='index.php?perfil'><button class='boton_sq cancelar'>No</button></a></div>";
            }
        ?>
    </div>
</div>