<?php
session_start();
require_once "../config/database.php";
$con = new Conexao();
$conn = $con->getConexao();

$sqlConversa = "SELECT * FROM categorias
inner join conversas
on conversas.categoria_id = categorias.id
ORDER BY categorias.id desc
limit 3
 ";
$cmd = $conn->prepare($sqlConversa);
$cmd->execute();
$todasCategorias = $cmd->fetchAll(PDO::FETCH_ASSOC);
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
  <script src="../assets/js/main.js" defer></script>
  <!-- link para o css main -->
  <link rel="stylesheet" href="../assets/css/main.css" />
  <!-- {{-- link para emoji o emoji no css --}} -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.css" integrity="sha512-0Nyh7Nf4sn+T48aTb6VFkhJe0FzzcOlqqZMahy/rhZ8Ii5Q9ZXG/1CbunUuEbfgxqsQfWXjnErKZosDSHVKQhQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Colocar icon na url -->
  <link rel="shortcut icon" href="../assets/img/Logo.png" type="image/x-icon" />
  <!-- ANIAMATION ELEMETS -->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
  <title>EntreElas</title>
</head>

<body>
  <header class="w-full transition-all header-container bg-transparent z-40 fixed top-0 left-0 right-0">
    <div data-aos="fade-down" data-aos-duration="1000" class="navbar max-w-7xl w-full m-auto relative flex items-center justify-between border-gray-300 px-5 paisagem-tablet:py-4 py-3">
      <div>
        <a href="inicio.php">
          <img src="../assets/img/Logo.png" class="w-12 h-12" alt="logomarca-EntreElas" />
        </a>
      </div>
      <div>
        <nav>
          <ul class="flex items-center paisagem-tablet:space-x-7 space-x-3">
            <li class="paisagem-tablet:inline-block hidden">
              <a href="#objectivos" class="text-slate-800 transition-all text-[15px] font-medium hover:text-pink-500">Objectivos</a>
            </li>

            <li class="paisagem-tablet:inline-block hidden">
              <a href="#categorias" class="text-slate-800 transition-all text-[15px] font-medium hover:text-pink-500">Categorias</a>
            </li>

            <li class="paisagem-tablet:inline-block hidden">
              <a href="#avaliacoes" class="text-zinc-900 transition-all text-[15px] font-medium hover:text-pink-500">Avaliações
              </a>
            </li>
            <li class="paisagem-tablet:inline-block hidden">
              <button id="guia" class="text-zinc-900 guia transition-all text-[15px] font-medium hover:text-pink-500">
                Guia
              </button>
            </li>
            <?php if(!isset($_SESSION["users_id"])){ ?>
            <li class="paisagem-tablet:inline-block hidden">
              <a href="../views/login.php" class="flex items-center tetx-[15px] bg-pink-500 rounded-full px-5 font-medium py-2 text-white transition-all hover:bg-pink-600">
                Entrar
              </a>
            </li>
            <?php }else{ ?>
              <li class="paisagem-tablet:inline-block hidden">
              <a href="../views/terminarSessao.php" class="flex items-center tetx-[15px] bg-pink-500 rounded-full px-5 font-medium py-2 text-white transition-all hover:bg-pink-600">
                Terminar Sessão
              </a>
            </li>
            <?php } ?>

            <li>
              <a href="#" title="Login" class="w-10 h-10 rounded-full bg-pink-400 transition-all hover:ring-4 ring-opacity-50 ring-pink-300 flex items-center justify-center text-white paisagem-tablet:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
              </a>
            </li>
            <button onclick="openOffCanvas()" title="Menu" class="w-10 h-10 rounded-full bg-pink-400 flex items-center justify-center text-white transition-all hover:ring-4 ring-opacity-50 ring-pink-300 paisagem-tablet:hidden">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.6" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
              </svg>
            </button>
          </ul>
        </nav>
      </div>
    </div>
  </header>
  <main class="paisagem-tablet:w-[82%] retrato-tablet:w-[90%] w-full m-auto">
    <!-- HOMEPAGE -->
    <section id="inicio" class="HomePage paisagem-tablet:mt-28 mt-32 w-full" data-aos="fade-up" data-aos-duration="1000">
      <div class="grid paisagem-tablet:grid-cols-5 paisagem-tablet:gap-0 gap-2 grid-cols-1 items-center">
        <div class="col-span-2 paisagem-tablet:order-1 order-2 flex paisagem-tablet:justify-start justify-center">
          <img src="../assets/img/Texting-cuate.png" class="paisagem-tablet:w-full paisagem-tablet:h-auto retrato-tablet:w-96 retrato-tablet:h-96 w-80 h-80" alt="ilustração-mulher-conversando" />
        </div>
        <div class="paisagem-tablet:text-start text-center px-5 col-span-3 paisagem-tablet:order-2 order-1">
          <h1 class="paisagem-tablet:text-4xl retrato-tablet:text-3xl text-2xl font-semibold retrato-tablet:font-bold text-slate-800">
            Mulheres em Diálogo: Fortalecendo Vozes, Inspirando Mudanças
          </h1>
          <p class="py-4 text-slate-800">
            Bem-vindo ao <span>Entre Elas</span>, um espaço dedicado ao
            empoderamento, diálogo e troca de experiências entre mulheres de
            diversas origens e perspectivas.
          </p>
          <div class="flex items-center retrato-tablet:flex-row flex-col paisagem-tablet:justify-start justify-center paisagem-tablet:gap-3 gap-2">
          <?php if(!isset($_SESSION["users_id"])){ ?>
            <a href="cadastro.php" class="tetx-[15px] paisagem-tablet:inline-block block small:w-full mt-4 bg-pink-500 rounded-full px-5 font-medium py-2.5 text-white transition-all hover:bg-pink-600">
              Iniciar Agora
            </a>
            <?php } ?>
            <button class="tetx-[15px] guia paisagem-tablet:inline-block block small:w-full mt-4 bg-slate-800 rounded-full px-5 font-medium py-2.5 text-white transition-all hover:bg-slate-600">
              Acessar o Guia
            </button>
          </div>
        </div>
      </div>
    </section>
    <!-- OBJECTIVOS -->
    <section data-aos="fade-up" data-aos-duration="1000" data-offset="350" id="objectivos" class="firstSection About w-full mt-16 paisagem-tablet:px-0 px-4">
      <header class="text-center">
        <h2 class="retrato-tablet:text-3xl text-2xl text-slate-900 font-norma">
          Saiba mais Sobre Nós!
        </h2>
        <p class="py-4 text-slate-800 paisagem-tablet:w-4/5 w-full paisagem-tablet:px-0 px-1 m-auto">
          Nosso objetivo é criar uma comunidade inclusiva e acolhedora, onde
          mulheres podem compartilhar suas histórias, desafios e sucessos.
          Seja você uma estudante, profissional, mãe, artista ou qualquer
          outra identidade que escolha abraçar, este é um lugar para você se
          expressar livremente.
        </p>
      </header>

      <div class="grid mt-5 retrato-tablet:grid-cols-2 paisagem-tablet:grid-cols-3 grid-cols-1 gap-3">
        <div data-aos="fade-right" data-aos-duration="1000" data-offset="500" class="p-5 bg-white rounded-lg shadow-md flex flex-col justify-between">
          <div class="w-12 h-12 rounded flex items-center justify-center text-pink-600">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
              <path d="M11.7 2.805a.75.75 0 01.6 0A60.65 60.65 0 0122.83 8.72a.75.75 0 01-.231 1.337 49.949 49.949 0 00-9.902 3.912l-.003.002-.34.18a.75.75 0 01-.707 0A50.009 50.009 0 007.5 12.174v-.224c0-.131.067-.248.172-.311a54.614 54.614 0 014.653-2.52.75.75 0 00-.65-1.352 56.129 56.129 0 00-4.78 2.589 1.858 1.858 0 00-.859 1.228 49.803 49.803 0 00-4.634-1.527.75.75 0 01-.231-1.337A60.653 60.653 0 0111.7 2.805z" />
              <path d="M13.06 15.473a48.45 48.45 0 017.666-3.282c.134 1.414.22 2.843.255 4.285a.75.75 0 01-.46.71 47.878 47.878 0 00-8.105 4.342.75.75 0 01-.832 0 47.877 47.877 0 00-8.104-4.342.75.75 0 01-.461-.71c.035-1.442.121-2.87.255-4.286A48.4 48.4 0 016 13.18v1.27a1.5 1.5 0 00-.14 2.508c-.09.38-.222.753-.397 1.11.452.213.901.434 1.346.661a6.729 6.729 0 00.551-1.608 1.5 1.5 0 00.14-2.67v-.645a48.549 48.549 0 013.44 1.668 2.25 2.25 0 002.12 0z" />
              <path d="M4.462 19.462c.42-.419.753-.89 1-1.394.453.213.902.434 1.347.661a6.743 6.743 0 01-1.286 1.794.75.75 0 11-1.06-1.06z" />
            </svg>
          </div>

          <div class="pt-8">
            <h5 class="font-medium text-zinc-800">Aprendizado</h5>
            <p class="text-[14px] py-3 text-zinc-700">
              Nosso objetivo é criar uma comunidade inclusiva e acolhedora,
              onde mulheres podem compartilhar suas histórias, desafios e
              sucessos.
            </p>
          </div>
        </div>
        <div data-aos="fade-up" data-aos-duration="1000" data-offset="500" class="p-5 bg-white rounded-lg shadow-md flex flex-col justify-between">
          <div class="w-12 h-12 rounded flex items-center justify-center text-pink-600">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
              <path fill-rule="evenodd" d="M12 2.25a.75.75 0 01.75.75v.756a49.106 49.106 0 019.152 1 .75.75 0 01-.152 1.485h-1.918l2.474 10.124a.75.75 0 01-.375.84A6.723 6.723 0 0118.75 18a6.723 6.723 0 01-3.181-.795.75.75 0 01-.375-.84l2.474-10.124H12.75v13.28c1.293.076 2.534.343 3.697.776a.75.75 0 01-.262 1.453h-8.37a.75.75 0 01-.262-1.453c1.162-.433 2.404-.7 3.697-.775V6.24H6.332l2.474 10.124a.75.75 0 01-.375.84A6.723 6.723 0 015.25 18a6.723 6.723 0 01-3.181-.795.75.75 0 01-.375-.84L4.168 6.241H2.25a.75.75 0 01-.152-1.485 49.105 49.105 0 019.152-1V3a.75.75 0 01.75-.75zm4.878 13.543l1.872-7.662 1.872 7.662h-3.744zm-9.756 0L5.25 8.131l-1.872 7.662h3.744z" clip-rule="evenodd" />
            </svg>
          </div>

          <div class="pt-8">
            <h5 class="font-medium text-zinc-800">Igualdade</h5>
            <p class="text-[14px] py-3 text-zinc-700">
              Nosso objetivo é criar uma comunidade inclusiva e acolhedora,
              onde mulheres podem compartilhar suas histórias, desafios e
              sucessos.
            </p>
          </div>
        </div>
        <div data-aos="fade-left" data-aos-duration="1000" data-offset="500" class="p-5 bg-pink-600 rounded-lg shadow-md flex flex-col justify-between">
          <div class="w-12 h-12 rounded flex items-center justify-center text-white bg-transparent">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
              <path fill-rule="evenodd" d="M14.615 1.595a.75.75 0 01.359.852L12.982 9.75h7.268a.75.75 0 01.548 1.262l-10.5 11.25a.75.75 0 01-1.272-.71l1.992-7.302H3.75a.75.75 0 01-.548-1.262l10.5-11.25a.75.75 0 01.913-.143z" clip-rule="evenodd" />
            </svg>
          </div>

          <div class="pt-8">
            <h5 class="font-medium text-pink-100">Experiência</h5>
            <p class="text-[14px] py-3 text-white">
              Nosso objetivo é criar uma comunidade inclusiva e acolhedora,
              onde mulheres podem compartilhar suas histórias, desafios e
              sucessos.
            </p>
          </div>
        </div>
        <div data-aos="fade-right" data-aos-duration="1000" data-offset="600" class="p-5 bg-white rounded-lg shadow-md flex flex-col justify-between">
          <div class="w-12 h-12 rounded flex items-center justify-center text-pink-600">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
              <path fill-rule="evenodd" d="M8.25 6.75a3.75 3.75 0 117.5 0 3.75 3.75 0 01-7.5 0zM15.75 9.75a3 3 0 116 0 3 3 0 01-6 0zM2.25 9.75a3 3 0 116 0 3 3 0 01-6 0zM6.31 15.117A6.745 6.745 0 0112 12a6.745 6.745 0 016.709 7.498.75.75 0 01-.372.568A12.696 12.696 0 0112 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 01-.372-.568 6.787 6.787 0 011.019-4.38z" clip-rule="evenodd" />
              <path d="M5.082 14.254a8.287 8.287 0 00-1.308 5.135 9.687 9.687 0 01-1.764-.44l-.115-.04a.563.563 0 01-.373-.487l-.01-.121a3.75 3.75 0 013.57-4.047zM20.226 19.389a8.287 8.287 0 00-1.308-5.135 3.75 3.75 0 013.57 4.047l-.01.121a.563.563 0 01-.373.486l-.115.04c-.567.2-1.156.349-1.764.441z" />
            </svg>
          </div>

          <div class="pt-8">
            <h5 class="font-medium text-zinc-800">Colectividade</h5>
            <p class="text-[14px] py-3 text-zinc-700">
              Nosso objetivo é criar uma comunidade inclusiva e acolhedora,
              onde mulheres podem compartilhar suas histórias, desafios e
              sucessos.
            </p>
          </div>
        </div>
        <div data-aos="fade-up" data-aos-duration="1000" data-offset="600" class="p-5 bg-pink-600 rounded-lg shadow-md flex flex-col justify-between">
          <div class="w-12 h-12 rounded flex items-center justify-center text-white bg-transparent">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
              <path d="M4.913 2.658c2.075-.27 4.19-.408 6.337-.408 2.147 0 4.262.139 6.337.408 1.922.25 3.291 1.861 3.405 3.727a4.403 4.403 0 00-1.032-.211 50.89 50.89 0 00-8.42 0c-2.358.196-4.04 2.19-4.04 4.434v4.286a4.47 4.47 0 002.433 3.984L7.28 21.53A.75.75 0 016 21v-4.03a48.527 48.527 0 01-1.087-.128C2.905 16.58 1.5 14.833 1.5 12.862V6.638c0-1.97 1.405-3.718 3.413-3.979z" />
              <path d="M15.75 7.5c-1.376 0-2.739.057-4.086.169C10.124 7.797 9 9.103 9 10.609v4.285c0 1.507 1.128 2.814 2.67 2.94 1.243.102 2.5.157 3.768.165l2.782 2.781a.75.75 0 001.28-.53v-2.39l.33-.026c1.542-.125 2.67-1.433 2.67-2.94v-4.286c0-1.505-1.125-2.811-2.664-2.94A49.392 49.392 0 0015.75 7.5z" />
            </svg>
          </div>

          <div class="pt-8">
            <h5 class="font-medium text-pink-100">Discussões</h5>
            <p class="text-[14px] py-3 text-white">
              Nosso objetivo é criar uma comunidade inclusiva e acolhedora,
              onde mulheres podem compartilhar suas histórias, desafios e
              sucessos.
            </p>
          </div>
        </div>
        <div data-aos="fade-left" data-aos-duration="1000" data-offset="600" class="p-5 bg-white rounded-lg shadow-md flex flex-col justify-between">
          <div class="w-12 h-12 rounded flex items-center justify-center text-pink-600">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
              <path fill-rule="evenodd" d="M4.5 5.653c0-1.426 1.529-2.33 2.779-1.643l11.54 6.348c1.295.712 1.295 2.573 0 3.285L7.28 19.991c-1.25.687-2.779-.217-2.779-1.643V5.653z" clip-rule="evenodd" />
            </svg>
          </div>

          <div class="pt-8">
            <h5 class="font-medium text-zinc-800">Vamos Lá!</h5>
            <p class="text-[14px] py-3 text-zinc-700">
              Nosso objetivo é criar uma comunidade inclusiva e acolhedora,
              onde mulheres podem compartilhar!
            </p>
            <a href="#" class="px-4 py-1 rounded-full bg-pink-600 text-[14px] text-white transition-all hover:bg-pink-700 font-medium">Iniciar</a>
          </div>
        </div>
      </div>
    </section>

    <!-- CATEGORIAS -->
    <section id="categorias" class="secondSection Categories w-full mt-16" data-aos="fade-up" data-aos-duration="1000" data-offset="700">
      <header class="text-center">
        <h2 class="retrato-tablet:text-3xl text-2xl text-slate-900 font-normal">
          Escolha Um Tema!
        </h2>
        <p class="py-4 text-slate-800 paisagem-tablet:w-4/5 w-full m-auto paisagem-tablet:px-0 px-4">
          Bem-vindo ao nosso vibrante espaço de debates! Aqui, você tem a
          oportunidade de expressar suas opiniões, trocar ideias e se envolver
          em discussões significativas. Para começar, escolha uma categoria
          que mais se alinha aos seus interesses:
        </p>
      </header>

      <h5 class="pt-5 ps-4 text-zinc-700 font-medium" data-aos="fade-left" data-aos-duration="1000" data-offset="700">
        Temas Disponíveis
      </h5>
      
      <div data-aos="fade-left" data-aos-duration="1000" data-offset="850" class="grid retrato-tablet:grid-cols-2 grid-cols-1 paisagem-tablet:grid-cols-3 gap-4 p-4 mt-2">
      <?php foreach ($todasCategorias  as $categoria) {
        ?>
      <div class="p-5 rounded-lg bg-white shadow-md">
          <header>
            <h6 class="text-pink-600 font-medium">
            <?php echo $categoria["tema"]; ?>
            </h6>
          </header>
          <div class="flex items-center justify-between pt-3">
            <div>
              <p class="text-zinc-700 text-[14px]">
                <!-- Mensagens: <span>55</span> -->
                Explore
              </p>
            </div>
            <a href="chat.php?conversa_id=<?php echo $categoria["id"];?>" class="text-white bg-pink-600 font-medium rounded-full px-5 py-1 text-[14px] transition-all hover:ring-4 ring-pink-400 ring-opacity-50">Entrar</a>
          </div>
        </div>
        <?php } ?>
        <!-- <div class="p-5 rounded-lg bg-white shadow-md">
          <header>
            <h6 class="text-pink-600 font-medium">Casamento Forte</h6>
          </header>
          <div class="flex items-center justify-between pt-3">
            <div>
              <p class="text-zinc-700 text-[14px]">
                Mensagens: <span>300</span>
              </p>
            </div>
            <a href="#" class="text-white bg-pink-600 font-medium rounded-full px-5 py-1 text-[14px] transition-all hover:ring-4 ring-pink-400 ring-opacity-50">Entrar</a>
          </div>
        </div>
        <div class="p-5 rounded-lg bg-white shadow-md">
          <header>
            <h6 class="text-pink-600 font-medium">Saúde da Mulher</h6>
          </header>
          <div class="flex items-center justify-between pt-3">
            <div>
              <p class="text-zinc-700 text-[14px]">
                Mensagens: <span>100</span>
              </p>
            </div>
            <a href="#" class="text-white bg-pink-600 font-medium rounded-full px-5 py-1 text-[14px] transition-all hover:ring-4 ring-pink-400 ring-opacity-50">Entrar</a>
          </div>
        </div>
        <div class="p-5 rounded-lg bg-white shadow-md">
          <header>
            <h6 class="text-pink-600 font-medium">Educação Sexual</h6>
          </header>
          <div class="flex items-center justify-between pt-3">
            <div>
              <p class="text-zinc-700 text-[14px]">
                Mensagens: <span>78</span>
              </p>
            </div>
            <a href="#" class="text-white bg-pink-600 font-medium rounded-full px-5 py-1 text-[14px] transition-all hover:ring-4 ring-pink-400 ring-opacity-50">Entrar</a>
          </div>
        </div>
        <div class="p-5 rounded-lg bg-white shadow-md">
          <header>
            <h6 class="text-pink-600 font-medium">Namoro Cristão</h6>
          </header>
          <div class="flex items-center justify-between pt-3">
            <div>
              <p class="text-zinc-700 text-[14px]">
                Mensagens: <span>89</span>
              </p>
            </div>
            <a href="#" class="text-white bg-pink-600 font-medium rounded-full px-5 py-1 text-[14px] transition-all hover:ring-4 ring-pink-400 ring-opacity-50">Entrar</a>
          </div>
        </div>
        <div class="p-5 rounded-lg bg-white shadow-md">
          <header>
            <h6 class="text-pink-600 font-medium">Deveres da Mulher</h6>
          </header>
          <div class="flex items-center justify-between pt-3">
            <div>
              <p class="text-zinc-700 text-[14px]">
                Mensagens: <span>233</span>
              </p>
            </div>
            <a href="#" class="text-white bg-pink-600 font-medium rounded-full px-5 py-1 text-[14px] transition-all hover:ring-4 ring-pink-400 ring-opacity-50">Entrar</a>
          </div>
        </div> -->
      </div>

      <div class="flex justify-center">
        <a href="listaCategoria.php" class="text-white px-5 py-2.5 rounded-full font-medium inline-block mt-6 bg-pink-500 transition-all hover:bg-pink-600">Mais Categorias</a>
      </div>
    </section>

    <!-- AVALIAÇÕES -->
    <section id="avaliacoes" class="thirdSection Reviews w-full mt-16" data-aos="fade-up" data-aos-duration="1000" data-offset="950">
      <header class="text-center">
        <h3 class="text-2xl font-normal text-slate-900">
          Outras Pessoas Dizem...
        </h3>
      </header>
      <div class="grid grid-cols-1 gap-3 mt-8 max-w-3xl w-full m-auto">
        <div class="p-5">
          <header class="flex items-center space-x-4 px-3">
            <img src="https://picsum.photos/200/200" class="w-10 h-10 ring-2 ring-offset-2 ring-pink-300 rounded-full" alt="imagem-exemplar de Utilizador" />
            <p class="text-slate-900 font-medium">Maria Mendonça</p>
          </header>

          <p class="py-4 text-[15px] text-zinc-700">
            Excelente plataforma para mulheres que desejam fazer a diferença!
            As categorias são abrangentes, os debates são construtivos e a
            equipe de moderação faz um trabalho excepcional. Parabéns!
          </p>
          <small class="date text-zinc-500 font-['Inter']">10/11/2023</small>
        </div>
        <div class="p-5">
          <header class="flex items-center space-x-4 px-3">
            <img src="https://picsum.photos/3/400" class="w-10 h-10 ring-2 ring-offset-2 ring-pink-300 rounded-full" alt="imagem-exemplar de Utilizador" />
            <p class="text-slate-900 font-medium">Maria Mendonça</p>
          </header>

          <p class="py-4 text-[15px] text-zinc-700">
            Adoro este site! As discussões são incríveis e a diversidade de
            perspectivas é inspiradora. É um espaço tão acolhedor para
            mulheres compartilharem suas histórias e opiniões. Recomendo a
            todas!
          </p>
          <small class="date text-zinc-500 font-['Inter']">13/10/2023</small>
        </div>
        <div class="p-5">
          <header class="flex items-center space-x-4 px-3">
            <img src="https://picsum.photos/200/300" class="w-10 h-10 ring-2 ring-offset-2 ring-pink-300 rounded-full" alt="imagem-exemplar de Utilizador" />
            <p class="text-slate-900 font-medium">Luzia Carlos</p>
          </header>

          <p class="py-4 text-[15px] text-zinc-700">
            Onde estava este site toda a minha vida? Encontrei aqui um apoio
            incrível e aprendi tanto com as experiências das outras mulheres.
            A comunidade é forte e unida. Estou viciada em debater aqui!
          </p>
          <small class="date text-zinc-500 font-['Inter']">07/06/2023</small>
        </div>
      </div>
    </section>
  </main>

  <footer class="w-full p-5 bg-slate-950 mt-8">
    <div class="max-w-7xl justify-center w-full m-auto grid paisagem-tablet:grid-cols-3">
      <div class="midea text-center">
        <h6 class="text-slate-500 py-2">Redes Sociais</h6>
        <ul class="flex items-start space-x-3 justify-center">
          <li>
            <a href="#" class="text-white transition-all hover:text-slate-500">
              <i class="bi bi-facebook"></i>
            </a>
          </li>
          <li>
            <a href="#" class="text-white transition-all hover:text-slate-500">
              <i class="bi bi-instagram"></i>
            </a>
          </li>
          <li>
            <a href="#" class="text-white transition-all hover:text-slate-500">
              <i class="bi bi-twitter"></i>
            </a>
          </li>
          <li>
            <a href="#" class="text-white transition-all hover:text-slate-500">
              <i class="bi bi-envelope"></i>
            </a>
          </li>
        </ul>
      </div>
      <div class="links text-center">
        <h6 class="text-slate-500 py-2">Links</h6>
        <ul class="flex flex-col justify-center space-y-3">
          <li>
            <a href="#" class="text-[14px] text-slate-200 transition-all hover:text-white hover:underline">Inicio</a>
          </li>
          <li>
            <a href="#" class="text-[14px] text-slate-200 transition-all hover:text-white hover:underline">Objectivos</a>
          </li>
          <li>
            <a href="#" class="text-[14px] text-slate-200 transition-all hover:text-white hover:underline">Categorias</a>
          </li>
          <li>
            <a href="#" class="text-[14px] text-slate-200 transition-all hover:text-white hover:underline">Avaliações</a>
          </li>
          <li>
            <a href="#" class="text-[14px] text-slate-200 transition-all hover:text-white hover:underline">Guia</a>
          </li>
        </ul>
      </div>
      <div class="flex justify-center p-2">
        <div>
          <form class="mb-5 text-center formSugestion">
            <div class="">
              <label for="emailSugestion" class="text-white text-[14px] font-medium">Dê Uma Sugestão</label>
              <div class="flex w-full focus-within:ring-white items-center space-x-2 mt-4 ring-1 px-4 rounded ring-slate-500">
                <svg xmlns=" http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 stroke-white">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                </svg>
                <input type="email" class="bg-transparent py-2 w-full px-2 text-white text-[15px] outline-none placeholder:text-slate-100" name="emailSugestion" id="emailSugestion" placeholder="E-mail" />
              </div>
            </div>
            <button class="bg-pink-600 transition-all font-medium mt-5 hover:bg-pink-700 px-5 py-2 text-[15px] text-white rounded">
              Enviar
            </button>
          </form>
        </div>
      </div>
    </div>

    <!-- BOTÃO DE TOPO -->
    <button id="scrollToTopBtn" title="Voltar ao Topo" class="fixed buttonTop items-center transition-all hover:bg-pink-600 shadow-lg ring-2 ring-offset-0 ring-pink-300 flex justify-center right-10 w-12 h-12 text-white z-10 bg-pink-500 rounded-full bottom-8">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 7.5h-.75A2.25 2.25 0 004.5 9.75v7.5a2.25 2.25 0 002.25 2.25h7.5a2.25 2.25 0 002.25-2.25v-7.5a2.25 2.25 0 00-2.25-2.25h-.75m0-3l-3-3m0 0l-3 3m3-3v11.25m6-2.25h.75a2.25 2.25 0 012.25 2.25v7.5a2.25 2.25 0 01-2.25 2.25h-7.5a2.25 2.25 0 01-2.25-2.25v-.75" />
      </svg>
    </button>

    <aside class="fixed transition-all hidden justify-center backCard top-0 left-0 right-0 w-full h-screen px-5 z-50">
      <div class="max-w-2xl transition-all cardGuide w-full mt-14 bg-white shadow-lg h-[29rem] rounded-lg flex flex-col items-center justify-between">
        <header class="w-full flex items-center border-b p-5">
          <h6 class="font-medium text-pink-600">Guia do Usuário</h6>
        </header>
        <div class="body overflow-y-auto p-5 h-full">
          <p class="text-[14px] text-slate-800">
            Bem-vinda ao espaço nosso detelentes lugar feminina, um
            promover-se uma discussões construtivas uma sobre a variedade de
            tópicos interessante. Aqui, as mulheres podem temas sugerir ou
            categorias que desejam discutir, e, aprovados pelo administrador,
            conversações de tanoeira zat gado em salas de chat dedicadas. Para
            aproveitar ao uma experiência, siga este passo a passo:
          </p>

          <section class="mt-5">
            <header>
              <h6 class="text-slate-900 text-[15px] font-medium">
                Criar Uma Conta
              </h6>
            </header>
            <p class="text-[14px] text-slate-800 pt-2">
              Antes de começar, é necessário criar uma conta. Isso permite que
              você sugira temas, participe de discussões e personalize sua
              experiência. Clique em
              <a href="#" class="text-pink-600 underline">Criar Conta</a> e
              forneça as informações necessárias, como nome de usuário, senha
              e endereço de e-mail válido.
            </p>
          </section>
          <section class="mt-5">
            <header>
              <h6 class="text-slate-900 text-[15px] font-medium">
                Explorar Categorias e Temas
              </h6>
            </header>
            <p class="text-[14px] text-slate-800 pt-2">
              Após criar sua conta, navegue pelas
              <a href="#" class="text-pink-600 underline">categorias disponíveis</a>
              ou sugira uma nova. Queremos criar um espaço inclusivo e
              diversificado, então sinta-se à vontade para sugerir temas
              relevantes para as conversas femininas.
            </p>
          </section>
          <section class="mt-5">
            <header>
              <h6 class="text-slate-900 text-[15px] font-medium">
                Sugerir um Tema
              </h6>
            </header>
            <p class="text-[14px] text-slate-800 pt-2">
              Se não encontrar uma categoria ou tema que lhe interesse,
              sinta-se à vontade para
              <a href="#" class="text-pink-600 underline">Sugerir</a> um novo.
              O administrador revisará suas sugestões e, se aprovadas, a nova
              categoria será adicionada para que todas as usuárias possam
              participar.
            </p>
          </section>
          <section class="mt-5">
            <header>
              <h6 class="text-slate-900 text-[15px] font-medium">
                Participar de Conversas
              </h6>
            </header>
            <p class="text-[14px] text-slate-800 pt-2">
              Uma vez que seu tema seja aceito, entre na sala de chat
              correspondente para iniciar ou contribuir para as discussões.
              Lembre-se de manter as conversas respeitosas e construtivas,
              promovendo um ambiente positivo para todas as participantes.
            </p>
          </section>
          <section class="mt-5">
            <header>
              <h6 class="text-slate-900 text-[15px] font-medium">
                Respeitar as Diretirizes
              </h6>
            </header>
            <p class="text-[14px] text-slate-800 pt-2">
              Para manter um ambiente seguro e inclusivo, pedimos que todos os
              usuários respeitem nossas diretrizes comunitárias. Isso inclui
              evitar linguagem ofensiva, discriminação ou comportamento
              inadequado. O não cumprimento dessas diretrizes pode resultar em
              restrições de conta ou remoção do acesso.
            </p>
          </section>
        </div>
        <footer class="w-full flex items-center justify-end border-t p-4">
          <button id="fecharGuideCard" class="text-[15px] bg-pink-500 px-5 py-2 rounded font-medium transition-all hover:bg-pink-600 text-white">
            OK
          </button>
        </footer>
      </div>
    </aside>

    <aside class="fixed hidden  transition-all justify-center offcanvas top-0 left-0 right-0 w-full h-screen px-5 z-50">
      <div class="cardOffCanvas bg-white w-full retrato-tablet:w-[25rem] fixed right-0 top-0 py-5 px-7 retrato-tablet:rounded-l-lg h-screen">
        <header class="flex items-center justify-between">
          <h6 class="text-slate-600 font-medium">Menu</h6>
          <button id="closeOffCanvas" class="p-1.5 transition-all hover:ring-4 ring-pink-300 ring-opacity-30 text-white rounded-full bg-pink-500">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </header>
        <nav class="mt-9">
          <ul class="flex flex-col gap-6" id="navbarOffCanvas">
            <li>
              <a href="#objectivos" class="flex items-center transition-all hover:text-pink-500 text-slate-700">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 me-2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z" />
                </svg>
                Objectivos
              </a>
            </li>
            <li>
              <a href="#categorias" class="flex items-center transition-all hover:text-pink-500 text-slate-700">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 me-2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M6.429 9.75L2.25 12l4.179 2.25m0-4.5l5.571 3 5.571-3m-11.142 0L2.25 7.5 12 2.25l9.75 5.25-4.179 2.25m0 0L21.75 12l-4.179 2.25m0 0l4.179 2.25L12 21.75 2.25 16.5l4.179-2.25m11.142 0l-5.571 3-5.571-3" />
                </svg>

                Categorias
              </a>
            </li>
            <li>
              <a href="#avaliacoes" class="flex items-center transition-all hover:text-pink-500 text-slate-700">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 me-2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                </svg>

                Avaliações
              </a>
            </li>
            <li>
              <a href="cadastro.php" class="flex items-center transition-all hover:text-pink-500 text-slate-700">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 me-2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                </svg>

                Cadastre-se
              </a>
            </li>
            <li>
              <a href="#" class="flex guia items-center transition-all hover:text-pink-500 text-slate-700">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 me-2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 18v-5.25m0 0a6.01 6.01 0 001.5-.189m-1.5.189a6.01 6.01 0 01-1.5-.189m3.75 7.478a12.06 12.06 0 01-4.5 0m3.75 2.383a14.406 14.406 0 01-3 0M14.25 18v-.192c0-.983.658-1.823 1.508-2.316a7.5 7.5 0 10-7.517 0c.85.493 1.509 1.333 1.509 2.316V18" />
                </svg>

                Guia
              </a>
            </li>
          </ul>
        </nav>

        <div class=" mt-7 w-full">
          <a href="../views/login.php" class="py-2.5 font-medium transition-all hover:bg-pink-600 text-center w-full block text-white bg-pink-500 rounded-lg"> Entrar </a>
        </div>
      </div>
    </aside>
  </footer>

  <!-- {{-- javascript para emoji  --}} -->
  <script src=" https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.js" integrity="sha512-hkvXFLlESjeYENO4CNi69z3A1puvONQV5Uh+G4TUDayZxSLyic5Kba9hhuiNLbHqdnKNMk2PxXKm0v7KDnWkYA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <!-- {{-- //jquery --}} -->
  <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>

  <!-- animation -->
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

  <script>
    AOS.init();
  </script>
</body>

</html>