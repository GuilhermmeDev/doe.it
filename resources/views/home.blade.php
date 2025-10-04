<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <link rel="icon" href="{{ asset('assets/logo1.svg') }}" type="image/x-icon"/>
  <script defer src="js/cdn.min.js"></script>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <link rel="stylesheet" href="css/swiper-bundle.min.css" />
</head>
<body class="bg-white dark:bg-neutral-900 text-black dark:text-white overflow-x-hidden">
  @include('layouts.secondary_navbar')

    @if (session('error'))
        @include('layouts.error_popup')
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
      <section class="container-slide mt-8">
        <div class="swiper mySwiper mt-4 px-2">
          <div class="swiper-wrapper">
            @foreach($campaigns as $camp)
                <div class="swiper-slide rounded-xl p-4 h-[530px] bg-[#f0f0f0] dark:bg-neutral-800">
                  <a href="/campaign/{{$camp->id}}" class="no-underline text-inherit">
                    <div class="flex flex-col text-black dark:text-white">
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
                              <div class="flex-1 bg-gray-300 dark:bg-gray-600 rounded-full h-5">
                                <div class="bg-green-500 h-5 rounded-full" style="width: {{ $progress }}%;"></div>
                              </div>
                            </div>
                        @endif
                        <button class="mt-5 top-3 relative ml-1 w-[120px] h-[45px] text-white bg-[#5FCB69] hover:bg-[#41ad4c] rounded-xl text-sm font-bold">Saiba mais</button>
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
    <link rel="stylesheet" href="css/swiper-bundle.min.css" />
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
</body>
</html>