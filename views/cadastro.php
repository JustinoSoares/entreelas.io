<?php
//require_once "../controllers/cadastrar.php";
session_start();



?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- LINK para fonts do Projecto -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300;400;500;600;700;800;900&family=Lato:wght@300;400;700;900&family=Montserrat:wght@200;300;400;500;600;700;800;900&family=Nunito:wght@200;300;400;500;600;700;800;900&family=Open+Sans:wght@400;500;600;700;800&family=Poppins:wght@200;300;400;500;600;700;800;900&family=Roboto:wght@100;400;500;700;900&display=swap" rel="stylesheet" />
  <!-- Link para o tailwindcss -->
  <link rel="stylesheet" href="../assets/dist/tailwind.css" />
  <!-- CDN para o bootstrao Icon -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
  <!-- Java script main -->

  <script src="../assets/js/cadastro.js" defer></script>
  <!-- link para o css main -->
  <link rel="stylesheet" href="../assets/css/main.css" />
  <!-- {{-- link para emoji o emoji no css --}} -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.css" integrity="sha512-0Nyh7Nf4sn+T48aTb6VFkhJe0FzzcOlqqZMahy/rhZ8Ii5Q9ZXG/1CbunUuEbfgxqsQfWXjnErKZosDSHVKQhQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Colocar icon na url -->
  <link rel="shortcut icon" href="../assets/img/Logo.png" type="image/x-icon" />
  <title>EntreElas</title>
</head>

<style></style>


<body>
  <main class="w-full flex items-center justify-center h-screen retrato-tablet:px-7 px-6">
    <div class="cardCadastro max-w-3xl w-full">
      <header>
        <div class="flex justify-center py-5">
          <a href="cadastro.php">
            <img src="../assets/img/Logo.png" class="w-12 h-12" alt="logomarca-EntreElas" />
          </a>
        </div>
      </header>
      <form method="post" action="../controllers/cadastrar.php" class="w-full">
        <?php
        if (isset($_SESSION["msg"])) {
          echo $_SESSION["msg"];
          unset($_SESSION["msg"]);
        }
        ?>
        <div class="w-full grid grid-cols-1 gap-4 justify-center">
          <div class="grid retrato-tablet:grid-cols-2 grid-cols-1 items-center gap-4">
            <input type="text" class="px-4 py-3 rounded-lg bg-white ring-1 ring-zinc-200 outline-none focus:ring-pink-300 focus:shadow-md transition-all" name="primeiroNome" id="firstName" placeholder="Insira seu Primeiro Nome" />
            <input type="text" class="px-4 py-3 rounded-lg bg-white ring-1 ring-zinc-200 outline-none focus:ring-pink-300 focus:shadow-md transition-all" name="apelido" id="apelido" placeholder="Insira seu Apelido" />
          </div>
          <div class="grid retrato-tablet:grid-cols-2 grid-cols-1 items-center gap-4">
            <input type="email" class="px-4 py-3 rounded-lg bg-white ring-1 ring-zinc-200 outline-none focus:ring-pink-300 focus:shadow-md transition-all" name="email" id="email" placeholder="E-mail" />
            <input type="date"  class="px-4 py-3 rounded-lg text-slate-700 bg-white ring-1 ring-zinc-200 outline-none focus:ring-pink-300 focus:shadow-md transition-all" name="dataNasc" id="data_nascimento" />
          </div>
          <div class="grid retrato-tablet:grid-cols-2 grid-cols-1 items-center gap-4">
            <div class="flex items-center rounded-lg bg-white justify-between ring-1 ring-zinc-200 outline-none focus-within:ring-pink-300 focus-within:shadow-md transition-all">
              <input type="password" class="px-4 py-3 w-full rounded-lg outline-none" name="password" id="senha" placeholder="Crie uma Senha" />
              <button onclick="showPassword('senha')" class="text-slate-600 pe-3 visiblePasswordSenha transition-all hover:text-slate-800" title="Visbilidade de Senha" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
              </button>
            </div>
            <div class="flex items-center rounded-lg bg-white ring-1 ring-zinc-200 outline-none focus-within:ring-pink-300 focus-within:shadow-md transition-all">
              <input type="password" class="px-4 py-3 rounded-lg outline-none" name="confirmar_senha" id="confirmar_senha" placeholder="Confirme a Senha" />
            </div>
          </div>
          <div class="flex justify-between flex-wrap gap-3 small:justify-center items-center">
            <button class="px-5 py-2.5 rounded-lg bg-pink-500 text-white font-medium transition-all hover:bg-pink-600">Cadastrar</button>
            <a href="inicio.php" class="px-5 py-2.5 rounded-lg ring-2 ring-zinc-200 text-pink-500 font-medium transition-all hover:ring-zinc-300">Cancelar</a>
          </div>
        </div>
      </form>
    </div>
    <span class="hidden closed-eye">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
      </svg>
    </span>
  </main>


</body>

</html>
<!-- {{-- javascript para emoji  --}} -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.js" integrity="sha512-hkvXFLlESjeYENO4CNi69z3A1puvONQV5Uh+G4TUDayZxSLyic5Kba9hhuiNLbHqdnKNMk2PxXKm0v7KDnWkYA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- {{-- //jquery --}} -->
<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
