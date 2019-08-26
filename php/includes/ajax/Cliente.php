<?php 
    include('sessaoAjax.php');
    include_once '../controller/ControllerCliente.php';


    if(isset($_POST['action'])){

        $cCliente = new ControllerCliente;

        $request = $_POST;

        switch($_POST['action']){
            case 'criar':
                echo  json_encode($cCliente->criarCliente($request));
            break;
            case 'alterar':
                echo  json_encode($cCliente->alterarCliente($request));
            break;
            case 'listarTodos':
                echo  json_encode($cCliente->listarTodosCliente($request));
            break;
            case 'listar':
                echo  json_encode($cCliente->listarCliente($request));
            break;
            case 'apagar':  
                echo  json_encode($cCliente->deletarCliente($request));
            break;
        }
    }   


?>