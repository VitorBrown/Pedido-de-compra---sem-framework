<?php
    class Produto{
        
        private $con;
        private $tabela = "produtos";

        public $id;
        public $nome;
        public $produto_id;
        public $preco;
        
        public function __construct($db = null){
            $this->con = $db;
        }
          
        public function salvar(){


            $query = "INSERT INTO ".$this->tabela." SET nome=:nome, preco=:preco, categoria_id=:categoria_id, cliente_id=:cliente_id, criado_em=:criado_em";

            $stmt = $this->con->prepare($query);

            $stmt->bindParam(":nome", $this->nome);
            $stmt->bindParam(":preco", $this->preco);
            $stmt->bindParam(":categoria_id", $this->categoria_id);
            $stmt->bindParam(":cliente_id", $_SESSION['usuario']['cliente_id']);
            $stmt->bindParam(":criado_em", $this->criado_em);
     
            if($stmt->execute()){
               
                return true;

            }else{
                
                return false;

            }
        }
        
        public function alterar(){

            $query  = "UPDATE ".$this->tabela." SET nome=:nome, preco=:preco, categoria_id=:categoria_id ";
            $query .= " WHERE id =:produto_id";
            $query .= " AND cliente_id = ".$_SESSION['usuario']['cliente_id'];
        
            $stmt = $this->con->prepare($query);
    
            $stmt->bindParam(":nome", $this->nome);
            $stmt->bindParam(":preco", $this->preco);
            $stmt->bindParam(":categoria_id", $this->categoria_id);
            $stmt->bindParam(":produto_id", $this->produto_id);

            if($stmt->execute()){

                return true;

            }else{

                return false;

            }

        }

        public function deletar(){

            $query  = " DELETE FROM " . $this->tabela . " WHERE id=:id";
            $query .= " AND cliente_id = ".$_SESSION['usuario']['cliente_id'];
            
            $stmt = $this->con->prepare($query);
    
            $stmt->bindParam(":id", $this->id);
            
            return $stmt->execute();

        }

        public function listar(){

            $query  = " SELECT p.nome, p.preco, p.id as categoria_id, c.id as categoria_id, c.nome as categoria_nome FROM categorias as c";
            $query .= " RIGHT JOIN categorias as p on(c.id = p.categoria_id)  WHERE p.id = ?";
            
            $stmt = $this->con->prepare( $query );

            $stmt->bindParam(1, $this->id);
      
            try{

                 if($row = $stmt->execute()){

                    $row = $stmt->fetch(PDO::FETCH_OBJ);

                    $produto = new Produto();
    
                    $produto->categoria_id = $row->categoria_id;
                    $produto->produto_id = $row->produto_id;
                    $produto->nome = $row->nome;
                    $produto->preco = $row->preco;

                }
                

            }catch(Exception $e){

                return "Ops, houve um erro em executar o $query. " . print_r($this->con->errorInfo());

            }

            return $produto;
        }

        public function listarTodos(){

            $query  = ' SELECT p.id as produto_id, c.id as categoria_id, p.nome as produto_nome, c.nome as categoria_nome,';
            $query .= ' p.preco FROM produtos as p';
            $query .= ' LEFT JOIN categorias as c on (p.categoria_id = c.id)';
            $query .= ' where p.cliente_id = '. $_SESSION['usuario']['cliente_id'];
            $query .= ' order by p.nome asc';

            $stmt = $this->con->prepare( $query );

            try{

                if(!$row = $stmt->execute()){

                    $produtos = false;

                }else{
                    if($row = $stmt->fetchAll(PDO::FETCH_OBJ)){
                    
                        foreach($row as $row){
    
                            $produto = new Produto();
                            $produto->categoria_id = $row->categoria_id;
                            $produto->produto_id = $row->produto_id;
                            $produto->produto_nome = $row->produto_nome;
                            $produto->categoria_nome = $row->categoria_nome;
                            $produto->preco = $row->preco;
    
                            $produtos[] = $produto;
                        }
                    }
                }
                

            }catch(Exception $e){

                return "Ops, houve um erro em executar o $query. " . print_r($this->con->errorInfo());

            }

            return $produtos;
        }

        public function deletarLote(){

            $query  = "DELETE FROM " . $this->tabela . " WHERE id IN (".$this->id.")";
            $query .= " AND cliente_id = ".$_SESSION['usuario']['cliente_id'];

            $stmt = $this->con->prepare($query);
           
            return $stmt->execute();
        }
    }
?>