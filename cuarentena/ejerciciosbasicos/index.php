<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body>
    <header>
        <h1>Ejercicios básicos</h1>
    </header>
    <main>
        <div class="codigo">
            <b>El siguiente botón conduce al código fuente en GitHub:</b>
            <a href="https://github.com/FcoJavierGlez/DWES_Cuarentena/tree/ejerciciosbasicos/cuarentena/ejerciciosbasicos" target="_blank">
                <button>Ver código</button>
            </a>
        </div>
        
        <?php
            /**
             * Crear una clase dni. Utiliza un método para su correcta validación.
             * Escribe una función que determine si un número es primo.
             * Utilizando la funcion anterior crea un array que almacene los primeros 5 números primos
             */
            include "class/DNI.php";
            include "resources/funciones.php";

            $numPrimos = array();

            //Validar DNI y comprobar número primo:
            if (!isset($_POST['enviar'])) {             //Formulario inicial, sin enviar nada que procesar:
                echo "<form action=".$_SERVER['PHP_SELF']." method='post'>";
                echo "Validar DNI: <input type='text' value='' name='dni'><br/>";
                echo "Verificar número primo: <input type='text' value='' name='num'><br/>";
                echo "<input type='submit' name='enviar' value='Enviar'>";
                echo "</form>";
            } else {                                    //Formulario cuando se reciben los inputs por POST
                echo "<form action=".$_SERVER['PHP_SELF']." method='post'>";
                //Validar DNI
                echo "Validar DNI: <input type='text' value=".((empty($_POST['dni'])) ? "(*)" : $_POST['dni'])." name='dni' 
                    class=".(DNI::validarDNI($_POST['dni']) ? "correcto" : "incorrecto")."><br/>";
                //Verificar número primo
                echo "Verificar número primo: <input type='text' value=".((empty($_POST['num'])) ? "(*)" : $_POST['num'])." name='num'>";
                if (!empty($_POST['num']))
                    echo  $_POST['num'].((esPrimo($_POST['num'])) ? " es primo." : " no es primo.");
                echo "<br/><input type='submit' name='enviar' value='Enviar'>";
                echo "</form>";
            }

            //generamos array con los primeros 5 números primos y lo imprimimos:
            $numPrimos = primerosNPrimos(5);
            echo "<h3>Lista de los 5 primeros números primos:</h3>";
            for ($i=0; $i<sizeof($numPrimos); $i++) 
                echo "<p>".$numPrimos[$i]."</p>";
        ?>
    </main>
    <footer></footer>
    
    
</body>
</html>