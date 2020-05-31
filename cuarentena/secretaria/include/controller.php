<?php
    if ( isset($_GET['register']) ) {                     //Si se accede al registro
        if ( $newUser )
            include "include/users/new_user_ok.php";
        else
            include "include/users/new_user.php";
    } 
    elseif ( isset($_GET['usuarios']) )                   //Acceder a usuarios
        include "include/users/info_user.php";
    elseif ( isset($_GET['documentos']) )                 //Documentos
        include "include/documents/own_documents.php";
    elseif ( $newFile )                                   //Documento añadido correctamente
        include "include/documents/add_document_ok.php";
    elseif ( isset($_GET['add_document']) )               //Añadir documentos
        include "include/documents/add_document.php";
    elseif ( isset($_GET['firmar']) )                     //Añadir documentos
        include "include/documents/sign_document.php";
    elseif ( isset($_GET['perfil']) )                     //Perfil
        include "include/users/own_user.php";
    elseif ( isset($_POST['ed_pass']) || isset($_POST['change_pass'])  ) {              //Editar perfil
        if ( $edit_pass_ok )
            include "include/users/edit_perfil_ok.php";
        else
            include "include/users/ed_pass_user.php";
    }
    elseif ( isset($_GET['edit_perfil']) ) {              //Editar perfil
        if ( $edit_perfil_ok )
            include "include/users/edit_perfil_ok.php";
        else
            include "include/users/edit_user.php";
    }
    elseif ( isset($_GET['delete']) )                     //Generar nuevo juego de claves
        include "include/documents/del_document.php";
    elseif ( isset($_GET['step']) )                       //Generar nuevo juego de claves
        include "include/users/step_new_keys.php";
    else
        include "include/main.php";
?>