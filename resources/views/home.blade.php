<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <link rel="icon" href="{{ asset('assets/logo1.svg') }}" type="image/x-icon" />
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white dark:bg-neutral-900 text-black dark:text-white overflow-x-hidden">
  @include('layouts.secondary_navbar')
  @if (session('error'))
  @include('layouts.error_popup')
  @endif
  @if (session('Success'))
  @include('layouts.success')
  @endif

  <main class="container mx-auto px-4 py-8 max-w-7xl">
    @if ($search)
    <div class="mb-8">
      <div class="bg-green-50 dark:bg-green-900/20 border-l-4 border-[#5FCB69] p-4 rounded-r-lg">
        <p class="text-green-800 dark:text-green-300 font-medium">
          <span class="font-semibold">Procurando por:</span> "{{$search}}"
        </p>
      </div>
    </div>
    @endif

    @if (count($campaigns) === 0)
    <section class="flex flex-col items-center justify-center min-h-[60vh] py-12">
      <div class="text-center max-w-md">
        
        <img src="{{ asset('assets/data-searching.svg') }}" alt="data searching" class="w-32 h-32 mx-auto mb-6"/>
        @if ($search)
        <h3 class="text-2xl font-bold mb-3 text-gray-800 dark:text-gray-200">
          Nenhuma campanha encontrada
        </h3>
        <p class="text-gray-600 dark:text-gray-400 mb-6">
          Não encontramos campanhas que correspondam à sua busca por "<span class="font-semibold">{{$search}}</span>".
        </p>
        <a href="/" class="inline-block px-6 py-3 bg-[#5FCB69] hover:bg-[#41ad4c] text-white font-semibold rounded-lg transition-colors duration-200">
          Ver todas as campanhas
        </a>
        @else
        <h3 class="text-2xl font-bold mb-3 text-gray-800 dark:text-gray-200">
          Nenhuma campanha disponível
        </h3>
        <p class="text-gray-600 dark:text-gray-400 mb-6">
          Ainda não há campanhas criadas. Seja o primeiro a criar uma campanha e fazer a diferença!
        </p>
        <a href="/campaign" class="inline-block px-6 py-3 bg-[#5FCB69] hover:bg-[#41ad4c] text-white font-semibold rounded-lg transition-colors duration-200">
          Criar primeira campanha
        </a>
        @endif
      </div>
    </section>
    @else
    <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
      @foreach($campaigns as $camp)
      <article class="rounded-xl overflow-hidden bg-[#f0f0f0] dark:bg-neutral-800 transition-transform duration-300 hover:scale-[1.02] hover:shadow-xl flex flex-col">
        <a href="/campaign/{{$camp->id}}" class="no-underline text-inherit flex flex-col h-full">
          <div class="w-full h-64 overflow-hidden flex-shrink-0">
            <img src="{{ asset('storage/' . $camp->Image) }}"
              class="w-full h-full object-cover transition-transform duration-300 hover:scale-110"
              alt="Imagem da Campanha: {{ $camp->Title }}" />
          </div>

          <div class="flex flex-col p-5 flex-grow">
            <h3 class="text-lg font-bold mb-2 text-black dark:text-white line-clamp-2 min-h-[3.5rem]">
              {{$camp->Title}}
            </h3>

            <p class="text-sm text-gray-600 dark:text-gray-300 mb-4 line-clamp-3">
              {{$camp->Description}}
            </p>

            <div class="mt-auto">
              @if(isset($camp->meta) && is_array($camp->meta) && isset($camp->meta['current']) && isset($camp->meta['target']))
              <div class="mb-4">
                @php
                $current = $camp->meta['current'] ?? 0;
                $target = $camp->meta['target'] ?? 0;
                $progress = ($target > 0) ? round(100 * ($current / $target), 1) : 0;
                $progress = min($progress, 100);
                @endphp

                <div class="flex items-center justify-between mb-2">
                  <span class="text-sm font-semibold text-gray-700 dark:text-gray-300">
                    {{ $progress }}% alcançado
                  </span>
                  <span class="text-xs text-gray-500 dark:text-gray-400">
                    {{number_format($current, 0, ',', '.')}} / {{number_format($target, 0, ',', '.')}}
                  </span>
                </div>

                <div class="w-full bg-gray-300 dark:bg-gray-600 rounded-full h-2.5 overflow-hidden">
                  <div class="bg-gradient-to-r from-[#5FCB69] to-[#41ad4c] h-2.5 rounded-full transition-all duration-500"
                    style="width: {{ $progress }}%;"></div>
                </div>
              </div>
              @endif

              <button class="w-full py-3 text-white bg-[#5FCB69] hover:bg-[#41ad4c] rounded-lg text-sm font-bold transition-colors duration-200">
                Saiba mais
              </button>
            </div>
          </div>
        </a>
      </article>
      @endforeach
    </section>
    @endif
  </main>
</body>

</html>