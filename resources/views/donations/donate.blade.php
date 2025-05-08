<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campanha</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <style>
        body {
        transition: background-color 0.3s, color 0.3s; /* Animação suave ao trocar o tema */
        font-family: "Poppins", sans-serif; /* Fonte personalizada */
        font-weight: 500;
        font-style: normal;

        }
    
        /* Tema claro */
        .light-theme {
        background-color: #ffffff;
        color: #000000;
        }
    
        /* Tema escuro */
        .dark-theme {
        background-color: #1b1b1b;
        color: #ffffff;
        }
    
        /* Estilização do menu mobile flutuante */
        #mobile-menu {
        position: absolute;
        left: 50%; /* Centralizado horizontalmente */
        top: -10%; /* Inicia fora da tela (oculto) */
        padding: 20px 30px;
        border-radius: 12px;
        border: 1px solid #cfcfcf; /* Borda leve */
        background-color: #ffffff; /* Fundo branco padrão */
        color: #1b1b1b; /* Texto escuro */
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1); /* Sombra */
        max-width: 90%; /* Largura máxima */
        backdrop-filter: blur(10px); /* Efeito de vidro fosco */
        transition: all 0.3s ease-in-out; /* Suavidade na transição */
        }
    
        /* Garante que o botão do menu fique acima do restante */
        #menunav {
        position: relative;
        z-index: 5;
        }
    
        /* Botão de alternância de tema */
        #theme-toggle {
        all: unset; /* Remove todos os estilos padrões */
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        position: relative;
        left: -23.5%; /* Posição personalizada para alinhar com layout */
        }
    
        /* Ajusta a posição do botão em tablets */
        @media (min-width: 629px) and (max-width: 767px) {
        #theme-toggle {
            margin-left: 450px;
        }
        }
    
        /* Ajusta a posição do botão em celulares */
        @media (min-width: 0px) and (max-width: 629px) {
        #theme-toggle {
            left: 70%;
        }
        }
    
        /* Botão de menu hambúrguer em dispositivos móveis */
        #menu-toggle {
        position: relative;
        left: 85%;
        top: -47px; /* Sobe o botão para alinhar com cabeçalho */
        }
    
      </style>
