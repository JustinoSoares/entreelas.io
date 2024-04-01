<?php
session_start();

include_once "../config/database.php";

$con = new Conexao();
$conn = $con->getConexao();

if(!isset($_SESSION["users_id"])){
  header("Location: login.php");
}
if(!isset($_SESSION["conversa_id"])){
  header("Location: categoria.php");
}
//QUERY PARA SELECIONAR O USER AUTENTICADO
$query = "SELECT * FROM users where id = ?";
$cmd = $conn->prepare($query);
$cmd->bindParam(1, $_SESSION['users_id'], PDO::PARAM_INT);
$userAuth = $cmd->fetch(PDO::FETCH_ASSOC);

//QUERY PARA SELECIONAR TODAS AS MENSAGEM DESSA CONVERSA
$queryMensagem = "SELECT * FROM mensagems WHERE conversa_id = ?";
$cmdMensagem = $conn->prepare($query);
$cmd->bindParam(1, $_SESSION['users_id'], PDO::PARAM_INT);
$userAuth = $cmd->fetch(PDO::FETCH_ASSOC);

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

<body class="h-full  ">
    <header class="bg-pink-600 h-[4rem] flex justify-between px-2 items-center font-bold  text-lg">
        <div class="flex gap-2 items-center">
            <div class="ms-4 bg-white rounded-full w-12 h-12">
                <img src="#" alt="" class="rounded-full">
            </div>
            <div class="flex flex-col text-white justify-center">
                <h2>Nome</h2>
                <small class="text-sm">Chat</small>
            </div>
        </div>
        <aside class="">
            <i class="bi bi-three-dots-vertical text-white"></i>

        </aside>
    </header>
    <main class=" w-full  -z-10 main overflow-y-scroll px-2 py-1" style="height: 76.5vh;">
        <!-- Parte onde irá ficar a primeira mensagem -->
        <div class="flex ms-5  justify-start">
            <p class="flex flex-col max-w-[70%] bg-slate-200  text-justify  text-black justify-center p-2 my-1  rounded-md">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab ratione in suscipit velit cumque consectetur corrupti ullam enim maxime, blanditiis cupiditate officia numquam, at non explicabo saepe, asperiores ea porro.
                <small class="flex justify-end text-slate-700">123</small>
            <p>

        </div>
        <div class="flex justify-end me-5 my-1">
            <p class="flex flex-col max-w-[70%] bg-pink-600 text-white text-justify  justify-center relative p-2 rounded-md my1">
                ptatem similique?
                <small class="flex justify-end">123</small>
            </p>
        </div>

    </main>

    <form method="post" enctype="multipart/form-data" action="../controllers/chat.php" class="flex items-center fixed bottom-0 inset-x-0 h-16 bg-slate-400  px-4">
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
            <input type="text" id="myText" class="ms-2 h-8 border-noneoutline-none w-[100%] bg-transparent " style="color: white !important;">
            <button type="submit" class="flex float-left">
                <i class="bi bi-send-fill text-[20pt] text-pink-600 cursor-pointer"></i>
            </button>
        </div>
    </form>
</body>

</html>
<!-- {{-- javascript para emoji  --}} -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.js"></script>
<!-- {{-- //jquery --}} -->
<script>
    //Colocar o emoji usando JQUERY
    $("#myText").emojioneArea({
        pickerPosition: 'top',
    })
</script>