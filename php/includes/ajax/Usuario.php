<?php 
    include_once '../controller/ControllerUsuario.php';


    if(isset($_POST['action'])){

        $cUsuario = new ControllerUsuario;

        $request = $_POST;

        switch($_POST['action']){
            case 'entrar':
                echo  json_encode($cUsuario->fazer_login($request));
            break;
            case 'sair':
                echo  json_encode($cUsuario->sair());
            break;
        }
    }   


?>