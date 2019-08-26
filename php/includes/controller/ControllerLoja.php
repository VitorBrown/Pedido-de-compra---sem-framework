<?php

    include_once 'autoLoadClass.php';

    class ControllerLoja{
        
        public function filtrarProdutos($request){
            $funcao = new Funcao();

            if(
                $funcao->validarId($request['valor']) ||
                $funcao->validarId($request['item_pagina']) ||
                $funcao->validarId($request['data']) ){

                    return false;

            }

            $conexao = new Conexao();
            $loja = new Loja($conexao->conectar());

            if(isset($request['categoria_id']) && $request['categoria_id'] >0){
                $loja->categoria_id = htmlspecialchars(strip_tags($request['categoria_id']));
            }

        
            $loja->preco = htmlspecialchars(strip_tags($request['valor']));
            $loja->criado_em = htmlspecialchars(strip_tags($request['data']));
            $loja->item_pagina = htmlspecialchars(strip_tags($request['item_pagina']));
            $loja->pagina = htmlspecialchars(strip_tags($request['pagina']));
        
            return $loja->listarProdutosLoja();
        }

    }

?>