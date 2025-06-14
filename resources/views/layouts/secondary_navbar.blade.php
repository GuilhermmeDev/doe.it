<header class="m-5 w-full">
  <div class="px-4 mx-auto sm:px-6 lg:px-8">
    <div class="flex items-center justify-between h-16 lg:h-20">
      <div class="flex-shrink-0">
        <a href="/" class="flex">
          <img class="w-auto ml-5 h-8" src="{{asset('assets/logo1.svg')}}" alt="" />
        </a>
      </div>

      <div class="flex items-center space-x-4 ml-auto">
        @if (request()->path() != '/')
        <a href="/home" class="text-base font-semibold text-gray-900 dark:text-white transition-all duration-100">
          Home
        </a>
        @endif

        @if(request()->path() == 'home' || auth()->check() == true && request()->path() == '/')
          <div class="flex items-center space-x-2">
            <form action="/home" method="get">
              <input
                type="text"
                name="q"
                placeholder="Buscar..."
                class="w-full px-4 py-2 text-sm border border-gray-300 dark:border-neutral-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent bg-white dark:bg-neutral-800 text-gray-900 dark:text-white transition-all duration-300"
              />
            </form>

            <a href="/campaign" class="p-2 border-gray-600 border-solid border-2 rounded-lg text-gray-500 dark:text-white">Criar Campanha</a>
          </div>
        @endif

        @if(auth()->check() && (!isset($hideUserProfile) || !$hideUserProfile))
          {{-- Alpine.js for dropdown --}}
          <div x-data="{ open: false }" @click.away="open = false" class="relative">
            <button @click="open = !open" class="p-2 border-gray-600 border-solid border-2 rounded-lg text-gray-500 dark:text-white flex items-center space-x-2 cursor-pointer">
              <img src="{{asset('assets/user-pen.svg')}}" alt="Ícone de Usuário" class="w-5 h-5">
              <span>{{ Auth::user()->name ?? 'Usuário' }}</span>
              {{-- Optional: Dropdown arrow icon --}}
              <svg :class="{'rotate-180': open, 'rotate-0': !open}" class="w-4 h-4 ml-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </button>

            {{-- Dropdown Menu --}}
            <div
              x-show="open"
              x-transition:enter="transition ease-out duration-200"
              x-transition:enter-start="opacity-0 scale-95"
              x-transition:enter-end="opacity-100 scale-100"
              x-transition:leave="transition ease-in duration-75"
              x-transition:leave-start="opacity-100 scale-100"
              x-transition:leave-end="opacity-0 scale-95"
              class="absolute right-0 mt-2 w-48 bg-white dark:bg-neutral-800 rounded-md shadow-lg py-1 z-20" {{-- Reverting to right-0 for more standard alignment --}}
              style="display: none;" {{-- Hidden by default --}}
            >
              {{-- Reverting to original a/button structure but ensuring text-center works --}}
              <a href="/profile" class="block w-full px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-neutral-700 text-center">Editar Perfil</a>
              <form method="POST" action="/logout">
                @csrf
                <button type="submit" class="block w-full px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 hover:dark:bg-red-900/20 text-center">Sair da Conta</button>
              </form>
            </div>
          </div>
        @endif

        <button id="theme-toggle" class="block">
          <img src="{{asset('assets/sol.svg')}}" id="sol" class="w-6 h-6 text-white">
          <img src="{{asset('assets/lua.svg')}}" id="lua" class="w-6 h-6 text-black">
        </button>
      </div>
    </div>
  </div>
</header>

{{-- Make sure this script is in the same file or loaded after the HTML --}}
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
    // Tema padrão: claro (ou você pode definir 'dark' se preferir)
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