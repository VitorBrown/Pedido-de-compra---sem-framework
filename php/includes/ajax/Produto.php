<?php 
    include('sessaoAjax.php');
    include_once '../controller/ControllerProduto.php';

    if(isset($_POST['action'])){

        $cProduto = new ControllerProduto;

        $request = $_POST;
      
        switch($_POST['action']){
            case 'criar':
                echo  json_encode($cProduto->criarProduto($request));
            break;
            case 'alterar':
                echo  json_encode($cProduto->alterarProduto($request));
            break;
            case 'listarTodos':
                echo  json_encode($cProduto->listarTodosProduto($request));
            break;
               
            case 'listar':
                echo  json_encode($cProduto->listarProdutoProduto($request));
            break;
            case 'apagar':
                echo  json_encode($cProduto->deletarProduto($request));
            break;
                
        }
    }   



?>