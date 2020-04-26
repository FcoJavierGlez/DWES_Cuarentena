<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Francisco Javier González Sabariego">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Generación de usuarios</title>
</head>
<body>
    <header>
        <h1>Generación de usuarios</h1>
    </header>
    <main>
        <div class="github">
            <b>El siguiente botón conduce al repositorio de GitHub:</b>
            <a href="#" target="_blank">
                <button>Ver código</button>
            </a>
        </div>
        <?php
            include "resources/funciones.php";

            if (isset($_POST['enviar'])) {
                if (isset($_POST['sistema'])) {
                    if (sizeof($_POST['sistema'])==2) {     //Linux y MySQL
                        creaScriptLinux();
                        creaScriptMysql();
                    }
                    else {
                        if ($_POST['sistema'][0]==1)        //Linux
                            creaScriptLinux();
                        elseif ($_POST['sistema'][0]==2)    //MySQL
                            creaScriptMysql();
                    }
                }
            } else {
                echo "<div class='contenedor'>";

                    echo "<form action=".$_SERVER['PHP_SELF']." method='post'>";
                        /* echo "<input type='file' name='file' value=''><br/>"; */
                        echo "<input type='checkbox' name='sistema[]' value='1'> Nuevo usuario de Linux.<br/>";
                        echo "<input type='checkbox' name='sistema[]' value='2'> Nuevo usuario MySQL.<br/>";
                        echo "<input type='submit' name='enviar'>";
                    echo "</form>";

                echo "</div>";
            }

            
        ?>
    </main>
    <footer>
        <h4>RRSS del autor:</h4>
        <div>
            <a href="https://twitter.com/Fco_Javier_Glez" target="_blank"><img src="img/twitter.png" alt="Enlace a cuenta de Twitter del autor"></a>
            <a href="https://github.com/FcoJavierGlez" target="_blank"><img src="img/github.png" alt="Enlace a cuenta de GitHub del autor"></a>
            <a href="https://www.linkedin.com/in/francisco-javier-gonz%C3%A1lez-sabariego-51052a175/" target="_blank"><img src="img/linkedin.png" alt="Enlace a cuenta de Linkedin del autor"></a>
        </div>
    </footer>
</body>
</html>