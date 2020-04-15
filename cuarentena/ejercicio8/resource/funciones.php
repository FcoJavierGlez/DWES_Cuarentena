<?php

    const PLATAFORMAS = array("Netflix","Amazon Prime","HBO","Movistar+","Sky");
    const IDIOMAS = array("English","Français","Deutsch","Español","Portuguese");
    const EDAD = array("TP","+7","+12","+16","18");

    function limpiarDatos($dato) {
        $dato = trim($dato);
        $dato=stripcslashes($dato);
        $dato = htmlspecialchars($dato);
        return $dato;
    }

    function imprimePlataformas() {
        echo "Plataforma: <select name='plataformas'>";
        for ($i=0; $i<sizeof(PLATAFORMAS); $i++) { 
            echo ($i==0) ? 
            "<option value=".PLATAFORMAS[$i]." selected>".PLATAFORMAS[$i]."</option>" : 
            "<option value=".PLATAFORMAS[$i].">".PLATAFORMAS[$i]."</option>";
        }
        echo "</select>";
    }

    function imprimeIdiomas() {
        for ($i=0; $i<sizeof(IDIOMAS); $i++) { 
            echo ($i==0) ? 
            IDIOMAS[$i]."<input type='checkbox' name='idiomas[]' value=".IDIOMAS[$i]." checked>" : 
            IDIOMAS[$i]."<input type='checkbox' name='idiomas[]' value=".IDIOMAS[$i].">";
        }
    }

    function imprimeEdad() {
        for ($i=0; $i<sizeof(EDAD); $i++) { 
            echo ($i==0) ? 
            EDAD[$i]."<input type='radio' name='edad' value=".$i." checked>" : 
            EDAD[$i]."<input type='radio' name='edad' value=".$i.">";
        }
    }

    function formRegistro() {
        echo "<h2>Registro de series:</h2>";
        echo "<form action=".$_SERVER['PHP_SELF']." method='post'>";

        echo "<div class='doble_col'>
            Nombre: <input type='text' name='nombre' value=''>";
            imprimePlataformas();
        echo "Temporadas: <input type='number' name='temporadas' min='1' value='1'>
        Lanzamiento:<input type='date' name='lanzamiento' value=''>
        </div>";

        echo "<div class='doble_col'>";
            imprimeIdiomas();
        echo "</div>";

        echo "<div class='doble_col'>";
            imprimeEdad();
        echo "</div>";

        echo "<input type='submit' name='enviar'>";
        echo "</form>";
    }

    function borrar() {
        echo "<form action=".$_SERVER['PHP_SELF']." method='post'>";
        echo "<input type='submit' name='borrar' value='Borrar'>";
        echo "</form>";
    }

    function imprimeSeries() {
        echo "<h2>Listado de series:</h2>";
        echo "<table>";
        echo "<tr><td>Nombre</td><td>Plataforma</td><td>Temporadas</td><td>Idiomas</td><td>Edad recomendada</td><td>Fecha de lanzamiento</td></tr>";
        for ($i=0; $i<sizeof($_SESSION['series']); $i++) { 
            echo "<tr>";
            echo "<td>".$_SESSION['series'][$i]->getNombre()."</td>";
            echo "<td>".$_SESSION['series'][$i]->getPlataforma()."</td>";
            echo "<td>".$_SESSION['series'][$i]->getNumTemporadas()."</td>";
            echo "<td>".implode("<br>",$_SESSION['series'][$i]->getIdiomas())."</td>";
            echo "<td>".$_SESSION['series'][$i]->getClasEdad()."</td>";
            echo "<td>".$_SESSION['series'][$i]->getFechaLanzamiento()."</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
?>