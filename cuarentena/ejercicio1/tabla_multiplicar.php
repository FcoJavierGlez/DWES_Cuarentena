<?php
    function tablasMultiplicar() {
        echo "<table>";
        echo "<tr class='fila negrita'>
            <td></td>
            <td>1</td>
            <td>2</td>
            <td>3</td>
            <td>4</td>
            <td>5</td>
            <td>6</td>
            <td>7</td>
            <td>8</td>
            <td>9</td>
            <td>10</td>
            </tr>";
        for ($i=1; $i<11; $i++) {
            echo "<tr class='fila'>";
            for ($j=0; $j<11; $j++) 
                echo ($j==0) ? "<td class='negrita'>$i</td>" : "<td>".$j*$i."</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Fco Javier González Sabariego">
    <link rel="stylesheet" href="css/tablas.css">
    <title>Tabla de multiplicar 1-10</title>
</head>
<body>
    <?php
        tablasMultiplicar();
        echo "<br/><a href="."verCodigo.php?src=".str_replace("&bsol;","",__FILE__)."><button>Ver código</button></a>";
    ?>
</body>
</html>
