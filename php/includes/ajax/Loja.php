<?php 
    include('sessaoAjax.php');
    include_once '../controller/ControllerLoja.php';
    if(isset($_POST['action'])){

        $cLoja = new ControllerLoja;

        $request = $_POST;
        
        switch($_POST['action']){
            case 'filtrar':
                echo  json_encode($cLoja->filtrarProdutos($request));
            break;
                
        }
    }   



?>