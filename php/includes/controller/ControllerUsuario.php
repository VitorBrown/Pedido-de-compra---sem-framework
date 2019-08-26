<?php

    session_start();

    include_once 'autoLoadClass.php';

    class ControllerUsuario{
        
        function fazer_login($request = null){
            
            $funcao = new Funcao();

            if($funcao->validarEmail($request['email'])){
                $funcao->voltar();
            }

            $conexao = new Conexao();
            $usuario = new Usuario($conexao->conectar());

            $usuario->email = $request['email'];
            $usuario->senha = $request['senha'];

            if($usuario->fazer_login()){
                header("Location: sistema/index.php ");
            }else{
                $funcao->voltar();
            }
        }

        function logado(){

            $usuario = new Usuario();

            return $usuario->logado();
        }

        function sair(){
            $usuario = new Usuario();
            $funcao = new Funcao();
            if($usuario->logout()){

                $funcao->voltar();
            }else{
                $funcao->voltar();
            }
            

        }

    }

?>