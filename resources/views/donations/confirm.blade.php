<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="{{ asset('assets/favicon.svg') }}" type="image/x-icon"/>
  <title>Confirmar Doação</title>
  @vite(['resources/css/app.css', 'resources/js/app.js']) {{-- Vite directive added here --}}
</head>
<body class="bg-white dark:bg-neutral-900 overflow-x-hidden">

@include('layouts.secondary_navbar')

  <!-- Conteúdo principal -->
  <!-- Conteúdo principal com imagem ao lado -->
<div class="flex justify-between items-start mt-25">
  <main class="flex-1 w-full max-w-full px-4">

    <h1 class="text-xl font-semibold mb-2 ml-7 text-gray-900 dark:text-gray-100">Confirmar Doação</h1>

    @if ($donation->Description)
    <p class="text-gray-600 dark:text-gray-300 mb-4 ml-7">Descrição do produto</p>

    <div class="max-w-md">

      <label for="Notes">
        <div
          class="relative mt-0.5 overflow-hidden rounded border border-gray-300 dark:border-neutral-600 shadow-sm focus-within:ring focus-within:ring-blue-600 mb-3 ml-7 bg-white dark:bg-neutral-800"
        >
          <textarea
            id="Notes"
            class="w-full border-none focus:ring-0 focus:outline-none sm:text-sm p-4 bg-white dark:bg-neutral-800 text-gray-500 dark:text-gray-300"
            rows="6"
          >{{$donation->Description}}</textarea>
        </div>
      </label>
    </div>
    @endif

    <p class="mb-4 text-gray-600 dark:text-gray-300 text-sm font-semibold ml-7">Quantidade Doada: {{$donation->Quantity}}</p>

    <p class="mb-4 text-gray-600 dark:text-gray-300 text-sm font-semibold ml-7">Doador: {{$donation->user->name}}</p>

    <p class="text-gray-600 dark:text-gray-300 font-semibold mb-3 ml-7">Você tem certeza que quer confirmar essa doação?</p>

    <form class="flex gap-4 mb-4 ml-7" method="POST" action="/confirm/{{$donation->id}}">
    @csrf
     <button type="submit" class="w-full sm:w-60 py-3 text-center text-white duration-100 bg-indigo-600 rounded-md shadow-md focus:shadow-none ring-offset-2 ring-indigo-600 focus:ring-2"
      style="background-color: #5FCB69;">
      Confirmar Doação
    </button>

    <a href="/home"
      class="w-full sm:w-60 py-3 text-center text-white duration-100 bg-red-600 rounded-md shadow-md focus:shadow-none ring-offset-2 ring-red-600 focus:ring-2"
      style="background-color: red;">
      Voltar
    </a>

    </form>

    <p class="text-gray-600 dark:text-gray-300 text-sm ml-7">
      Ao clicar em "<span class="italic">Confirmar Doação</span>" você afirma que recebeu tal doação
    </p>
  </main>

  <!-- Imagem à direita -->
  <div class="hidden md:block flex-shrink-0 mt-6 lg:mt-0 lg:ml-7">
    <img src="{{asset('assets/doodle_group.svg')}}" alt="Confirmação" class="w-full max-w-xs lg:max-w-[380px] h-auto mx-auto lg:mx-15"/>
  </div>

  </div>

</body>
</html>
