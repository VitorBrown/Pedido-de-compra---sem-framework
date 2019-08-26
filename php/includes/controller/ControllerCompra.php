<?php

    include_once 'autoLoadClass.php';
    include_once 'sessaoController.php';

    class ControllerCompra{
        
        public function criarCompra($request){

            $funcao = new Funcao();

            if($funcao->validarId($request['id'])  ||
               $funcao->validarId($request['quantidade'])){

                return 'Ops, campos vazios verifique';
                
            }

            $conexao = new Conexao();
            $compra = new Compra($conexao->conectar());

            $compra->produto_id       = htmlspecialchars(strip_tags($request['id']));
            $compra->cliente_id       = $_SESSION['usuario']['cliente_id'];
            $compra->quantidade       = htmlspecialchars(strip_tags($request['quantidade']));
            $compra->criado_em        = $funcao->agora();

            return $compra->salvar();
        }


        public function alterarCompra($request){

            $funcao = new Funcao();
            
            if(
               $funcao->validarTexto($request['produto_id'])||
               $funcao->validarTexto($request['quantidade'])){

                return 'Ops, campos vazios verifique';
                
            }

            $conexao = new Conexao();
            $compra = new Compra($conexao->conectar());

            $compra->produto_id       = htmlspecialchars(strip_tags($request['produto_id']));
            $compra->id               = htmlspecialchars(strip_tags($request['id']));
            $compra->quantidade       = htmlspecialchars(strip_tags($request['quantidade']));
            $compra->status       = htmlspecialchars(strip_tags($request['status']));

            return $compra->alterar();

        }

        public function listarCompra($request){

            $funcao = new Funcao();

            if($funcao->validarId($request['id'])){

                return 'Ops, campos vazios verifique';

            }

            $conexao = new Conexao();
            $compra = new Compra($conexao->conectar());

            $compra->id = htmlspecialchars(strip_tags($request['id']));

           return $compra->listar();
        }

        public function listarTodosCompra($request) {
            $conexao = new Conexao();
            $compra = new Compra($conexao->conectar());
            $produto = new Produto($conexao->conectar());

            return $compra->listarTodasCompras($request['tipo']);
        }

        public function deletarCompra($request){

            $funcao = new Funcao();

            if($funcao->validarId($request['id'])){

                return 'Ops, campos vazios verifique';
                
            }

            $conexao = new Conexao();
            $compra = new Compra($conexao->conectar());

            $compra->id = htmlspecialchars(strip_tags($request['id']));
            
            if(strpos($compra->id, ',')){

                return $compra->deletarLote();

            }

           return $compra->deletar();
        }


    }

?>