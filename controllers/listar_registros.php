<?php
//incluir o arquivo de conexão com o banco de dados
include_once "../config/database.php";
$con = new Conexao();
$conn = $con->getConexao();

//Definir quantidade de registros que deve ser retornado
$limit = 10;
//iniciar apartir do registro
$offset = filter_input(INPUT_GET, "offset", FILTER_SANITIZE_NUMBER_INT);
$conversaId = filter_input(INPUT_GET, "conversa_id", FILTER_SANITIZE_NUMBER_INT);
//recuperar os registros no banco de dados
$query_mensagens = "SELECT 
msg.id,
msg.user_id,
msg.conteudo,
msg.conversa_id,
msg.created_at,
users.primeiroNome,
users.apelido
FROM
mensagems as msg
LEFT JOIN
arquivos ON msg.id = arquivos.mensagem_id
LEFT JOIN 
users on users.id = msg.user_id
WHERE
msg.conversa_id = ?
ORDER BY msg.id desc
LIMIT ?
OFFSET ?
";

//preparar a query
$result_mensagens = $conn->prepare($query_mensagens);
$result_mensagens->bindValue(1, $conversaId,PDO::PARAM_INT);
$result_mensagens->bindValue(2, $limit,PDO::PARAM_INT);
$result_mensagens->bindValue(3, $offset, PDO::PARAM_INT);
//Executar a query do resultado das mensagens

$result_mensagens->execute();

//recuperar a quantidade de registros encontrada no banco de dados
$qtd_mensagens = $result_mensagens->rowCount();

//recuperar o total das mensagens np banco de dados
$query_total_mensagens = "SELECT count(id) AS total_mensagens FROM mensagems";
//preparar a query
$qtd_total_mensagens = $conn->prepare($query_total_mensagens);
//executar o resultado da mensagem 
$qtd_total_mensagens->execute();
//pegar a quantidade de de mesagens
$result_total_mensagens = $qtd_total_mensagens->fetch(PDO::FETCH_ASSOC);

//verificar se tem mensagens no banco de dados 
if(($result_mensagens) && $result_mensagens->rowCount() != 0){

        //inicializar a variável que recebe os dados
        $dados = "";

       // pegar todas as mensagns 
       $dados =  $result_mensagens->fetchAll(PDO::FETCH_ASSOC);
       
        //criar um array de retorno quando encontrar mensagens do banco de dados
    $retorno = [
        "status" => true,
        "dados" => $dados,
        "qtd_mensagens" => $qtd_mensagens,
        "total_mensagens" => $result_total_mensagens["total_mensagens"]
    ];
}else{
    //criar um array de retorno quando não encontrar mensagens do banco de dados

    $retorno = [
        "status" => false,
        "msg" => "Sem mais mensagens"
    ];

}
// header('Content-Type: application/json');
//retornar o objeto 
echo json_encode($retorno);



