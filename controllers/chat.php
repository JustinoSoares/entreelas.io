<?php
session_start();
include_once "../config/database.php";

function deleteMsg($idMsg)
{
    $con = new Conexao();
    $conn = $con->getConexao();
    $query = "DELETE FROM mensagems where mensagems.id = ?";
    $cmd = $conn->prepare($query);
    $cmd->bindValue(1,$idMsg);
    if($cmd->execute()){
       $_SESSION["msg"] = "Mensagem deletada com sucesso";
       header("Location: ../views/chat.php?conversa_id={$_SESSION['conversa_id']}");  
       unset($_SESSION['conversa_id']);
       exit();
    }else{
        $_SESSION["msg"] = "Não foi possível deletar essa mensagem";
        header("Location: ../views/chat.php?conversa_id={$_SESSION['conversa_id']}"); 
        unset($_SESSION['conversa_id']);
        exit();
    }
   
}
