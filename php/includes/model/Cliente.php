<?php
    class Cliente{
        
        private $con;
        private $tabela = "clientes";

        public $id;
        public $nome;
        public $cpf;
        public $email;
        
        public function __construct($db = null){
            $this->con = $db;
        }
        
        public function salvar(){

            $query = "INSERT INTO " . $this->tabela . " SET nome=:nome, cpf=:cpf, tipo=:tipo ";
    
            $stmt = $this->con->prepare($query);
    
            $stmt->bindParam(":nome", $this->nome);
            $stmt->bindParam(":cpf", $this->cpf);
            $stmt->bindParam(":tipo", $this->tipo);
    
            $stmt->execute();

            $this->cliente_id = $this->con->lastInsertId();

            if($this->cliente_id){

                $query = "INSERT INTO usuarios SET email=:email, senha=:senha, cliente_id=:cliente_id";
    
                $stmt = $this->con->prepare($query);
        
                $stmt->bindParam(":email", $this->email);
                $stmt->bindParam(":senha", $this->senha);
                $stmt->bindParam(":cliente_id", $this->cliente_id);
        
                if($stmt->execute()){
                    return true;
                }else{
                    return false;
                }
            }else{

                return false.'ooi';

            }

        }
        
        public function alterar(){

            $query = "UPDATE " . $this->tabela . " SET nome=:nome, cpf=:cpf, tipo=:tipo WHERE id=:id";
    
            $stmt = $this->con->prepare($query);
    
            $this->nome=htmlspecialchars(strip_tags($this->nome));
            $this->cliente_id=htmlspecialchars(strip_tags($this->cliente_id));
            $this->tipo=htmlspecialchars(strip_tags($this->tipo));
            $this->cpf=htmlspecialchars(strip_tags($this->cpf));
            
            $stmt->bindParam(":nome", $this->nome);
            $stmt->bindParam(":cpf", $this->cpf);
            $stmt->bindParam(":tipo", $this->tipo);
            $stmt->bindParam(":id", $this->cliente_id);

            if($stmt->execute()){

                $query  = "UPDATE usuarios SET email=:email, senha=:senha, cliente_id=:cliente_id ";
                $query .= " WHERE cliente_id =:cliente_id";
    
                $stmt = $this->con->prepare($query);
        
                $stmt->bindParam(":email", $this->email);
                $stmt->bindParam(":senha", $this->senha);
                $stmt->bindParam(":cliente_id", $this->cliente_id);
        
                if($stmt->execute()){

                    return true;

                }else{

                    return false;

                }

            }else{

                return false;

            }
        }

        public function deletar(){

            $query  = "DELETE FROM " . $this->tabela . " WHERE id=:id ";

            $stmt = $this->con->prepare($query);
    
            $stmt->bindParam(":id", $this->id);
            
            return $stmt->execute();

        }

        public function listar(){

            $query  = " SELECT u.email, c.nome, c.id as cliente_id, c.tipo, c.cpf  FROM clientes as c";
            $query .= " LEFT JOIN usuarios as u on(c.id = u.cliente_id)  WHERE c.id = ?";

            $stmt = $this->con->prepare( $query );

            $stmt->bindParam(1, $this->id);
      
            try{

                 if($row = $stmt->execute()){

                    $row = $stmt->fetch(PDO::FETCH_OBJ);

                    $cliente = new Cliente();
    
                    $cliente->cliente_id = $row->cliente_id;
                    $cliente->nome = $row->nome;
                    $cliente->email = $row->email;
                    $cliente->cpf = $row->cpf;
                    $cliente->tipo = $row->tipo;

                }
                
            }catch(Exception $e){

                return "Ops, houve um erro em executar o $query. " . print_r($this->con->errorInfo());

            }

            return $cliente;
        }

        public function listarTodos(){

            $query  = " SELECT u.email, c.nome, c.id  as cliente_id, c.tipo, c.cpf FROM clientes as c";
            $query .= " INNER JOIN usuarios as u on(c.id = u.cliente_id) order by c.id ";
        
            $stmt = $this->con->prepare( $query );

            try{

                if(!$row = $stmt->execute()){

                    $clientes = false;

                }else{
                    if($row = $stmt->fetchAll(PDO::FETCH_OBJ)){
                    
                        foreach($row as $row){
    
                            $cliente = new Cliente();
                            $cliente->cliente_id = $row->cliente_id;
                            $cliente->nome = $row->nome;
                            $cliente->email = $row->email;
                            $cliente->cpf = $row->cpf;
                            $cliente->tipo = $row->tipo;    
    
                            $clientes[] = $cliente;
                        }
                    }
                }
                

            }catch(Exception $e){

                return "Ops, houve um erro em executar o $query. " . print_r($this->con->errorInfo());

            }

            return $clientes;
        }
    }
?>