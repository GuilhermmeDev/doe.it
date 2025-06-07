<!-- Carrega Alpine.js (biblioteca JavaScript reativa leve) -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<!-- Carrega Tailwind CSS (versão para navegador) -->
<script src="https://cdn.tailwindcss.com"></script>
<script>
  tailwind.config = {
    darkMode: 'class', // Ativa o modo escuro
  };
</script>

<head>
  <!-- Cabeçalho da página (navbar) -->
  <header class="m-5 w-full">
    <div class="px-4 mx-auto sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-16 lg:h-20">
        
        <!-- Logotipo -->
        <div class="flex-shrink-0">
          <a href="/" class="flex">
            <img class="w-auto ml-5 h-8" src="{{asset('assets/logo1.svg')}}" alt="" />
          </a>
        </div>

        <!-- Container do conteúdo da navbar -->
        <div class="flex items-center justify-between w-full md:w-auto">
          @if(request()->path() == '/')
            <!-- Links visíveis apenas em telas médias e grandes -->
            <div id="meutext" class="hidden md:flex ml-auto items-center justify-center space-x-6 lg:space-x-10">
              <a href="#" id="texts" class="text-base font-semibold text-gray-900 dark:text-white transition-all duration-100">Home</a>
              <a href="#modsecao2" id="texts" class="text-base font-semibold text-gray-900 dark:text-white transition-all duration-100">Apoio</a>
              <a href="#secao3" id="texts" class="text-base font-semibold text-gray-900 dark:text-white transition-all duration-100">Funcionamento</a>
              <a href="#secao4" id="texts" class="text-base font-semibold text-gray-900 dark:text-white transition-all duration-100">Criação</a>

              <!-- Separador -->
              <div class="w-px h-5 bg-black/20 dark:bg-white/30"></div>

              <!-- Botão Entrar -->
              <a href="/login" class="inline-flex items-center justify-center px-5 ml-10 py-2.5 text-base font-semibold text-gray-900 dark:text-white border-2 transition-all duration-100" role="button">Entrar</a>
            </div>
          @endif

          <!-- Botão de alternância de tema visível apenas em telas pequenas -->
          <button id="theme-toggle" class="block">
            <img src="{{asset('assets/sol.svg')}}" id="sol" class="w-6 h-6 text-white">
            <img src="{{asset('assets/lua.svg')}}" id="lua" class="w-6 h-6 text-black">
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
      <a href="#" id="infor" class="block py-2 text-gray-900 dark:text-white">Home</a>
    </div>
  </div>

  <!-- Scripts para interatividade -->
  <script>
    // Seletores dos elementos
    const themeToggleButton = document.getElementById('theme-toggle');
    const body = document.documentElement; // Referência ao elemento <html>
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
      if (body.classList.contains('dark')) {
        // Ativa o tema claro
        body.classList.remove('dark');
        body.classList.add('light');

        // Mostra o ícone da lua, esconde o do sol
        sol.style.display = "none";
        lua.style.display = "inline-block";
      } else {
        // Ativa o tema escuro
        body.classList.remove('light');
        body.classList.add('dark');

        // Mostra o ícone do sol, esconde o da lua
        sol.style.display = "inline-block";
        lua.style.display = "none";
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
</head>
