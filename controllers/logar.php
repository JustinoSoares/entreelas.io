<?php

require_once("../config/database.php");


if($_SERVER["REQUEST_METHOD"] === "POST"){
    $conexao =new Conexao();

    $email = trim($_POST['email']);
    $password=trim($_POST['password']);

    $stmt=$conexao->getConexao()->prepare("SELECT id, email, password FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $dadosUsuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($dadosUsuario && password_verify($password, $dadosUsuario['password'])) {
        session_start();
        $_SESSION['users_id'] = $dadosUsuario['id'];
        $_SESSION['msg']="Seja Bem-Vindo ";
        header('Location: ../views/chat.php');
        exit();
    } else {
        session_start();
        $_SESSION['msg']="Email e/ou senha incorretos";
        header('Location: ../views/login.php');
        exit();
    }
} else {
    header('Location: ../views/inicio.php');
    exit();
}

?>





