<?php

    class Usuario{
        
    private $con;

    public $email; 
    public $senha;
    public $sessao;
    public $timestamp;

    public function __construct($db = null){
        $this->con = $db;
    }

    public function fazer_login(){

        $query  = " SELECT u.email, c.nome, c.id as cliente_id, c.cpf, c.tipo FROM clientes as c";
        $query .= " LEFT JOIN usuarios as u on(c.id = u.cliente_id)  WHERE ";
        $query .= " u.email =:email and senha=:senha";

        $stmt = $this->con->prepare($query);

        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":senha", $this->senha);

        if($row = $stmt->execute()){

            $row = $stmt->fetch(PDO::FETCH_OBJ);
            $_SESSION['usuario']['login'] = true;
            $_SESSION['usuario']['cliente_id']  = $row->cliente_id;
            $_SESSION['usuario']['nome']  = $row->nome;
            $_SESSION['usuario']['cpf']  = $row->cpf;
            $_SESSION['usuario']['tipo']  = $row->tipo;
            $_SESSION['usuario']['email'] = $row->email;
        
            return true;
        }else{
            $_SESSION['usuario']['login'] = false;
            return false;
        }
        }

        public function logado(){
            return ( $_SESSION['usuario']['login'] ? true : false);
        }

        public function logout(){

            if($_SESSION['usuario']['login']){
                unset($_SESSION['usuario']);
                if(!$_SESSION['usuario']['login']){
                    return true;
                }else{
                    return false;
                }
            }

            
        }
    
    }

   
?>