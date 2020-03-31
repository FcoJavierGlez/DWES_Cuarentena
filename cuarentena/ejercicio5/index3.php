<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barcos formulario</title>
</head>
<body>
<h1>Inserte fila y columna</h1>
    <form action="procesa.php" method="post">
        <label for="fila">Fila: <input type="text" name="fila" id="fila"></label>
        <label for="columna">Columna: <input type="text" name="columna" id="columna"></label>
        <input type="submit" name="enviar">
    </form>
    <?php
        echo "<br/><a href="."verCodigo.php?src=".str_replace("&bsol;","",__FILE__)." target='_blank'><button>Ver código index</button></a>";
        echo "<br/><a href="."verCodigo.php?src=".str_replace("&bsol;","","class/Tablero.php")." target='_blank'><button>Ver código Tablero.php</button></a>";
        echo "<br/><a href="."verCodigo.php?src=".str_replace("&bsol;","","class/Barco.php")." target='_blank'><button>Ver código Barco.php</button></a>";    
        echo "<br/><a href="."verCodigo.php?src=".str_replace("&bsol;","","procesa.php")." target='_blank'><button>Ver código procesa.php</button></a>";    
    ?>
</body>
</html>