</head>
<body class="light-theme duration-200">
    <header class="mt-5">
        <div class="px-4 mx-auto sm:px-6 lg:px-8">
          <div class="flex items-center justify-between h-16 lg:h-20">
            
            <!-- Logotipo -->
            <div class="flex-shrink-0">
              <a href="#" class="flex">
                <img class="w-auto ml-5 h-8" src="assets/logo1.svg" alt="" />
              </a>
            </div>
    
            <!-- Container do conteúdo da navbar -->
            <div class="flex items-center justify-between w-full md:w-auto">
              
              <!-- Links visíveis apenas em telas médias e grandes -->
              <div id="meutext" class="hidden md:flex ml-auto items-center justify-center space-x-6 lg:space-x-10">
                <a href="#" id="texts" class="text-base font-semibold transition-all duration-100">Home</a>
                <a href="#modsecao2" id="texts" class="text-base font-semibold transition-all duration-100">Apoio</a>
                <a href="#secao3" id="texts" class="text-base font-semibold transition-all duration-100">Funcionamento</a>
                <a href="#secao4" id="texts" class="text-base font-semibold transition-all duration-100">Criação</a>
    
                <!-- Separador -->
                <div class="w-px h-5 bg-black/20"></div>
    
                <!-- Botão Entrar -->
                <a href="#" class="inline-flex items-center justify-center px-5 ml-10 py-2.5 text-base font-semibold border-2 transition-all duration-100" role="button">Entrar</a>
              </div>
    
              <!-- Botão de alternância de tema visível apenas em telas pequenas -->
              <button id="theme-toggle" class="block md:hidden">
                <img src="assets/sol.svg" id="sol" class="w-6 h-6">
                <img src="assets/lua.svg" id="lua" class="w-6 h-6">
              </button>
            </div>
          </div>
        </div>
      </header>
    
      <!-- Navbar mobile com botão hamburguer -->
      <div id="menunav" class="container mx-auto flex justify-between items-center">
    
        <!-- Botão para abrir o menu mobile -->
        <button id="menu-toggle" class="md:hidden focus:outline-none">
          <svg class="w-8 h-8" fill="white" viewBox="0 0 24 24">
            <path d="M4 6h16M4 12h16m-7 6h7" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
          </svg>
        </button>
    
        <!-- Menu que aparece ao clicar no botão (invisível inicialmente) -->
        <div id="mobile-menu" class="hidden absolute top-16 left-4 text-center shadow-lg rounded-lg p-3 w-48 md:hidden">
          <a href="#" id="infor" class="block py-2">Home</a>
          <a href="#modsecao2" id="infor" class="block py-2">Apoio </a>
          <a href="#secao3" id="infor" class="block py-2">Funcionamento</a>
          <a href="#secao4" id="infor" class="block py-2">Criação</a>
        </div>
      </div>
    

    <section>
  <div class="">
    <div class="max-w-screen-xl mx-auto px-4  md:px-8">
      <div
        class="max-w-lg mx-auto gap-12 justify-between lg:flex lg:max-w-none"
      >
        <div class="max-w-lg space-y-3">
          <br><br>
          <p class="text-[#2AB036] text-3xl font-semibold sm:text-4xl">
            Doar para a campanha 
          </p>
          <p class=" font-semibold">
            Meta: {{$campaign->meta['target']}}
          </p>
          <p class=" font-semibold">
            Arrecadado: {{$campaign->meta['current']}}
          </p>
          <br>
          <img src="{{asset('assets/doodle_group.svg')}}" alt="">
          <div>
            <ul class="mt-6 flex flex-wrap gap-x-10 gap-y-6 items-center">
              <template
                x-for="(item, index) in contactMethods"
                :key="index"
              >
                <li class="flex items-center gap-x-3">
                  <div
                    class="flex-none text-gray-400"
                    x-html="item.icon"
                  ></div>
                  <p x-text="item.contact"></p>
                </li>
              </template>
            </ul>
          </div>
        </div>
        <div class="flex-1 mt-12 sm:max-w-lg lg:max-w-md">
            <form method="POST" action="/donation/{{$campaign->id}}" class="space-y-8">
            @csrf
            <div class="mb-10 mt-8">
              <label class="font-medium"> Quantos kg de comida você pretende doar? </label>
              <input
                type="number"
                required
                class="w-full mt-2 px-3 py-2 text-gray-500 bg-transparent outline-none border focus:border-indigo-600 shadow-sm rounded-lg"
                name="Quantity" id="Quantity" min="0" max="{{$campaign->meta['target'] - $campaign->meta['current']}}"
              />
            </div>
          
            <div>
              <label class="font-medium">Descrição</label>
              <textarea
                required
                name="Description"
                class="w-full mt-2 h-36 px-3 py-2 resize-none appearance-none bg-transparent outline-none border focus:border-indigo-600 shadow-sm rounded-lg"
              ></textarea>
            </div>
            <div class="text-sm text-center">
                <p>Antes de doar, entenda como funciona o nosso sistema clique <a href="/info" class="text-[#1511FE]">aqui</a></p>
            </div>
            <div class="pb-5">
            <button
            type="submit"
              class="w-full  px-4 py-2 text-white font-medium bg-[#5FCB69] hover:bg-[#357E3C]  active:bg-indigo-600 rounded-lg duration-150"
            >
              Fazer Doação
            </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  
</section>
      <!-- Scripts para interatividade -->
      <script>
        // Seletores dos elementos
        const themeToggleButton = document.getElementById('theme-toggle');
        const body = document.body;
        const sol = document.getElementById('sol'); // ícone do sol (modo escuro)
        const lua = document.getElementById('lua'); // ícone da lua (modo claro)
    
        // Define o tamanho dos ícones
        const imageSize = "25px";
        sol.style.width = imageSize;
        sol.style.height = imageSize;
        lua.style.width = imageSize;
        lua.style.height = imageSize;
    
        // Exibe o ícone da lua (modo claro) inicialmente
        sol.style.display = "none";
        lua.style.display = "inline-block";
    
        // Alterna entre temas claro e escuro ao clicar no botão
        themeToggleButton.addEventListener('click', () => {
        if (body.classList.contains('light-theme')) {
            // Ativa o tema escuro
            body.classList.remove('light-theme');
            body.classList.add('dark-theme');
    
            // Mostra o ícone do sol, esconde o da lua
            sol.style.display = "inline-block";
            lua.style.display = "none";
        } else {
            // Volta ao tema claro
            body.classList.remove('dark-theme');
            body.classList.add('light-theme');
    
            // Mostra o ícone da lua, esconde o do sol
            sol.style.display = "none";
            lua.style.display = "inline-block";
        }
        });
    
        // Lógica do botão hamburguer (abre/fecha o menu mobile)
        document.getElementById("menu-toggle").addEventListener("click", function(event) {
        var menu = document.getElementById("mobile-menu");
        menu.classList.toggle("hidden"); // Adiciona ou remove a classe 'hidden'
        event.stopPropagation(); // Evita que o clique feche o menu imediatamente
        });
    
        // Fecha o menu mobile ao clicar fora dele
        document.addEventListener("click", function(event) {
        var menu = document.getElementById("mobile-menu");
        var toggleButton = document.getElementById("menu-toggle");
    
        // Se o clique não foi dentro do menu nem no botão, esconde o menu
        if (!menu.contains(event.target) && !toggleButton.contains(event.target)) {
            menu.classList.add("hidden");
        }
        });
    
      </script>
</body>
</html>
