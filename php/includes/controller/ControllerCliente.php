<?php

    include_once 'autoLoadClass.php';

    class ControllerCliente{
        

        public function criarCliente($request){

            $funcao = new Funcao();

            if($funcao->validarEmail($request['email']) || 
               $funcao->validarTexto($request['nome'])  ||
               $funcao->validarTexto($request['senha'])){

                return 'Ops, campos vazios verifique';
                
            }

            $conexao = new Conexao();
            $cliente = new Cliente($conexao->conectar());

            $cliente->email      = htmlspecialchars(strip_tags($request['email']));
            $cliente->nome       = htmlspecialchars(strip_tags($request['nome']));
            $cliente->cpf        = htmlspecialchars(strip_tags($request['cpf']));
            $cliente->tipo      = htmlspecialchars(strip_tags($request['tipo']));

            return $cliente->salvar();
        }


        public function alterarCliente($request){

            $funcao = new Funcao();

            if($funcao->validarEmail($request['email']) || 
               $funcao->validarTexto($request['nome'])  ||
               $funcao->validarTexto($request['senha'])){

                return 'Ops, campos vazios verifique';
                
            }

            $conexao = new Conexao();
            $cliente = new Cliente($conexao->conectar());

            $cliente->email      = htmlspecialchars(strip_tags($request['email']));
            $cliente->nome       = htmlspecialchars(strip_tags($request['nome']));
            $cliente->cliente_id = htmlspecialchars(strip_tags($request['id']));
            $cliente->senha      = htmlspecialchars(strip_tags($request['senha']));
            $cliente->cpf        = htmlspecialchars(strip_tags($request['cpf']));
            $cliente->tipo      = htmlspecialchars(strip_tags($request['tipo']));

            return $cliente->alterar();

        }

        public function deletarCliente($request){

            $funcao = new Funcao();

            
            if($funcao->validarId($request['id'])){

                return 'Ops, campos vazios verifique';
                
            }

            $conexao = new Conexao();
            $cliente = new Cliente($conexao->conectar());

            $cliente->id = htmlspecialchars(strip_tags($request['id']));

           return $cliente->deletar();
        }

        public function listarCliente($request){

            $funcao = new Funcao();

            if($funcao->validarId($request['id'])){

                return 'Ops, campos vazios verifique';

            }

            $conexao = new Conexao();
            $cliente = new Cliente($conexao->conectar());

            $cliente->id = htmlspecialchars(strip_tags($request['id']));

           return $cliente->listar();
        }

        public function listarTodosCliente() {
            $conexao = new Conexao();
            $cliente = new Cliente($conexao->conectar());

            return $cliente->listarTodos();
        }


    }

?>