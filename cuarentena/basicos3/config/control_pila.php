<?php
    echo "<form action=".$_SERVER['PHP_SELF']." method='post'>";
        echo "Pila <input type='text' name='elemento'>
                <input type='submit' value='Añadir elemento' name='add'>
                <input type='submit' value='Borrar elemento' name='del'>
                <input type='submit' value='Vaciar pila' name='clean'><br/>";

        if (isset($_POST['add'])) {             //Si se pulsa el botón "Añadir elemento"
            if (!empty($_POST['elemento']))
                $_SESSION['pila']->addElement($_POST['elemento']);
        }
        elseif (isset($_POST['del']))           //Si se pulsa botón Borrar elemento
            $_SESSION['pila']->delElement();
        elseif (isset($_POST['clean']))         //Si se pulsa botón Vaciar pila
            $_SESSION['pila']->clear();

        $_SESSION['pila']->__toString();    //Imprime contenido de la pila
    echo "</form>";
?>