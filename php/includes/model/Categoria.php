<?php
    include_once 'sessaoModel.php';
    class Categoria{
        
        private $con;
        private $tabela = "categorias";

        public $id;
        public $nome;
        
        public function __construct($db = null){
            $this->con = $db;
        }
        
        public function salvar(){


            $query = "INSERT INTO ".$this->tabela." SET nome=:nome";

            $stmt = $this->con->prepare($query);
    
            $stmt->bindParam(":nome", $this->nome);
    
            if($stmt->execute()){
               
                return true;

            }else{
                
                return false;

            }
        }
        
        public function alterar(){

            $query  = "UPDATE ".$this->tabela." SET nome=:nome";
            $query .= " WHERE id =:categoria_id";

            $stmt = $this->con->prepare($query);
    
            $stmt->bindParam(":nome", $this->nome);
            $stmt->bindParam(":categoria_id", $this->categoria_id);

            if($stmt->execute()){

                return true;

            }else{

                return false;

            }

        }

        public function deletar(){

            $query  = "DELETE FROM " . $this->tabela . " WHERE id=:categoria_id ";

            $stmt = $this->con->prepare($query);
    
            $stmt->bindParam(":categoria_id", $this->categoria_id);
            
            return $stmt->execute();

        }

        public function listar(){

            $query  = " SELECT c.nome, c.id FROM ".$this->tabela."  WHERE p.id = ?";

            $stmt = $this->con->prepare( $query );

            $stmt->bindParam(1, $this->id);
      
            try{

                 if($row = $stmt->execute()){

                    $row = $stmt->fetch(PDO::FETCH_OBJ);

                    $categoria = new Categoria();
    
                    $categoria->id = $row->id;
                    $categoria->nome = $row->nome;

                }
                

            }catch(Exception $e){

                return "Ops, houve um erro em executar o $query. " . print_r($this->con->errorInfo());

            }

            return $categoria;
        }

        public function listarTodos(){

            $query  = " SELECT c.nome, c.id as categoria_id FROM ".$this->tabela." as c order by c.nome asc";
            
            $stmt = $this->con->prepare( $query );

            try{

                if(!$row = $stmt->execute()){

                    $categorias = false;

                }else{
                    if($row = $stmt->fetchAll(PDO::FETCH_OBJ)){
                    
                        foreach($row as $row){
    
                            $categoria = new Categoria();
                            $categoria->categoria_id = $row->categoria_id;
                            $categoria->nome = $row->nome;
    
                            $categorias[] = $categoria;
                        }
                    }
                }
                

            }catch(Exception $e){

                return "Ops, houve um erro em executar o $query. " . print_r($this->con->errorInfo());

            }

            return $categorias;
        }

        public function deletarLote(){

            $query  = "DELETE FROM " . $this->tabela . " WHERE id IN (".$this->id.")";

            $stmt = $this->con->prepare($query);
           
            return $stmt->execute();
        }
    }
?>