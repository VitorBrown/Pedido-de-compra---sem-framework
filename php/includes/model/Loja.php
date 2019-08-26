<?php

    class Loja{
        
    private $con;

    public $email;
    public $cliente_id;
    public $produto_id;
    public $cliente_nome;
    public $categoria_id;
    public $categoria_nome;
    public $criado_em;
   
    public function __construct($db = null){
        $this->con = $db;
    }

    public function listarProdutosLoja(){

        $query    = '	SELECT p.nome AS produto_nome, c.nome AS categoria_nome, c.id AS categoria_id, p.id AS produto_id,';
        $query   .= '	 p.preco, cli.nome AS cliente_nome, cli.id AS cliente_id, p.criado_em, "'.$this->paginacaoLoja().'" as num_pagina, "'.$this->pagina.'" as pagina_atual';
        $query   .= '	from produtos as p';
        $query   .= '	inner join clientes as cli on(p.cliente_id = cli.Id)';
        $query   .= '	left join categorias as c on(c.Id = p.categoria_id)';
        $query   .= '   where p.cliente_id <> '.$_SESSION['usuario']['cliente_id'];

        if(isset($this->categoria_id) && $this->categoria_id ){

            $query .= '  and categoria_id=:categoria_id';

        }

        if($this->preco || $this->criado_em){
            $query .= '  order by ';

            if($this->preco == 1){
                $sql[] = 'p.preco asc';
            }

            if($this->preco == 2){
                $sql[] = 'p.preco desc';
            }

            if($this->criado_em == 1){
                $sql[] = 'p.criado_em asc';
            }

            if($this->criado_em == 2){
                $sql[] = 'p.criado_em desc';
            }
            
            $query .= implode(',', $sql);

        }

        if($this->item_pagina){
            
            $query .= ' LIMIT '.$this->item_pagina;

        }else{
            
            $query .= ' LIMIT 5';

        }

        if(isset($this->pagina) && $this->pagina > 1){

            $this->pagina = $this->pagina - 1;

            $num_itens = $this->paginacaoLoja();

            if($this->paginacaoLoja() < ($this->pagina * $this->item_pagina)){
                
                $query .= ' OFFSET '. $num_itens - $this->item_pagina;

            }else if($num_itens > $this->item_pagina){

                $query .= ' OFFSET '.$this->pagina * $this->item_pagina;

            }  

        }


        $stmt = $this->con->prepare($query);

        if(isset($this->categoria_id) && $this->categoria_id > 0 ){

            $stmt->bindParam(':categoria_id', $this->categoria_id);

        }
        

        if(!$row = $stmt->execute()){

            $lojas = false;

        }else{
            if($row = $stmt->fetchAll(PDO::FETCH_OBJ)){
             
                foreach($row as $row){

                    $loja = new Loja();

                    $loja->produto_id = $row->produto_id;
                    $loja->categoria_id = $row->categoria_id;
                    $loja->cliente_id = $row->cliente_id;
                    $loja->produto_nome = $row->produto_nome;
                    $loja->categoria_nome = $row->categoria_nome;
                    $loja->cliente_nome = $row->cliente_nome;
                    $loja->preco = $row->preco;
                    $loja->criado_em = $row->criado_em;
                    $loja->num_pagina = $row->num_pagina;
                    $loja->pagina_atual = $row->pagina_atual;
                    $lojas[] = $loja;
                }

             
            }
        }

     return $lojas;
    
    }

    public function paginacaoLoja(){
        
        $query    = '	SELECT count(*) AS rows';
        $query   .= '	from produtos as p';
        $query   .= '	inner join clientes as cli on(p.cliente_id = cli.Id)';
        $query   .= '	left join categorias as c on(c.Id = p.categoria_id)';
        $query   .= '   where p.cliente_id <> '.$_SESSION['usuario']['cliente_id'];

        if(isset($this->categoria_id) && $this->categoria_id ){

            $query .= ' and  categoria_id=:categoria_id';

        }

        if($this->preco || $this->criado_em){
            $query .= '  order by ';

            if($this->preco == 1){
                $sql[] = 'p.preco asc';
            }

            if($this->preco == 2){
                $sql[] = 'p.preco desc';
            }

            if($this->criado_em == 1){
                $sql[] = 'p.criado_em asc';
            }

            if($this->criado_em == 2){
                $sql[] = 'p.criado_em desc';
            }
            
            $query .= implode(',', $sql);
        }

        $stmt = $this->con->prepare($query);

        if(isset($this->categoria_id) && $this->categoria_id > 0 ){

            $stmt->bindParam(':categoria_id', $this->categoria_id);

        }

       
        if($row = $stmt->execute()){

            $row = $stmt->fetch(PDO::FETCH_OBJ);
            
            $num_paginas = $row->rows;
            
        }

        return $num_paginas;
    }
    
    }
   
?>