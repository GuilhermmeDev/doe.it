<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
<link rel="icon" href="{{ asset('assets/logo1.svg') }}" type="image/x-icon"/>
  <link rel="stylesheet" href="{{asset('css/home.css')}}">
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
  />

  <style>
    @import url('https://fonts.googleapis.com/css2?family=Bona+Nova+SC:ital,wght@0,400;0,700;1,400&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Righteous&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');
    </style>
</head>
<body class="light-theme duration-200">
    <!-- Cabeçalho da página (navbar) -->
    <header class="mt-5">
      <div class="px-4 mx-auto sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16 lg:h-20">

          <!-- Logotipo -->
          <div class="flex-shrink-0">
            <a href="/home" class="flex">
              <img class="w-auto ml-5 h-8" src="{{asset('assets/logo1.svg')}}" alt="Doeit Logo" />
            </a>
          </div>

          <!-- Container do conteúdo da navbar -->
          <div class="flex items-center justify-between w-full md:w-auto">

            <div class="mr-8">
              <svg id="lupa" xmlns="http://www.w3.org/2000/svg" class="absolute top-0 bottom-0 w-6 h-6 my-auto text-gray-400 left-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
              </svg>
                <form method="GET" action="/home" >
              <input id="pesquisa" type="text" placeholder="Procurar" name="q" class="w-96 py-3 pl-12 pr-4 text-gray-500 border rounded-md outline-none bg-gray-50 focus:bg-white"/>
                </form>
            </div>

            <!-- Links visíveis apenas em telas médias e grandes -->
            <div id="meutext" class="hidden md:flex ml-auto items-center justify-center space-x-6 lg:space-x-10">
              <a href="/info" id="texts" class="text-base font-semibold transition-all duration-100">Sobre</a>
              <!-- Separador -->
              <div class="w-px h-5"></div>
              <a href="/campaign" class="inline-flex items-center justify-center px-5 ml-10 py-2.5 text-base font-semibold border-2 transition-all duration-100" role="button">Criar Campanha</a>
            </div>

            <!-- Botão de alternância de tema visível apenas em telas pequenas -->
            <button id="theme-toggle" class="block md:hidden">
              <img src="{{asset('assets/sol.svg')}}" id="sol" class="w-6 h-6">
              <img src="{{asset('assets/lua.svg')}}" id="lua" class="w-6 h-6">
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
      <div id="mobile-menu" class="hidden absolute top-16 left-4 text-center shadow-lg rounded-lg p-3 w-48 md:hidden bg-white dark:bg-gray-800 z-50">
        <a href="#secao4" id="infor" class="block py-2">Sobre</a>
        <a
        href="/campaign" class="mr-4 inline-flex items-center justify-center px-5 py-2.5 text-base font-semibold border-2 border-black hover:border-gray-800 transition-all duration-100" role="button">
        Criar Campanha
        </a>
      </div>
    </div>

    @if (session('error'))
        {{session('error')}}<br>
    @endif

    @if (session('Success'))
        @include('layouts.success')
    @endif


    @if ($search)
        <p>Procurando campanha: {{$search}}</p>
    @endif

    @if (count($campaigns) === 0)
        <p>Nenhuma campanha disponível</p>
    @endif

    <main class="p-5">
      <section class="container-slide mt-8 ">
        <div class="swiper mySwiper mt-4 px-2">
          <div class="swiper-wrapper">
            @foreach($campaigns as $camp)
                <div class="swiper-slide rounded-xl p-3 h-[530px] bg-[#f0f0f0]">
                  <a href="/campaign/{{$camp->id}}" class="no-underline text-inherit">
                    <div class="flex flex-col text-black">
                      <div class="w-full h-[18em] overflow-hidden rounded-xl">
                        <img src="{{ asset('storage/' . $camp->Image) }}" class="w-full h-full object-cover rounded-xl" alt="Imagem da Campanha: {{ $camp->Title }}" />
                      </div>
                      <div class="flex flex-col mt-4 space-y-2">
                        <p class="text-lg font-semibold ml-1">{{$camp->Title}}</p>      
                        <h6 class="text-sm ml-1 line-clamp-3">
                            {{$camp->Description}}
                        </h6>
                        @if(isset($camp->meta) && is_array($camp->meta) && isset($camp->meta['current']) && isset($camp->meta['target']))
                            <div class="flex items-center ml-1 mt-2 w-full">
                              @php
                                  $current = $camp->meta['current'] ?? 0;
                                  $target = $camp->meta['target'] ?? 0;
                                  $progress = ($target > 0) ? round(100 * ($current / $target), 1) : 0;
                                  $progress = min($progress, 100);
                              @endphp
                              <span class="text-sm font-bold mr-2">{{ $progress }}%</span>
                              <div class="flex-1 bg-gray-300 rounded-full h-5">
                                <div class="bg-green-500 h-5 rounded-full" style="width: {{ $progress }}%;"></div>
                              </div>
                            </div>
                        @endif
                        <button class="mt-5 top-3 relative ml-1 w-[120px] h-[45px] text-white bg-[#5FCB69] hover:bg-[#41ad4c] rounded-xl text-sm font-medium">Saiba mais</button>
                      </div>
                    </div>
                  </a>
                </div>
            @endforeach

            </div>

          <!-- Paginação -->
          <div class="swiper-pagination mt-4"></div>
        </div>
      </section>
    </main>

    <!-- SwiperJS JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
      function calcularSlidesVisiveis() {
        if (window.innerWidth >= 1200) {
          return 3;
        } else if (window.innerWidth >= 992) {
          return 2;
        } else if (window.innerWidth >= 768) {
          return 2;
        } else {
          return 1;
        }
      }

      let swiper = new Swiper(".mySwiper", {
        slidesPerView: calcularSlidesVisiveis(),
        spaceBetween: 20,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
        navigation: false,
        initialSlide: 0,
      });

      window.addEventListener("resize", function () {
        swiper.params.slidesPerView = calcularSlidesVisiveis();
        swiper.update();
      });
    </script>


    <script>
      const themeToggleButton = document.getElementById('theme-toggle');
      const body = document.body;
      const sol = document.getElementById('sol');
      const lua = document.getElementById('lua');

      if(themeToggleButton && sol && lua) {
        const imageSize = "25px";
        sol.style.width = imageSize;
        sol.style.height = imageSize;
        lua.style.width = imageSize;
        lua.style.height = imageSize;

        if (body.classList.contains('dark-theme')) {
            sol.style.display = "inline-block";
            lua.style.display = "none";
        } else {
            sol.style.display = "none";
            lua.style.display = "inline-block";
        }

        themeToggleButton.addEventListener('click', () => {
          body.classList.toggle('light-theme');
          body.classList.toggle('dark-theme');

          if (body.classList.contains('dark-theme')) {
            sol.style.display = "inline-block";
            lua.style.display = "none";
          } else {
            sol.style.display = "none";
            lua.style.display = "inline-block";
          }
        });
      }

      const menuToggle = document.getElementById("menu-toggle");
      const mobileMenu = document.getElementById("mobile-menu");

      if (menuToggle && mobileMenu) {
        menuToggle.addEventListener("click", function(event) {
        mobileMenu.classList.toggle("hidden");
        event.stopPropagation();
        });
      }

    document.addEventListener("click", function(event) {
        const currentMobileMenu = document.getElementById("mobile-menu");
        const currentMenuToggle = document.getElementById("menu-toggle");

        if (currentMobileMenu && currentMenuToggle && !currentMobileMenu.classList.contains("hidden")) {
            if (!currentMobileMenu.contains(event.target) && !currentMenuToggle.contains(event.target)) {
                currentMobileMenu.classList.add("hidden");
            }
        }
    });
    </script>

</body>
</html>