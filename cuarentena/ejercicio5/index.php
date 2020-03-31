<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="css/style.css"> -->
    <title>Barcos</title>
</head>
<body>
    <?php
        /**
         * 
         */
        include "resources/funciones.php";

        $tablero = generaTablero();
        imprimeTablero($tablero);

        echo "<br/><a href="."verCodigo.php?src=".str_replace("&bsol;","",__FILE__)." target='_blank'><button>Ver código index</button></a>";
        echo "<br/><a href="."verCodigo.php?src=".str_replace("&bsol;","","resources/funciones.php")." target='_blank'><button>Ver código funciones.php</button></a>";
    ?>
</body>
</html>