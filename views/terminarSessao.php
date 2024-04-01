<?php
session_start(); // Inicia a sessão, se ainda não estiver iniciada

session_unset();
$_SESSION = array();
// Encerra a sessão
session_destroy();
// Redireciona para a página de login
header("Location: login.php"); // Substitua "index.php" pelo caminho da página que você deseja redirecionar após o logout
exit();