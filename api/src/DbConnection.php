<?php

namespace Api\Websoket;

use PDO;
use PDOException;

class DbConnection
{
  private  $host = "127.0.0.1";
  private  $user = "root";
  private  $pass = "Mila@123";
  private  $db = "entreelas";
  private  object $pdo;
  // public function __construct()
  // {
  //     $this->getConnection();
  // }
  public function getConnection()
  {
    try {
      $this->pdo = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db . ";", $this->user, $this->pass);
      $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $this->pdo;
      // echo "O país tem rumo";
    } catch (PDOException $e) {
      die("Erro família " . $e->getMessage());
    }
  }
  public function obterConexao()
  {
   
  }
}



