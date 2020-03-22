<?php
    /**
     * 
     */
    const COLORES = ["red","yellow","green"];

    function semaforo() {
        echo "<table>";
        for ($i=0; $i < sizeof(COLORES); $i++) { 
            echo "<tr>";
            echo "<td>";
                echo "<svg width='100' height='100'>";
                    echo "<circle cx='50' cy='50' r='40' stroke='black' stroke-width='4' fill=".COLORES[$i]." />";
                echo "</svg>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semáforo</title>
</head>
<body>
    <?php
        semaforo();
        echo "<br/><a href="."verCodigo.php?src=".str_replace("&bsol;","",__FILE__)."><button>Ver código</button></a>";
    ?>
</body>
</html>