<!-- Carrega Alpine.js (biblioteca JavaScript reativa leve) -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
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

        <!-- Container de conteúdo da navbar -->
        <div class="flex items-center space-x-4 ml-auto">
          @if (request()->path() != '/')
          <!-- Botão Home -->
          <a href="/home" class="text-base font-semibold text-gray-900 dark:text-white transition-all duration-100">
            Home
          </a>
          @endif

          <!-- Campo de pesquisa visível apenas na rota /home -->
          @if(request()->path() == 'home' || auth()->check() == true)
            <div class="flex items-center space-x-2">
              <form action="/home" method="get">
                <input 
                  type="text" 
                  name="q" 
                  placeholder="Buscar..." 
                  class="w-full px-4 py-2 text-sm border border-gray-300 dark:border-neutral-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent bg-white dark:bg-neutral-800 text-gray-900 dark:text-white transition-all duration-300"
                />
              </form>
            </div>
          @endif

          <!-- Botão de alternância de tema -->
          <button id="theme-toggle" class="block">
            <img src="{{asset('assets/sol.svg')}}" id="sol" class="w-6 h-6 text-white">
            <img src="{{asset('assets/lua.svg')}}" id="lua" class="w-6 h-6 text-black">
          </button>

        </div>
      </div>
    </div>
  </header>

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

    // Função para aplicar tema
    function applyTheme(theme) {
      if (theme === 'dark') {
        body.classList.remove('light');
        body.classList.add('dark');
        sol.style.display = "inline-block";
        lua.style.display = "none";
      } else {
        body.classList.remove('dark');
        body.classList.add('light');
        sol.style.display = "none";
        lua.style.display = "inline-block";
      }
    }

    // Checa o localStorage ao carregar a página
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'dark' || savedTheme === 'light') {
      applyTheme(savedTheme);
    } else {
      // Tema padrão: claro
      applyTheme('light');
    }

    // Alterna entre temas claro e escuro ao clicar no botão
    themeToggleButton.addEventListener('click', () => {
      const isDark = body.classList.contains('dark');
      const newTheme = isDark ? 'light' : 'dark';
      applyTheme(newTheme);
      localStorage.setItem('theme', newTheme);
    });
  </script>
</head>
