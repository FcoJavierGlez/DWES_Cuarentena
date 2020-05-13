<?php
    echo "<form action=".$_SERVER['PHP_SELF']." method='post'>";
        echo "Pila <input type='text' name='elemento'>
                <input type='submit' value='Añadir elemento' name='add'>
                <input type='submit' value='Borrar elemento' name='del'>
                <input type='submit' value='Vaciar cola' name='clean'><br/>";

        if (isset($_POST['add'])) {                 //Si se pulsa el botón "Añadir elemento"
            if (!empty($_POST['elemento'])) {
                try {
                    $_SESSION['pila']->addElement($_POST['elemento']);
                } catch (\Throwable $th) {
                    echo "<p class='mensaje_error'>Has alcanzado el límite de 10 elementos</p>";
                }
            }
        }
        elseif (isset($_POST['del']))               //Si se pulsa botón Borrar elemento
            $_SESSION['pila']->delElement();
        elseif (isset($_POST['clean']))             //Si se pulsa botón Vaciar pila
            $_SESSION['pila']->clear();

        if($_SESSION['pila']->getNumElements()>0)   //Imprime contenido de la pila si posee mínimo 1 elemento
            $_SESSION['pila']->__toString();    
    echo "</form>";
?>