<?php
    /**
     * 
     */
    include "class/Serie.php";
    include "resource/funciones.php";

    session_start();
    
    //Destruimos la sesión:
    if (isset($_POST['borrar'])) {
        session_unset();
        session_destroy();
        session_start();
        session_regenerate_id();
        header('Location:index.php');
    }

    //Si las variables de sesión de no existen las creamos:
    if (!isset($_SESSION['series'])) {
        $_SESSION['series'] = [];            //No hay registro de series
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Series</title>
</head>
<body>
    <?php
        formRegistro();
    
        if (isset($_POST['enviar'])) {
            if (!empty($_POST['nombre'])) {
                array_push($_SESSION['series'], new Serie(limpiarDatos($_POST['nombre']),$_POST['plataformas'],$_POST['temporadas'],
                    $_POST['lanzamiento'],$_POST['idiomas'],$_POST['edad']));
            } /* else {} */
        }

        if (!empty($_SESSION['series'])) {
            imprimeSeries();
            borrar();
        }
    ?>
</body>
</html>