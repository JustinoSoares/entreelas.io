<?php

session_start();
require_once ("../config/database.php");
 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
    $nome = trim($_POST["primeiroNome"]);
    $apelido=trim($_POST["apelido"]);
    $data_nascimento=trim($_POST["dataNasc"]);
    $email = trim($_POST["email"]);
    $password=trim($_POST["password"]);
    $confirmarSenha = trim($_POST["confirmar_senha"]);

    // Verificar se as senhas coincidem
    if ($password!== $confirmarSenha) {
        $_SESSION['msg'] = 'As senhas não coincidem. Tente novamente.';
        header('Location: ../views/cadastro.php');
        exit();
    }
    
        $conexao = new Conexao();
        $hashSenha = password_hash($password, PASSWORD_DEFAULT);
        $stmt=$conexao->getConexao()->prepare("SELECT id from users WHERE email= :email");
        $stmt->bindParam(":email", $email);
        $stmt->execute();
    
        if($stmt->fetch(PDO::FETCH_ASSOC)){
            $_SESSION["msg"]="Email já existe";
            header("Location: ../views/cadastro.php");
            exit();
        }else{
            $stmtCadastrar = $conexao->getConexao()->prepare(
                "INSERT INTO users (primeiroNome,apelido,dataNasc,email,password,created_at) VALUES (:nome,:apelido,:data_nascimento,:email,:password,NOW())"
        );
        $stmtCadastrar->bindParam(':nome', $nome);
        $stmtCadastrar->bindParam(':apelido', $apelido);
        $stmtCadastrar->bindParam(':data_nascimento', $data_nascimento);
        $stmtCadastrar->bindParam(':email', $email);
        $stmtCadastrar->bindParam(':password', $hashSenha);
            if($stmtCadastrar->execute()){
                $stmtSelect = $conexao->getConexao()->prepare("SELECT * from users where email = '$email'");
                $stmtSelect->execute();
                $dadosUsuario = $stmtSelect->fetch(PDO::FETCH_ASSOC);
                $_SESSION['users_id'] = $dadosUsuario['id'];
                $_SESSION['msg'] = 'Cadastro realizado com sucesso!';
                header('Location: ../views/listaCategoria.php');
            }
            else{
                $_SESSION["msg"]="Erro ao cadastrar o usuario!";
                header('Location: ../views/cadastro.php');
            }
        }    
        }
            catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }

       
    }
else {
        $_SESSION['msg'] = 'Erro ao cadastrar!';
        header('Location: ../views/cadastro.php');
        
       
        exit();
    }   
   if(isset( $_SESSION['msg'])){
    echo  $_SESSION['msg'];
   }
?>