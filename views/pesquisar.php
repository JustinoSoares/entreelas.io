<?php
session_start();
require_once "../config/database.php";
$con = new Conexao();
$conn = $con->getConexao();

$sqlConversa = "SELECT * FROM categorias
inner join conversas
on conversas.categoria_id = categorias.id
where tema like  '%".$_GET['pesquisa']."%'
 ";
$cmd = $conn->prepare($sqlConversa);
$cmd->execute();
$_SESSION["todasCategorias"]  = $cmd->fetchAll(PDO::FETCH_ASSOC);
header("Location: listaCategoria.php?pesquisa=".$_GET["pesquisa"]);
?>