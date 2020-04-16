<?php
    /**
     * 
     */

    include "resource/codigo_svg.php";

    function tiradaDados($numDados) {
        $contador = 0;
        for ($i=0; $i<$numDados; $i++) { 
            $random = rand(1,6);
            echo DADOS[$random-1];
            $contador += $random;
        }
        echo "<br/>Puntuación total: $contador";
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/dados.css">
    <title>Dados</title>
</head>
<body>
    <?php
        tiradaDados(3);
        echo "<br/><a href="."verCodigo.php?src=".str_replace("&bsol;","",__FILE__)."><button>Ver código</button></a>";
    ?>
</body>
</html>