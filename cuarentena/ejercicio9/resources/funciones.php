<?php
    function getUser($nombre) {
        return substr(normalizaCadena(explode(" ",$nombre)[0]),0,2).substr(normalizaCadena(explode(" ",$nombre)[1]),0,2).substr(normalizaCadena(explode(" ",$nombre)[2]),0,2);
    }

    function normalizaCadena($cadena) {
        $acentos = array("á","é","í","ó","ú","Á","É","Í","Ó","Ú","Ñ","ñ");
        $letras = array("a","e","i","o","u","a","e","i","o","u","n","n");
        return str_replace($acentos, $letras, strtolower($cadena));
    }

    function leerFichero(/* $ruta */) {
        //$file = fopen($ruta, "r") or exit("Unable to open file!");
        $file = fopen("./Alumnos.txt", "r") or exit("Unable to open file!");

        $usuarios = array();
        $i = 0;

        if ($file) {
            while (($line = fgets($file)) !== false) {
                if ($i>7) {
                    $numUser = 0;
                    if (in_array(getUser($line),$usuarios)) {
                        do {
                            $numUser++;
                        } while (in_array(getUser($line).$numUser,$usuarios));
                        array_push($usuarios,getUser($line).$numUser);
                    } else 
                        array_push($usuarios,getUser($line));
                }
                $i++;
            }
        } else
            echo "El fichero no pudo ser abierto.";
        
        return $usuarios;

        //imprimir lista de usuarios:
        /* for ($i=0; $i<sizeof($usuarios); $i++) 
            echo $usuarios[$i]."<br/>"; */
    }

    function creaScriptLinux() {
        $usuarios = leerFichero();
        $comando = array("sudo useradd ","sudo passwd ");

        $file = fopen("scripts/linux.txt", "w") or exit("Unable to open file!");

        for ($i=0; $i<sizeof($usuarios); $i++) { 
            $a = 0;
            do {
                fwrite($file,$comando[$a].$usuarios[$i]."\n");
                $a++;
            } while ($a < 2);
        }
        fclose($file);
    }

    function getComandoMysql($user,$num) {
        if ($num==1)
            return "CREATE USER '$user'@'localhost' IDENTIFIED BY '$user'";
        else
            return "GRANT ALL PRIVILEGES ON * . * TO '$user'@'localhost'";
    }

    function creaScriptMysql() {
        $usuarios = leerFichero();

        $file = fopen("scripts/mysql.txt", "w") or exit("Unable to open file!");

        for ($i=0; $i<sizeof($usuarios); $i++) { 
            $a = 1;
            do {
                fwrite($file,getComandoMysql($usuarios[$i],$a)."\n");
                $a++;
            } while ($a < 3);
        }
        fclose($file);
    }
?>