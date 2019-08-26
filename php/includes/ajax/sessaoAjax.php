<?php 

    require_once '../controller/ControllerUsuario.php';
    $cUsuario = new ControllerUsuario;
    if(!$cUsuario->logado()){
        echo 'Você não está logado';
        die();
    }

?>