<?php 

    include('sessaoAjax.php');
    include_once '../controller/ControllerProduto.php';

    if(isset($_POST['action'])){

        $cCategoria = new ControllerProduto;

        $request = $_POST;

        switch($_POST['action']){
            case 'criar':
                echo  json_encode($cCategoria->criarCategoria($request));
            break;
            case 'alterar':
                echo  json_encode($cCategoria->alterarCategoria($request));
            break;
            case 'listarTodos':
                echo json_encode($cCategoria->listarTodosCategoria());
            break;
            case 'listar':
                echo  json_encode($cCategoria->listarCategoria($request));
            break;
            case 'apagar':
                echo  json_encode($cCategoria->deletarCategoria($request));
            break;

        }
    }   


?>