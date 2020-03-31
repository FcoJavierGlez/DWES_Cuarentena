<?php
    /**
     * 
     */
    include "class/Tablero.php";

    if (isset($_POST['enviar'])) {
        if ($_POST['fila']<11 && $_POST['fila']>0 && $_POST['columna']<11 && $_POST['columna']>0) {
            $tablero = new Tablero();

            for ($i=0; $i<sizeof(LONGITUD_BARCOS); $i++) { 
                do {
                    $fila = rand(0,9);
                    $columna = rand(0,9);
        
                    $sentido = rand(0,3);
                    
                    try {
                        $tablero->addBarco($fila,$columna,LONGITUD_BARCOS[$i],$sentido);
                        $ubicarBarco = false;
                    } catch (Exception $e) {
                        $ubicarBarco = true;
                    }
                } while ($ubicarBarco);
            }
        
            $tablero->imprimir();

            echo "<b>".(($tablero->getValor($_POST['fila'],$_POST['columna'])==0) ? "Agua" : "Tocado")."</b>";
        } else
            echo "Coordenadas inválidas. Fila y columna no deben ser mayor de 10 o menor de 1.";
    } else
        header('Location: index3.php');
?>