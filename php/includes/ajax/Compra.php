<?php 
    include('sessaoAjax.php');
    
    include_once '../controller/ControllerCompra.php';

  

    if(isset($_REQUEST['action'])){

        $cCompra = new ControllerCompra;

        $request = $_REQUEST;

        switch($_REQUEST['action']){
            case 'criar':
                echo  json_encode($cCompra->criarCompra($request));
            break;
            case 'alterar':
                echo  json_encode($cCompra->alterarCompra($request));
            break;
            case 'listarTodos':
                echo  json_encode($cCompra->listarTodosCompra($request));
            break;
            case 'listar':
                echo  json_encode($cCompra->listarCompra($request));
            break;
            case 'apagar':
                echo  json_encode($cCompra->deletarCompra($request));
            break;

        }
    }   


?>