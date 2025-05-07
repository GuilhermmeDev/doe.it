<!-- Carrega Alpine.js (biblioteca JavaScript reativa leve) -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<!-- Carrega Tailwind CSS (versão para navegador) -->
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

    <!-- Cabeçalho da página (navbar) -->
    <header class="mt-5 w-full">
      <div class="px-4 mx-auto sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16 lg:h-20">

          <!-- Logotipo -->
          <div class="flex-shrink-0">
            <a href="/" class="flex">
              <img class="w-auto ml-5 h-8" src="assets/logo1.svg" alt="" />
            </a>
          </div>

          <!-- Container do conteúdo da navbar -->
          <div class="flex items-center justify-between w-full md:w-auto">
             @if(request()->path() == '/')
            <!-- Links visíveis apenas em telas médias e grandes -->
            <div id="meutext" class="hidden md:flex ml-auto items-center justify-center space-x-6 lg:space-x-10">
              <a href="#" id="texts" class="text-base font-semibold transition-all duration-100">Home</a>
              <a href="#modsecao2" id="texts" class="text-base font-semibold transition-all duration-100">Apoio</a>
              <a href="#secao3" id="texts" class="text-base font-semibold transition-all duration-100">Funcionamento</a>
              <a href="#secao4" id="texts" class="text-base font-semibold transition-all duration-100">Criação</a>

              <!-- Separador -->
              <div class="w-px h-5 bg-black/20"></div>

                 <!-- Botão Entrar -->
                <a href="/login" class="inline-flex items-center justify-center px-5 ml-10 py-2.5 text-base font-semibold border-2 transition-all duration-100" role="button">Entrar</a>
            </div>
                @endif
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
