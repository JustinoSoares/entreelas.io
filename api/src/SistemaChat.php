<?php

namespace Api\Websoket;

use Exception;
use PDO;
use Ratchet\ConnectionInterface;
use Ratchet\WebSocket\MessageComponentInterface;

class SistemaChat implements MessageComponentInterface
{
  protected $cliente;

  public function __construct()
  {
    //iniciar o objecto que deve armazenar os clientes conetados
    $this->cliente = new \SplObjectStorage;
  }

  //criar a conexaão para o novo cliente
  public function onOpen(ConnectionInterface $conn)
  {
    //adicionar o cliente na lista
    $this->cliente->attach($conn);
    //mostra no termina o id da conexão
    echo "Nova conexão: {$conn->resourceId}\n\n";
  }
  //enviar mensagem para todos os users conectados
  public function onMessage(ConnectionInterface $from, $msg)
  {
    //percorrer a lista de user connectados
    foreach ($this->cliente as $cliente) {
      //Não enviar a mensagem para o user envio a msg
      if ($from !== $cliente) {
        //enviar as mensagens para os users
        $cliente->send($msg);
      }
    }
    //Chamar o método para salvar a mensagem no banco de dados
    $this->salvarMensagemNoBancoDeDados($msg);
    echo "O user {$from->resourceId} Enviou a mensagem \n\n";
  }
  //desconetar o cliente do servidor
  public function onClose(ConnectionInterface $conn)
  {
    //remover o cliente da lista
    $this->cliente->detach($conn);
    echo "O user {$conn->resourceId} desconectou";
  }

  //Funcão que será chamada caso aconteça um erro
  public function onError(ConnectionInterface $conn, Exception $e)
  {
    //fechar a connexão
    $conn->close();

    echo "O correu um erro {$e->getMessage()}";
  }

  private function salvarMensagemNoBancoDeDados($mensagem)

  {
    $dbConnection = new DbConnection();
    $conn = $dbConnection->getConnection();
    $queryMensagem = "INSERT INTO mensagems (conteudo,user_id, conversa_id) VALUES (:conteudo, :user_id,:conversa_id)";
    $addMensagem = $conn->prepare($queryMensagem);
    //decodificar a string json em um array associativo
    $mensagemArray = json_decode($mensagem, true);
    $addMensagem->bindParam(":conteudo", $mensagemArray["mensagem"]);
    $addMensagem->bindParam(":user_id", $mensagemArray["user_id"]);
    $addMensagem->bindParam(":conversa_id", $mensagemArray["conversa_id"]);
    $addMensagem->execute();
    // $resultMensagem = $addMensagem->fetch(PDO::FETCH_ASSOC);
    // if ($resultMensagem["tipo"] != "text") {
    //   $queryArquivo = "INSERT INTO arquivos (caminho,tipoArquivo,mensagem_id) VALUES (:caminho, :tipoArquivo,:mensagem_id)";
    //   $addArquivo = $conn->prepare($queryArquivo);
    //   $addArquivo->bindParam(":caminho", $mensagemArray["caminho"]);
    //   $addArquivo->bindParam(":tipoArquivo", $mensagemArray["tipoArquivo"]);
    //   $addArquivo->bindParam(":mensagem_id", $mensagemArray["mensagem_id"]);
    //   $addArquivo->execute();
      
    // }
  }
}
