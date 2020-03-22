<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Resultados NBA</title>
</head>
<body>
    <?php
        include "resources/datos.php";
        include "resources/funciones.php";

        imprimeTabla(RESULTADOS);
    ?>
</body>
</html>