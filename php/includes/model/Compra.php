<?php
    class Compra{
        
        private $con;
        private $tabela = "compras";

        public $cliente_id;
        public $produto_id;
        public $quantidade;
        public $compra_id;
        
        public function __construct($db = null){
            $this->con = $db;
        }
        
        public function salvar(){

            $query = "INSERT INTO ".$this->tabela." SET cliente_id=:cliente_id, produto_id=:produto_id, quantidade=:quantidade,criado_em=:criado_em ";

            $stmt = $this->con->prepare($query);
    
            $stmt->bindParam(":cliente_id", $this->cliente_id);
            $stmt->bindParam(":produto_id", $this->produto_id);
            $stmt->bindParam(":quantidade", $this->quantidade);
            $stmt->bindParam(":criado_em", $this->criado_em);
    
            if($stmt->execute()){
                return true;
            }else{
                return false;
            }
          

        }
        
        public function alterar(){


            $query  = "UPDATE ".$this->tabela." SET produto_id=:produto_id, quantidade=:quantidade, ";
            $query .= " status=:status";
            $query .= " WHERE id =:compra_id";

            $stmt = $this->con->prepare($query);

            $stmt->bindParam(":produto_id", $this->produto_id);
            $stmt->bindParam(":quantidade", $this->quantidade);
            $stmt->bindParam(":status", $this->status);
            $stmt->bindParam(":compra_id", $this->id);

            if($stmt->execute()){

                return true;

            }else{

                return false;

            }

        }

        public function listar(){

            $query   = ' SELECT p.nome AS produto_nome, c.nome AS categoria_nome, c.id AS categoria_id, p.id AS produto_id, ';
            $query  .= ' p.preco, cli.nome AS cliente_nome, cli.id AS cliente_id, com.id AS compra_id, com.quantidade';
            $query  .= ' FROM compras AS com';
            $query  .= ' INNER JOIN produtos AS p ON (p.id = com.produto_id)';
            $query  .= ' INNER JOIN clientes AS cli ON (cli.id = com.cliente_id)';
            $query  .= ' LEFT JOIN categorias AS c ON (c.id = p.categoria_id)';
            $query  .= ' WHERE com.id = ?';
            $query  .= ' ORDER BY com.id DESC';

            $stmt = $this->con->prepare( $query );

            $stmt->bindParam(1, $this->id);
      
            try{
                
                 if($row = $stmt->execute()){

                    $row = $stmt->fetch(PDO::FETCH_OBJ);
                    $compra = new Compra();
               
                    if(isset($row->quantidade)){
                        $compra->produto_id = $row->produto_id;
                        $compra->categoria_id = $row->categoria_id;
                        $compra->cliente_id = $row->cliente_id;
                        $compra->compra_id = $row->compra_id;
                        $compra->produto_nome = $row->produto_nome;
                        $compra->categoria_nome = $row->categoria_nome;
                        $compra->cliente_nome = $row->cliente_nome;
                        $compra->preco = $row->preco;
                        $compra->quantidade = $row->quantidade;
                    }else{
                        return 'Nada foi encontrado';
                    }

                }
                

            }catch(Exception $e){

                return "Ops, houve um erro em executar o $query. " . print_r($this->con->errorInfo());

            }

            return $compra;
        }

        public function listarTodasCompras($tipo){

            $query   = 'select com.Id as compra_id, com.quantidade, com.status, com.criado_em as compra_feita_em, ';
            $query  .= 'p.nome as produto_nome, p.id as produto_id, ';
            $query  .= 'cat.Id as categoria_id, cat.nome as categoria_nome, p.preco ';
            $query  .= 'from produtos as p ';
            $query  .= 'inner join compras as com on(com.produto_id = p.Id) ';
            $query  .= 'inner join clientes as cli on(com.cliente_id = com.cliente_id) ';
            $query  .= 'inner join categorias as cat on(p.categoria_id = cat.Id) ';
            if($tipo == 1 ){
                $query  .= 'where com.cliente_id = '.$_SESSION['usuario']['cliente_id'];
            }else{
                $query  .= 'where p.cliente_id = '.$_SESSION['usuario']['cliente_id'];
            }
            $query  .= ' group by com.id ';
            $query  .= 'order by com.criado_em, com.status desc ';
                        
           
            $stmt = $this->con->prepare( $query );
            $compras = false;
            try{

                if(!$row = $stmt->execute()){

                    $compras = false;

                }else{
                    if($row = $stmt->fetchAll(PDO::FETCH_OBJ)){
                        foreach($row as $row){
    
                            $compra = new Compra();

                            $compra->produto_id = $row->produto_id;
                            $compra->categoria_id = $row->categoria_id;
                            $compra->compra_id = $row->compra_id;
                            $compra->produto_nome = $row->produto_nome;
                            $compra->categoria_nome = $row->categoria_nome;
                            $compra->preco = $row->preco;
                            $compra->quantidade = $row->quantidade;
                            switch($row->status){
                                case 1:
                                    $status = 'Pago';
                                break;
                                case 2:
                                    $status = 'Em Aberto';
                                break;
                                case 0:
                                    $status = 'Cancelado';
                                break;
                            }
                            $compra->status = $status;
                            $compra->criado_em = $row->compra_feita_em;

                            $compras[] = $compra;
                        }

                     
                    }
                }
                

            }catch(Exception $e){

                return "Ops, houve um erro em executar o $query. " . print_r($this->con->errorInfo());

            }
            

            return $compras;
        }

        public function deletar(){
            
            $query  = "DELETE FROM " . $this->tabela . " WHERE id=:id ";

            $stmt = $this->con->prepare($query);
    
            $stmt->bindParam(":id", $this->id);
            
            return $stmt->execute();

        }

        public function deletarLote(){

            $query  = "DELETE FROM " . $this->tabela . " WHERE id IN (".$this->id.")";

            $stmt = $this->con->prepare($query);
           
            return $stmt->execute();
        }
    }
?>