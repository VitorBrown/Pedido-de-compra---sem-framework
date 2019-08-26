<?php
    require_once 'controller/ControllerUsuario.php';
    $cUsuario = new ControllerUsuario;
    if(!$cUsuario->logado()){
        header('location: ../index.php');
        die();
    }
?>

