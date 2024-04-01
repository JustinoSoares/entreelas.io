<?php
define("host", "127.0.0.1");
define("db", "entreelas");
define("user", "root");
define("password", "Mila@123");

class Conexao
{
    private $conn;
    function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host=" . host . ";dbname=" . db . ";", user, password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Ocorreu um erro, porfavor tente acessa essa página mais tarde";
        }
    }
    public function getConexao()
    {
        return $this->conn;
    }
    public function fecharConexao(){
        $this->conn = null;
    }
}

