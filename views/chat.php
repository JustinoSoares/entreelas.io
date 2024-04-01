<?php
session_start();
ob_start(); //limpar buffer de saída para evitar erros de redirecionamento
include_once "../config/database.php";

if (!isset($_SESSION["users_id"])) {
    header("Location: login.php");
    exit();
}
if (isset($_GET["conversa_id"])) {
    $conversa_id = $_GET["conversa_id"];
} else {
    header("Location: listaCategoria.php");
}
$con = new Conexao();
$conn = $con->getConexao();

$sql = "SELECT * FROM users WHERE id = ?";
$cmd = $conn->prepare($sql);
$cmd->bindValue(1, $_SESSION["users_id"]);
$cmd->execute();
$userAuth = $cmd->fetch(PDO::FETCH_ASSOC);

$sqlConversa = "SELECT * FROM categorias
inner join conversas
on conversas.categoria_id = categorias.id
where conversas.id = ?
limit 1
 ";
$cmd = $conn->prepare($sqlConversa);
$cmd->bindValue(1, $conversa_id);
$cmd->execute();
$conversaActual = $cmd->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CDN para o tailwindcss -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- CDN para o bootstrao Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Java script main -->
    <script src="../assets/js/main.js"></script>
    <!-- link para o css main -->
    <link rel="stylesheet" href="../assets/css/main.css">
    <!-- link para o css chat -->
    <link rel="stylesheet" href="../assets/css/chat.css">
    <!-- {{-- link para emoji o emoji no css --}} -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.css">


    <link rel="shortcut icon" href="../assets/img/Logo.png" type="image/x-icon">
    <title>EntreElas</title>
</head>

<body class="max-h-[90vh]">
    <!-- Cabeçalho do chat -->
    <header class="border-b-2 border-pink-700 bg-slate-800  z-50 pb-1 h-[4rem] fixed  w-full flex  justify-between px-2 items-center font-bold  text-lg">
        <div class="flex gap-2 items-center">
            <div class="ms-4 bg-white rounded-full w-12 h-12">
                <a href="inicio.php">
                   <img src="../assets/img/Logo.png" alt="" class="rounded-full bg-red-600 w-full h-full">  
                </a>
               
            </div>
            <div class="flex flex-col text-white justify-center w-[80vw]">

                <h2 class="text-start break-words"> <?= $conversaActual["tema"] ?></h2>
                <small class="text-sm text-start"><?= $userAuth["primeiroNome"] . " " . $userAuth["apelido"]; ?></small>
                <small id="nome" class="text-sm text-start hidden"><?= $userAuth["primeiroNome"]; ?></small>
                <small id="conversa_idJs" class="text-sm text-start hidden"><?= $conversa_id; ?></small>
            </div>
        </div>
        <aside class="">
            <i class="bi bi-three-dots-vertical text-white"></i>
        </aside>
    </header>
    <!-- Campo de mensagem -->
    <main class=" w-full  -z-10 main overflow-y-scroll  bg-slate-700 px-2 pt-20 pb-3" id="chatBox" style="height: 91vh;">
       <!-- <span><?= $conversaActual["conteudo"] ?></span>  -->
       <div class=" rounded-md w-auto max-w-[90%] md:max-w-[70%] flex justify-center mx-auto p-1">
       <span class="flex flex-col max-w-[70%]  bg-slate-600  text-center  text-yellow-200 justify-center p-2 my-1  rounded-md">
       <?= $conversaActual["conteudo"] ?>
       </span> 
       </div>
      
       <span id="mensagem-chat"></span>
       <dialog id="del_dialog_mensagem" class="w-[90%] md:w-[70%] lg:w-[40rem] h-[20rem] rounded-[5px] ">
       <span class="hidden" id="del_mensagem_id"></span>
        <form action="../controllers/chat.php" method="post">
             <h3>Tem a certeza que deseja deletar essa mensagem?</h3>
            <div id="del_cancelar" class="cursor-pointer">cancelar</div>
            <button type="submit">Deletar</button>
            <?php $_SESSION["conversa_id"] = $conversa_id?>
        </form>
           
    
       </dialog>
    </main>
    <!-- form para inserir as mensagens -->
    <form method="post" enctype="multipart/form-data" action="" class="flex items-center fixed bottom-0 inset-x-0 h-16 bg-slate-400  px-4">
        <div class=" bg-slate-300 z-auto flex items-center rounded-lg w-full  h-12 px-2">
            <!-- <div class="w-[15rem] absolute bottom-16 h-[20rem] rounded-md p-1 z-10 py-2 divMsg ">
                <div class="flex items-center p-2 transition-all cursor-pointer hover:bg-slate-400 rounded-lg">
                    <i class="bi bi-file-earmark-zip-fill text-slate-100 text-lg font-bold me-2"></i>
                    <p class="text-white">Arquivo Zipado</p>
                </div>
            </div> -->
            <span>
                <i class="bi bi-plus-circle-fill text-[20pt] text-pink-600 cursor-pointer"></i>
            </span>
            <!-- Local onde seram colocadas as mensagens -->
            <input type="text" placeholder="Escreve a mensagem" id="mensagem" oninput="verificarConteudo()" class="ms-2 h-8 border-noneoutline-none w-[100%] bg-slate-300 shadow-none border-none outline-none text-black">
            <!-- recuperando o id do user -->
            <input type="hidden" id="user_id" name="user_id" value="<?= $userAuth["id"]; ?>">
            <!-- recuperando o id da conversa -->
            <input type="hidden" id="conversa_id" name="conversa_id" value="<?= $conversa_id ?>">
            <br>
            <button type="submit" onclick="enviar()" id="btnSend" class="flex float-left">
                <i class="bi bi-send-fill text-[20pt]  text-pink-600 cursor-pointer"></i>
            </button>

        </div>
    </form>
</body>
<script src="../assets/js/custom.js">

</script>


</html>
<!-- {{-- //jquery --}} -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<!-- {{-- javascript para emoji  --}} -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.js"></script>

<script>
    //Colocar o emoji usando JQUERY
    //  $("#mensagem").emojioneArea({
    //      pickerPosition: 'top',
    //  })
</script>

<style>
    body {
        text-align: center;

    }
</style>