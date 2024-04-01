<?php
session_start();
require_once "../config/database.php";
if (!$_GET["pesquisa"])
{
$con = new Conexao();
$conn = $con->getConexao();

$sqlConversa = "SELECT * FROM categorias
inner join conversas
on conversas.categoria_id = categorias.id
ORDER BY categorias.id desc
 ";
$cmd = $conn->prepare($sqlConversa);
$cmd->execute();
$_SESSION["todasCategorias"] = $cmd->fetchAll(PDO::FETCH_ASSOC);
}
?> 
<!DOCTYPE html>

<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- LINK para fonts do Projecto -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300;400;500;600;700;800;900&family=Lato:wght@300;400;700;900&family=Montserrat:wght@200;300;400;500;600;700;800;900&family=Nunito:wght@200;300;400;500;600;700;800;900&family=Open+Sans:wght@400;500;600;700;800&family=Poppins:wght@200;300;400;500;600;700;800;900&family=Roboto:wght@100;400;500;700;900&display=swap"
      rel="stylesheet"
    />
    <!-- Link para o tailwindcss -->
    <link rel="stylesheet" href="../assets/dist/tailwind.css" />
    <!-- CDN para o bootstrao Icon -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"
    />
    <!-- Java script main -->
    <script src="../assets/js/main.js" defer></script>
    <!-- link para o css main -->
    <link rel="stylesheet" href="../assets/css/main.css" />
    <!-- {{-- link para emoji o emoji no css --}} -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.css"
      integrity="sha512-0Nyh7Nf4sn+T48aTb6VFkhJe0FzzcOlqqZMahy/rhZ8Ii5Q9ZXG/1CbunUuEbfgxqsQfWXjnErKZosDSHVKQhQ=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <!-- Colocar icon na url -->
    <link
      rel="shortcut icon"
      href="../assets/img/Logo.png"
      type="image/x-icon"
    />
    <title>EntreElas</title>
  </head>

  <body>
    <header class="w-full transition-all header-container bg-transparent z-40 fixed top-0 left-0 right-0">
      <div
        class="navbar px-5 py-1 z-20 grid grid-cols-1 w-full"
      >
        <div class="flex items-center justify-between border-b py-3">
          <div>
            <a href="#">
              <img
                src="../assets/img/Logo.png"
                class="w-12 h-12"
                alt="logomarca-EntreElas"
              />
            </a>
          </div>
          <div class="flex retrato-tablet:gap-0 gap-3 items-center">
            <a
              href="inicio.php"
              class="px-5 retrato-tablet:inline-block hidden rounded-l-full bg-pink-500 border-r-2 border-white text-white font-medium text-[14px] py-2 transition-all hover:bg-pink-600"
              >Voltar</a
            >
            <button
              class="px-5 sugerir retrato-tablet:inline-block hidden rounded-r-full bg-pink-500 text-white font-medium text-[14px] py-2 transition-all hover:bg-pink-600"
            >
              Sugerir
            </button>
            <button
              class="retrato-tablet:hidden sugerir inline-block rounded-full bg-pink-500 border-r-2 border-white text-white font-medium text-[14px] p-2"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="w-6 h-6"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"
                />
              </svg>
            </button>
            <a
              href="inicio.php"
              class="retrato-tablet:hidden inline-block rounded-full bg-pink-500 border-r-2 border-white text-white font-medium text-[14px] p-2"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="w-6 h-6"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75"
                />
              </svg>
            </a>
          </div>
        </div>
        <div class="py-2">
          <form class="w-full" action="./pesquisar.php">
            <div class="flex items-center">
              <div
                class="flex w-full focus-within:ring-4 ring-gray-300 ring-opacity-40 transition-all retrato-tablet:space-x-4 items-center px-4 bg-gray-100 rounded-l-lg"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                  class="w-6 h-6 stroke-2 stroke-gray-500 retrato-tablet:inline-block hidden"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"
                  />
                </svg>
                <input
                  type="text"
                  class="py-3 w-full bg-transparent outline-none text-slate-800 placeholder:text-slate-500 text-[15px]"
                  name="pesquisa"
                  id="pesquisa"
                  placeholder="Busque por uma Categoria..."
                />
              </div>
              <button
              type="submit"
                class="bg-pink-500 retrato-tablet:inline-block hidden text-white font-medium text-[15px] py-3 rounded-r-lg px-5 transition-all hover:bg-pink-600"
              >
                Buscar
              </button>
              <button
                class="bg-pink-500 retrato-tablet:hidden inline-block text-white font-medium text-[15px] py-3 rounded-r-lg px-5 transition-all hover:bg-pink-600"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                  class="w-6 h-6 stroke-2"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"
                  />
                </svg>
              </button>
            </div>
          </form>
        </div>
      </div>
    </header>
    <main class="paisagem-tablet:w-[82%] retrato-tablet:w-[90%] w-full m-auto paisagem-tablet:mt-48 mt-36">
      <div
        data-aos="fade-left"
        data-aos-duration="1000"
        data-offset="850"
        class="grid retrato-tablet:grid-cols-2 grid-cols-1 paisagem-tablet:grid-cols-3 gap-4 p-4 mt-2"
      >
      <?php foreach ($_SESSION["todasCategorias"]   as $categoria) {
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
              Explore
              </p>
            </div>
            <a href="chat.php?conversa_id=<?= $categoria["id"];?>" class="text-white bg-pink-600 font-medium rounded-full px-5 py-1 text-[14px] transition-all hover:ring-4 ring-pink-400 ring-opacity-50">Entrar</a>
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
            <a
              href="#"
              class="text-white bg-pink-600 font-medium rounded-full px-5 py-1 text-[14px] transition-all hover:ring-4 ring-pink-400 ring-opacity-50"
              >Entrar</a
            >
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
            <a
              href="#"
              class="text-white bg-pink-600 font-medium rounded-full px-5 py-1 text-[14px] transition-all hover:ring-4 ring-pink-400 ring-opacity-50"
              >Entrar</a
            >
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
            <a
              href="#"
              class="text-white bg-pink-600 font-medium rounded-full px-5 py-1 text-[14px] transition-all hover:ring-4 ring-pink-400 ring-opacity-50"
              >Entrar</a
            >
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
            <a
              href="#"
              class="text-white bg-pink-600 font-medium rounded-full px-5 py-1 text-[14px] transition-all hover:ring-4 ring-pink-400 ring-opacity-50"
              >Entrar</a
            >
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
            <a
              href="#"
              class="text-white bg-pink-600 font-medium rounded-full px-5 py-1 text-[14px] transition-all hover:ring-4 ring-pink-400 ring-opacity-50"
              >Entrar</a
            >
          </div>
        </div> -->
      </div>
    </main>
    <footer class="w-full p-5 hidden bg-slate-950 mt-8">
      <div
        class="max-w-7xl justify-center w-full m-auto grid paisagem-tablet:grid-cols-3"
      >
        <div class="midea text-center">
          <h6 class="text-slate-500 py-2">Redes Sociais</h6>
          <ul class="flex items-start space-x-3 justify-center">
            <li>
              <a
                href="#"
                class="text-white transition-all hover:text-slate-500"
              >
                <i class="bi bi-facebook"></i>
              </a>
            </li>
            <li>
              <a
                href="#"
                class="text-white transition-all hover:text-slate-500"
              >
                <i class="bi bi-instagram"></i>
              </a>
            </li>
            <li>
              <a
                href="#"
                class="text-white transition-all hover:text-slate-500"
              >
                <i class="bi bi-twitter"></i>
              </a>
            </li>
            <li>
              <a
                href="#"
                class="text-white transition-all hover:text-slate-500"
              >
                <i class="bi bi-envelope"></i>
              </a>
            </li>
          </ul>
        </div>
        <div class="links text-center">
          <h6 class="text-slate-500 py-2">Links</h6>
          <ul class="flex flex-col justify-center space-y-3">
            <li>
              <a
                href="#"
                class="text-[14px] text-slate-200 transition-all hover:text-white hover:underline"
                >Inicio</a
              >
            </li>
            <li>
              <a
                href="#"
                class="text-[14px] text-slate-200 transition-all hover:text-white hover:underline"
                >Objectivos</a
              >
            </li>
            <li>
              <a
                href="#"
                class="text-[14px] text-slate-200 transition-all hover:text-white hover:underline"
                >Categorias</a
              >
            </li>
            <li>
              <a
                href="#"
                class="text-[14px] text-slate-200 transition-all hover:text-white hover:underline"
                >Avaliações</a
              >
            </li>
            <li>
              <a
                href="#"
                class="text-[14px] text-slate-200 transition-all hover:text-white hover:underline"
                >Guia</a
              >
            </li>
          </ul>
        </div>
        <div class="flex justify-center p-2">
          <div>
            <form class="mb-5 text-center formSugestion">
              <div class="">
                <label
                  for="emailSugestion"
                  class="text-white text-[14px] font-medium"
                  >Dê Uma Sugestão</label
                >
                <div
                  class="flex w-full focus-within:ring-white items-center space-x-2 mt-4 ring-1 px-4 rounded ring-slate-500"
                >
                  <svg
                    xmlns=" http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-6 h-6 stroke-white"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"
                    />
                  </svg>
                  <input
                    type="email"
                    class="bg-transparent py-2 w-full px-2 text-white text-[15px] outline-none placeholder:text-slate-100"
                    name="emailSugestion"
                    id="emailSugestion"
                    placeholder="E-mail"
                  />
                </div>
              </div>
              <button
                class="bg-pink-600 transition-all font-medium mt-5 hover:bg-pink-700 px-5 py-2 text-[15px] text-white rounded"
              >
                Enviar
              </button>
            </form>
          </div>
        </div>
      </div>

      <!-- BOTÃO DE TOPO -->
      <button
        id="scrollToTopBtn"
        title="Voltar ao Topo"
        class="fixed buttonTop items-center transition-all hover:bg-pink-600 shadow-lg ring-2 ring-offset-0 ring-pink-300 flex justify-center right-10 w-12 h-12 text-white z-10 bg-pink-500 rounded-full bottom-8"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          stroke-width="1.5"
          stroke="currentColor"
          class="w-6 h-6"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M7.5 7.5h-.75A2.25 2.25 0 004.5 9.75v7.5a2.25 2.25 0 002.25 2.25h7.5a2.25 2.25 0 002.25-2.25v-7.5a2.25 2.25 0 00-2.25-2.25h-.75m0-3l-3-3m0 0l-3 3m3-3v11.25m6-2.25h.75a2.25 2.25 0 012.25 2.25v7.5a2.25 2.25 0 01-2.25 2.25h-7.5a2.25 2.25 0 01-2.25-2.25v-.75"
          />
        </svg>
      </button>
    </footer>

    <aside
      class="fixed transition-all hidden justify-center backCard top-0 left-0 right-0 w-full h-screen px-5 z-50"
    >
      <div
        class="max-w-2xl transition-all cardGuide w-full mt-14 bg-white shadow-lg h-[28rem] rounded-lg flex flex-col justify-between"
      >
        <header class="w-full flex items-center justify-center border-b p-5">
          <h6 class="font-medium text-pink-500">Sugestão de Categoria</h6>
        </header>
        <div class="body overflow-y-auto p-8 h-full">
          <form class="w-full">
            <div class="grid grid-cols-1 gap-4">
              <div class="">
                <label for="categoria" class="text-[14px] px-2 text-slate-800"
                  >Categoria</label
                >
                <input
                  type="text"
                  class="w-full mt-3 ring-1 ring-gray-200 text-slate-800 outline-none rounded-lg py-3 px-4 transition-all focus:ring-4 focus:ring-pink-100 ring-opacity-40"
                  name="categoria"
                  id="categoria"
                  placeholder="Escreva a Categoria"
                />
              </div>
              <div>
                <label for="description" class="text-[14px] px-2 text-slate-800"
                  >Descrição</label
                >
                <textarea
                  name="description"
                  class="w-full ring-1 mt-3 ring-gray-200 text-slate-800 outline-none rounded-lg py-3 px-4 transition-all focus:ring-4 focus:ring-pink-100 ring-opacity-40"
                  id="description"
                  placeholder="Descreva a Categoria em Poucas Palavras(Opcional)"
                  rows="2"
                >
                </textarea>
              </div>
              <button
                class="py-3 bg-pink-500 text-white font-medium rounded-lg"
              >
                Enviar
              </button>
            </div>
          </form>
        </div>
        <footer class="w-full flex items-center justify-end border-t p-4">
          <button
            id="fecharGuideCard"
            class="text-[15px] bg-pink-500 px-5 py-2 rounded font-medium transition-all hover:bg-pink-600 text-white"
          >
            Cancelar
          </button>
        </footer>
      </div>
    </aside>
  </body>
</html>
<!-- {{-- javascript para emoji  --}} -->
<script
  src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.js"
  integrity="sha512-hkvXFLlESjeYENO4CNi69z3A1puvONQV5Uh+G4TUDayZxSLyic5Kba9hhuiNLbHqdnKNMk2PxXKm0v7KDnWkYA=="
  crossorigin="anonymous"
  referrerpolicy="no-referrer"
></script>

<!-- {{-- //jquery --}} -->
<script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"
></script>
