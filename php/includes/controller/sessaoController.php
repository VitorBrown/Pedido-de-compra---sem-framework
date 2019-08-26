<?php 

    require_once 'ControllerUsuario.php';
    $cUsuario = new ControllerUsuario;
    if(!$cUsuario->logado()){
        echo 'Você não está logado';
        die();
    }

?>