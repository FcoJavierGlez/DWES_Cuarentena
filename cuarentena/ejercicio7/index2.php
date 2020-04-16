<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/tablas.css">
    <title>Formulario tablas multiplicar</title>
</head>
<body>
    <?php
        /**
         * 
         */
        include "resources/funciones.php";
        
        if (!isset($_POST['enviar'])) {
            imprFormTablas();
        } elseif (isset($_POST['enviar'])) {
            $multiplicandos = $_POST['tablas'];

            $multiplicadores = getMultiplicadores(sizeof($multiplicandos),5);

            echo "<form action='procesa.php' method='post'>";
            tablasMultiplicar($multiplicandos,$multiplicadores);
            echo "<input type='hidden' name='multiplicandos' value=".implode(",",$multiplicandos).">";
            echo "<input type='hidden' name='multiplicadores' value=".implode(",",$multiplicadores).">";
            echo "<input type='submit' name='procesar'>";
            echo "</form>";
        }

        echo "<br/><a href="."verCodigo.php?src=".str_replace("&bsol;","",__FILE__)." target='_blank'><button>Ver código index</button></a>";
        echo "<br/><a href="."verCodigo.php?src=".str_replace("&bsol;","","procesa.php")." target='_blank'><button>Ver código procesa.php</button></a>";
    ?>
</body>
</html>