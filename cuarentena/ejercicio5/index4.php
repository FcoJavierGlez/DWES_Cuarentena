<?php
    /**
     * 
     */
    include "class/Tablero.php";
    include "resources/funcionesIndex4.php";

    session_start();

    if (!isset($_SESSION['tablero'])) {
        $_SESSION['tablero'] = new Tablero();   //Creamos el objeto tablero

        for ($i=1; $i<11; $i++) { //Añadimos los barcos en posiciones válidas
            do {
                $fila = rand(0,9);
                $columna = rand(0,9);
    
                $sentido = rand(0,3);
                
                try {
                    $_SESSION['tablero']->addBarco($fila,$columna,longitudBarco($i),$sentido);
                    $ubicarBarco = false;
                } catch (Exception $e) {
                    $ubicarBarco = true;
                }
            } while ($ubicarBarco);
        }
    }

    if (isset($_POST['borrar'])) {
        cerrarSesion();
    }

    if (isset($_GET['fila'])) {
        $_SESSION['tablero']->impacto($_GET['fila'],$_GET['columna']);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Barcos formulario</title>
</head>
<body>
    <header>
        <h1>Hundir la flota</h1>
    </header>
    <main>
        <?php
            //impresión tablero vacío

            $_SESSION['tablero']->imprTabVis();
            //$_SESSION['tablero']->imprimir();

            echo "<form action='index4.php' method='post'>";
            echo "<input type='submit' name='borrar' value='Nueva partida'>";
            echo "</form>";

            echo "<br/><a href="."verCodigo.php?src=".str_replace("&bsol;","",__FILE__)." target='_blank'><button>Ver código index</button></a>";
            echo "<br/><a href="."verCodigo.php?src=".str_replace("&bsol;","","class/Tablero.php")." target='_blank'><button>Ver código Tablero.php</button></a>";
            echo "<br/><a href="."verCodigo.php?src=".str_replace("&bsol;","","class/Barco.php")." target='_blank'><button>Ver código Barco.php</button></a>";    
            echo "<br/><a href="."verCodigo.php?src=".str_replace("&bsol;","","procesa.php")." target='_blank'><button>Ver código procesa.php</button></a>";    
        ?>
    </main>
    <footer>
        <h4>RRSS del autor:</h4>
        <div class="rrss">
            <a href="https://twitter.com/Fco_Javier_Glez" target="_blank"><img src="img/twitter.png" alt="Enlace a cuenta de Twitter del autor"></a>
            <a href="https://github.com/FcoJavierGlez" target="_blank"><img src="img/github.png" alt="Enlace a cuenta de GitHub del autor"></a>
            <a href="https://www.linkedin.com/in/francisco-javier-gonz%C3%A1lez-sabariego-51052a175/" target="_blank"><img src="img/linkedin.png" alt="Enlace a cuenta de Linkedin del autor"></a>
        </div>
    </footer>
</body>
</html>