<?php

class Conexao{

    private $host = "localhost";
    private $db = "teste";
    private $usuario = "root";
    private $senha = "";
    public $conn;
  
    public function conectar(){
  
        $this->conn = null;
  
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db.';charset=utf8', $this->usuario, $this->senha);
        }catch(PDOException $exception){
            echo "Erro de conexao: " . $exception->getMessage();
        }

        return $this->conn;
    }
    
}

?>