<header class="mt-5 w-full">
  <div class="px-4 mx-auto sm:px-6 lg:px-8">
    <div class="flex items-center justify-between h-16 lg:h-20">
      <!-- Logo -->
      <div class="flex-shrink-0">
        <a href="/" class="flex">
          <img class="w-auto h-8" src="{{asset('assets/logo1.svg')}}" alt="Logo" />
        </a>
      </div>

      <!-- Barra de pesquisa (fora do menu, sempre visível na home) -->
      @if(request()->path() == 'home' || (auth()->check() == true && request()->path() == '/'))
        <form action="/home" method="get" 
        class="flex-1 min-w-0 max-w-lg mx-4">
          <input
            type="text"
            name="q"
            placeholder="Buscar..."
            class="w-full px-4 py-2 text-sm border border-gray-300 dark:border-neutral-600 rounded-lg 
                  focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent
                  bg-white dark:bg-neutral-800 text-gray-900 dark:text-white transition-all duration-300"
          />
        </form>
      @endif

      <!-- Desktop links -->
      <div class="hidden md:flex items-center space-x-4 ml-auto">

        <a href="/campaign"
           class="px-3 py-2 text-md rounded-lg border-2 border-gray-600 dark:border-neutral-600 text-gray-700 dark:text-white">
          Criar Campanha
        </a>

        @if(auth()->check() && (!isset($hideUserProfile) || !$hideUserProfile))
          <!-- perfil dropdown (desktop) -->
          <div x-data="{ open: false }" @click.away="open = false" class="relative">
            <button @click="open = !open" class="p-2 border-gray-600 border-solid border-2 rounded-lg text-gray-500 dark:text-white flex items-center space-x-2 cursor-pointer text-md">
                <img :class="{'dark:invert': true}" src="{{asset('assets/user-pen.svg')}}" alt="Ícone de Usuário" class="w-5 h-5">
              <span>{{ Auth::user()->name ?? 'Usuário' }}</span>
              <svg :class="{'rotate-180': open, 'rotate-0': !open}" class="w-4 h-4 ml-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
              </svg>
            </button>

            <div
              x-show="open"
              x-transition
              class="absolute right-0 mt-2 w-48 bg-white dark:bg-neutral-800 rounded-md shadow-lg py-1 z-20"
              style="display: none;"
            >
              <a href="/profile" class="block w-full px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-neutral-700 text-center">Editar Perfil</a>
              <a href="/history" class="block w-full px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-neutral-700 text-center">Histórico</a>
              <hr class="mx-6 border-white/20">
              <form method="POST" action="/logout">
                @csrf
                <button type="submit" class="block w-full px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 text-center">Sair da Conta</button>
              </form>
            </div>
          </div>
        @endif

        <!-- Toggle tema (desktop) -->
        <button type="button" class="js-theme-toggle p-2 rounded-md focus:outline-none" aria-label="Alternar tema">
          <img src="{{asset('assets/sol.svg')}}" alt="sol" class="icon-sun w-6 h-6 inline-block" style="display:none"/>
          <img src="{{asset('assets/lua.svg')}}" alt="lua" class="icon-moon w-6 h-6 inline-block" style="display:none"/>
        </button>
      </div>

      <!-- Mobile -->
      <div class="md:hidden flex items-center ml-auto" x-data="{ open: false }">
        <!-- Botão hamburguer -->
        <button @click="open = !open" class="p-2 rounded-md text-gray-700 dark:text-gray-200 focus:outline-none" aria-label="Abrir menu">
          <svg x-show="!open" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M4 6h16M4 12h16M4 18h16"/>
          </svg>
          <svg x-show="open" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M6 18L18 6M6 6l12 12"/>
          </svg>
        </button>

        <!-- Menu Mobile -->
        <div x-show="open" x-transition class="absolute top-20 right-5 w-64 bg-white dark:bg-neutral-800 shadow-lg rounded-lg p-4 space-y-3 z-50" style="display:none;">

          <a href="/campaign"
             class="block px-3 py-2 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-neutral-700 rounded-md">
            Criar Campanha
          </a>

          @if(auth()->check() && (!isset($hideUserProfile) || !$hideUserProfile))
            <a href="/profile" class="block px-3 py-2 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-neutral-700 rounded-md">Editar Perfil</a>
            <a href="/history" class="block px-3 py-2 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-neutral-700 rounded-md">Histórico</a>
            <hr class="mx-6 border-white/20">

            <form method="POST" action="/logout">
              @csrf
              <button type="submit" class="w-full text-left px-3 py-2 text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-md">Sair da Conta</button>
            </form>
          @endif

          <!-- Toggle tema (mobile) -->
          <button type="button" class="js-theme-toggle w-full px-3 py-2 rounded-md bg-gray-200 dark:bg-neutral-700 text-gray-800 dark:text-white text-center" aria-label="Alternar tema">
            <img src="{{asset('assets/sol.svg')}}" alt="sol" class="icon-sun w-5 h-5 inline-block mr-2" style="display:none"/>
            <img src="{{asset('assets/lua.svg')}}" alt="lua" class="icon-moon w-5 h-5 inline-block mr-2" style="display:none"/>
            Alternar Tema
          </button>
        </div>
      </div>
    </div>
  </div>
</header>


<!-- Script: tema (funciona tanto para o botão desktop quanto para o mobile) -->
<script>
(function(){
  const root = document.documentElement;
  const toggles = Array.from(document.querySelectorAll('.js-theme-toggle'));

  function updateIcons() {
    const isDark = root.classList.contains('dark');
    document.querySelectorAll('.icon-sun').forEach(el => el.style.display = isDark ? 'inline-block' : 'none');
    document.querySelectorAll('.icon-moon').forEach(el => el.style.display = isDark ? 'none' : 'inline-block');
  }

  function setTheme(theme) {
    if (theme === 'dark') root.classList.add('dark');
    else root.classList.remove('dark');
    localStorage.setItem('theme', theme);
    updateIcons();
  }

  // Inicialização: checa localStorage ou preferência do sistema
  const saved = localStorage.getItem('theme');
  if (saved === 'dark' || saved === 'light') {
    setTheme(saved);
  } else if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
    setTheme('dark');
  } else {
    setTheme('light'); // padrão
  }

  // Associa eventos a todos os botões de toggle
  toggles.forEach(btn => {
    btn.addEventListener('click', () => {
      const isDark = root.classList.contains('dark');
      setTheme(isDark ? 'light' : 'dark');
    });
  });

  // Caso queira, atualize ícones também ao mudar preferências do sistema
  if (window.matchMedia) {
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
      const savedPref = localStorage.getItem('theme');
      if (!savedPref) { // só se o usuário não tiver salvo preferência
        setTheme(e.matches ? 'dark' : 'light');
      }
    });
  }
})();
</script>
