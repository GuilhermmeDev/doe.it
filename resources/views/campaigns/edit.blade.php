<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Atualizar Campanha</title>
    {{-- Vite cuida do CSS (incluindo Tailwind) e JS (incluindo Alpine.js) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- Alpine.js CDN removido: <script src="https://unpkg.com/alpinejs" defer></script> --}}
    <link rel="icon" href="{{ asset('assets/logo1.svg') }}" type="image/x-icon"/>
</head>
<body class="w-full overflow-x-hidden light-theme duration-200 bg-white dark:bg-neutral-900 text-gray-900 dark:text-gray-100">
    @include('layouts.secondary_navbar')
    <section class="min-h-screen flex flex-col justify-center items-center px-4 py-6 sm:px-6 md:px-8">
      <div class="max-w-5xl w-full grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="flex flex-col justify-center">
          <h2 class="text-3xl font-bold sm:text-4xl text-gray-900 dark:text-gray-100">Atualizar Campanha</h2>
          <p class="mt-3 text-base sm:text-md max-w-md text-gray-700 dark:text-gray-300">
            Mantenha suas campanhas atualizadas e maximize o impacto de suas ações.
          </p>
          <img src="{{ asset('assets/curve-line.svg') }}" alt="Curva decorativa" class="mt-6 hidden md:block w-2/3" />
        </div>
        <div class="bg-white dark:bg-neutral-800 text-black dark:text-gray-100 p-6 sm:p-8 rounded-2xl shadow-xl w-full mb-20">
            <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-gray-100">Editar Detalhes da Campanha</h3>
              <form method="POST" action="/campaign/update/{{$campaign->id}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                {{-- Espaço de um div que estava a mais aqui foi removido --}}
                {{-- Nome da Campanha --}}
                <div> {{-- Adicionado um div para agrupar label, input e erro --}}
                    <label for="Title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nome da Campanha</label>
                    <input
                      id="Title" {{-- ID CORRIGIDO para corresponder ao 'for' do label --}}
                      type="text"
                      name="Title"
                      value="{{ old('Title', $campaign->Title) }}" {{-- Adicionado old() --}}
                      required
                      class="w-full mt-2 px-3 py-2 resize-none appearance-none bg-white dark:bg-neutral-900 border border-gray-400 dark:border-neutral-600 focus:border-indigo-600 shadow-sm rounded-md text-gray-900 dark:text-gray-100"
                    />
                    @error('Title')
                        {{-- Mantendo a exibição direta de erro como você fez aqui --}}
                        <p style="color: red; font-size: 0.8rem; margin-top: 0.2rem;">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-4"> {{-- Adicionado mt-4 para espaçamento consistente --}}
                    <label for="Description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Descrição</label> {{-- Adicionado 'block text-sm' e 'for' --}}
                    <textarea
                        id="Description" {{-- Adicionado ID --}}
                        name="Description"
                        required
                        rows="4" {{-- Adicionado rows para altura inicial --}}
                        class="w-full mt-2 h-36 px-3 py-2 resize-none appearance-none bg-white dark:bg-neutral-900 border border-gray-400 dark:border-neutral-600 focus:border-indigo-600 shadow-sm rounded-md text-gray-900 dark:text-gray-100"
                    >{{ old('Description', $campaign->Description) }}</textarea> {{-- Adicionado old() --}}
                    @error('Description')
                        <p style="color: red; font-size: 0.8rem; margin-top: 0.2rem;">{{ $message }}</p>
                    @enderror
                </div>
              
                <div class="mt-4">
                    <label for="Image" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Imagem da Campanha <span class="text-xs text-gray-500 dark:text-gray-400">(Opcional: envie apenas se quiser alterar a atual)</span></label>
                    <div class="mt-1">
                      <input
                        id="Image" {{-- ID CORRIGIDO para corresponder ao 'for' do label --}}
                        name="Image"
                        type="file"
                        accept=".jpeg,.jpg,.png,.svg" {{-- Adicionado .svg e corrigido separador --}}
                        class="block w-full px-3 py-2 text-sm text-gray-900 dark:text-gray-100 border border-gray-300 dark:border-neutral-600 rounded-md bg-white dark:bg-neutral-900 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:bg-[#5FCB69] file:text-white hover:file:bg-[#357E3C] focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                      />
                    @error('Image')
                        <p style="color: red; font-size: 0.8rem; margin-top: 0.2rem;">{{ $message }}</p>
                    @enderror
                    </div>
                </div>

                @if($campaign->Image) {{-- Mostrar imagem atual se existir --}}
                    <div class="mt-4">
                        <p class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Imagem Atual:</p>
                        {{-- Ajuste no caminho da imagem: use asset() para storage se for o caso, ou img/campaigns --}}
                        <img src="{{asset('img/campaigns/' . $campaign->Image)}}" class="rounded-md w-full object-cover" alt="Imagem atual da campanha: {{ $campaign->Title }}" style="max-height: 200px;">
                    </div>
                @endif
                
                <div class="pt-6"> {{-- Aumentado padding top para espaçamento --}}
                    <button
                    type="submit"
                      class="w-full px-4 py-2 text-white font-medium bg-[#5FCB69] hover:bg-[#357E3C] active:bg-indigo-600 rounded-md duration-150"
                    >
                      Atualizar
                    </button>
                </div>
            </form>
        </div>
      </div>
    </section>
  </body>
</html>