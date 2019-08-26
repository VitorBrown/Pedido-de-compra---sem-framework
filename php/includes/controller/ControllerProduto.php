<?php

    include_once 'autoLoadClass.php';
    include_once 'sessaoController.php';
    class ControllerProduto{
        
       
        public function criarCategoria($request){

            $funcao = new Funcao();

            if($funcao->validarNome($request['nome'])){

                return 'Ops, campos vazios verifique';
                
            }

            $conexao = new Conexao();
            $categoria = new Categoria($conexao->conectar());

            $categoria->nome = htmlspecialchars(strip_tags($request['nome']));
        

            return $categoria->salvar();
        }


        public function alterarCategoria($request){

            $funcao = new Funcao();

            if($funcao->validarId($request['id']) || 
               $funcao->validarTexto($request['nome'])){

                return 'Ops, campos vazios verifique';
                
            }

            $conexao = new Conexao();
            $categoria = new Categoria($conexao->conectar());

            $categoria->nome = htmlspecialchars(strip_tags($request['nome']));
            $categoria->id   = htmlspecialchars(strip_tags($request['id']));

            return $categoria->alterar();

        }

        public function deletarCategoria($request){

            $funcao = new Funcao();

            
            if($funcao->validarId($request['id'])){

                return 'Ops, campos vazios verifique';
                
            }

            $conexao = new Conexao();
            $categoria = new Categoria($conexao->conectar());

            $categoria->id = htmlspecialchars(strip_tags($request['id']));

            if(strpos($compra->id, ',')){

                return $compra->deletarLote();
                
            }

           return $categoria->deletar();
        }

        public function listarCategoria($request){

            $funcao = new Funcao();

            if($funcao->validarId($request['id'])){

                return 'Ops, campos vazios verifique';

            }

            $conexao = new Conexao();
            $categoria = new Categoria($conexao->conectar());

            $categoria->id = htmlspecialchars(strip_tags($request['id']));

           return $categoria->listar();
        }

        public function listarTodosCategoria() {
            $conexao = new Conexao();
            $categoria = new Categoria($conexao->conectar());

            return $categoria->listarTodos();
        }


        public function criarProduto($request){

            $funcao = new Funcao();

            if($funcao->validarId($request['categoria_id']) || 
               $funcao->validarTexto($request['nome'])  ||
               $funcao->validarTexto($request['preco'])){

                return 'Ops, campos vazios verifique';
                
            }

            $conexao = new Conexao();
            $produto = new Produto($conexao->conectar());

            $produto->categoria_id     = htmlspecialchars(strip_tags($request['categoria_id']));
            $produto->nome             = htmlspecialchars(strip_tags($request['nome']));
            $produto->preco            = htmlspecialchars(strip_tags($request['preco']));
            $produto->criado_em        = $funcao->agora();

            return $produto->salvar();
        }


        public function alterarProduto($request){
            
            $funcao = new Funcao();

            if($funcao->validarId($request['categoria_id']) || 
               $funcao->validarId($request['id']) || 
               $funcao->validarTexto($request['nome'])  ||
               $funcao->validarTexto($request['preco'])){

                return 'Ops, campos vazios verifique';
                
            }

            $conexao = new Conexao();
            $produto = new Produto($conexao->conectar());

            $produto->produto_id     = htmlspecialchars(strip_tags($request['id']));
            $produto->nome       = htmlspecialchars(strip_tags($request['nome']));
            $produto->categoria_id = htmlspecialchars(strip_tags($request['categoria_id']));
            $produto->preco      = htmlspecialchars(strip_tags($request['preco']));
            
            return $produto->alterar();

        }

        public function deletarProduto($request){

            $funcao = new Funcao();
            
            if($funcao->validarId($request['id'])){

                return 'Ops, campos vazios verifique';
                
            }

            $conexao = new Conexao();
            $produto = new Produto($conexao->conectar());

            $produto->id = htmlspecialchars(strip_tags($request['id']));

            if(strpos($produto->id, ',')){

                return $produto->deletarLote();

            }

           return $produto->deletar();
        }

        public function listarProduto($request){

            $funcao = new Funcao();

            if($funcao->validarId($request['id'])){

                return 'Ops, campos vazios verifique';

            }

            $conexao = new Conexao();
            $produto = new Produto($conexao->conectar());

            $produto->id = htmlspecialchars(strip_tags($request['id']));

           return $produto->listar();
        }

        public function listarTodosProduto() {
            $conexao = new Conexao();
            $produto = new Produto($conexao->conectar());

            return $produto->listarTodos();
        }

    }

?>