<?php
    /**
     * 
     */
    include "class/Tablero.php";
    include "resources/funciones.php";

    session_start();

    if (!isset($_SESSION['tablero'])) {
        $_SESSION['tablero'] = new Tablero();   //Creamos el objeto tablero
        $_SESSION['mensajes'] = "";             //Mensaje de barcos hundidos;
        $_SESSION['submarinosHundidos'] = 0;    //Mensaje de barcos hundidos;
        $_SESSION['acorazadosHundidos'] = 0;    //Mensaje de barcos hundidos;
        $_SESSION['destructoresHundidos'] = 0;  //Mensaje de barcos hundidos;
        $_SESSION['portaavionesHundidos'] = 0;  //Mensaje de barcos hundidos;
        for ($i=1; $i<11; $i++) {               //Añadimos los barcos en posiciones válidas
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
        <div class="github">
            <b>El siguiente botón conduce al repositorio de GitHub:</b>
            <a href="https://github.com/FcoJavierGlez/DWES_Cuarentena/tree/barcosVerFinal/cuarentena/ejercicio5" target="_blank">
                <button>Ver código</button>
            </a>
        </div>
        <div class="juego">
            <div class="tablero">
                <?php
                    //Tablero de juego
                    $_SESSION['tablero']->imprTabVis($_SESSION['tablero']->finDePartida());
                    //$_SESSION['tablero']->imprimir();

                    echo "<form action='index.php' method='post'>";
                    echo "<input type='submit' name='borrar' value='Nueva partida'>";
                    echo "</form>";
                ?>
            </div>
            <div class="informacion">
                <div class="mensaje">
                    <h4>Mensaje:</h4>
                    <?php echo $_SESSION['mensajes']; ?>
                </div>
                <div class="barcos_hundidos">
                    <h4>Total barcos hundidos:</h4>
                    <?php 
                        echo "<table>";
                        echo "<tr><td>Submarinos</td><td>x".$_SESSION['submarinosHundidos']."</td></tr>";
                        echo "<tr><td>Acorazados</td><td>x".$_SESSION['acorazadosHundidos']."</td></tr>";
                        echo "<tr><td>Destructures</td><td>x".$_SESSION['destructoresHundidos']."</td></tr>";
                        echo "<tr><td>Portaaviones</td><td>x".$_SESSION['portaavionesHundidos']."</td></tr>";
                        echo "</table>";
                    ?>
                </div>
            </div>
        </div>
        
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