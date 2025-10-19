<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="robots" content="noindex, follow">

  <meta name="description" content="Recupere sua senha do DoeIT de forma segura. Insira seu e-mail e siga as instruções para redefinir o acesso à sua conta.">

  <link rel="canonical" href="https://doeit.com.br/password/request" />
 <link rel="icon" href="{{ asset('assets/favicon.svg') }}" type="image/x-icon" />
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <title>Esqueceu a Senha? - Doeit</title>
  <script>
    (function() {
      const theme = localStorage.getItem('theme');
      if (theme === 'dark') {
        document.documentElement.classList.add('dark');
      } else {
        document.documentElement.classList.remove('dark');
      }
    })();
  </script>
</head>

<body class="h-screen bg-white dark:bg-neutral-900 text-gray-900 dark:text-gray-100">
  <div class="absolute top-0 left-0 z-50 pt-4 pl-4">
    <a href="{{ redirect()->back()->getTargetUrl()}}"
       class="flex items-center gap-2 px-4 py-2 rounded-lg text-black dark:text-white text-base font-semibold focus:outline-none">
      <svg class="w-5 h-5 text-black dark:text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" /></svg>
      Voltar
    </a>
  </div>
  <main class="h-full flex flex-col justify-center items-center">
    <a href="{{redirect()->back()->getTargetUrl()}}">
        <img src="{{ asset('assets/logo1.svg') }}" alt="logo doeit" class="w-24 h-24 mb-6">
    </a>
    <section class="max-w-3xl min-h-[520px] px-6 py-16 mx-auto text-center bg-white dark:bg-neutral-800 rounded-lg shadow-lg relative flex flex-col justify-center" id="forgotPasswordSection">
      <h1 class="text-3xl font-semibold text-gray-900 dark:text-gray-100">Perdeu a Senha?</h1>
      <p class="max-w-md mx-auto mt-5 text-gray-700 dark:text-gray-300">Não se preocupe. Nós iremos te mandar um e-mail de recupação de senha.</p>

      {{-- Mensagem flash: prioridade erro > sucesso --}}
      @if(session('error'))
        <div class="flex w-full max-w-md mx-auto mt-6 mb-2 overflow-hidden bg-white rounded-lg shadow-md border border-red-300 dark:bg-gray-800 dark:border-red-700">
          <div class="flex items-center justify-center w-12 bg-red-500">
            <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
              <path d="M20 3.36667C10.8167 3.36667 3.3667 10.8167 3.3667 20C3.3667 29.1833 10.8167 36.6333 20 36.6333C29.1834 36.6333 36.6334 29.1833 36.6334 20C36.6334 10.8167 29.1834 3.36667 20 3.36667ZM19.1334 33.3333V22.9H13.3334L21.6667 6.66667V17.1H27.25L19.1334 33.3333Z" />
            </svg>
          </div>
          <div class="px-4 py-2 -mx-3">
            <div class="mx-3">
              <span class="font-semibold text-red-500 dark:text-red-400">Erro</span>
              <p class="text-sm text-gray-600 dark:text-gray-200">{{ session('error') }}</p>
            </div>
          </div>
        </div>
      @elseif($errors->any())
        <div class="flex w-full max-w-md mx-auto mt-6 mb-2 overflow-hidden bg-white rounded-lg shadow-md border border-red-300 dark:bg-gray-800 dark:border-red-700">
          <div class="flex items-center justify-center w-12 bg-red-500">
            <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
              <path d="M20 3.36667C10.8167 3.36667 3.3667 10.8167 3.3667 20C3.3667 29.1833 10.8167 36.6333 20 36.6333C29.1834 36.6333 36.6334 29.1833 36.6334 20C36.6334 10.8167 29.1834 3.36667 20 3.36667ZM19.1334 33.3333V22.9H13.3334L21.6667 6.66667V17.1H27.25L19.1334 33.3333Z" />
            </svg>
          </div>
          <div class="px-4 py-2 -mx-3">
            <div class="mx-3">
              <span class="font-semibold text-red-500 dark:text-red-400">Erro</span>
              <ul class="text-sm text-gray-600 dark:text-gray-200 mt-1 list-disc list-inside">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          </div>
        </div>
      @elseif(session('status'))
        <div class="flex w-full max-w-md mx-auto mt-6 mb-2 overflow-hidden bg-white rounded-lg shadow-md border border-green-300 dark:bg-green-900 dark:border-green-700">
          <div class="flex items-center justify-center w-12 bg-green-500">
            <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
              <path d="M20 3.36667C10.8167 3.36667 3.3667 10.8167 3.3667 20C3.3667 29.1833 10.8167 36.6333 20 36.6333C29.1834 36.6333 36.6334 29.1833 36.6334 20C36.6334 10.8167 29.1834 3.36667 20 3.36667ZM28.3334 15L17.5 25.8333L11.6667 20L13.3334 18.3333L17.5 22.5L26.6667 13.3333L28.3334 15Z" />
            </svg>
          </div>
          <div class="px-4 py-2 -mx-3">
            <div class="mx-3">
              <span class="font-semibold text-green-500 dark:text-green-400">Sucesso</span>
              <p class="text-sm text-gray-600 dark:text-gray-200">{{ session('status') }}</p>
            </div>
          </div>
        </div>
      @endif

  <form id="forgotPasswordForm" class="flex flex-col mt-8 space-y-3 sm:space-y-0 sm:flex-row sm:justify-center sm:-mx-2" method="POST" action="{{route('password.email')}}">
        @csrf
        <input id="email" type="email" name="email" class="px-4 py-2 border border-gray-300 dark:border-neutral-600 rounded-md sm:mx-2 focus:border-blue-400 focus:outline-none focus:ring focus:ring-opacity-40 bg-white dark:bg-neutral-900 text-gray-900 dark:text-gray-100" placeholder="Digite seu email" required>
  {{-- Removido erro duplicado do input --}}
        <button id="submitBtn" type="submit" class="px-4 py-2 text-sm font-medium tracking-wide capitalize text-white transition-colors duration-300 transform bg-[#2AB036] hover:bg-green-600 active:bg-green-700 rounded-md sm:mx-2 focus:outline-none ">
          Recuperar Senha
        </button>
      </form>

      <div id="spinner" style="display:none;" class="w-full flex flex-col items-center justify-center mt-6">
        <svg aria-hidden="true" role="status" class="w-12 h-12 text-blue-500 animate-spin mb-2" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
          <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
        </svg>
        <span class="text-blue-700 dark:text-blue-400 font-semibold text-lg">Carregando...</span>
      </div>
    </section>
  </main>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      var form = document.getElementById('forgotPasswordForm');
      var spinner = document.getElementById('spinner');
      if (form && spinner) {
        form.addEventListener('submit', function () {
          spinner.style.display = 'flex';
        });
      }
      spinner.style.display = 'none';
    });
  </script>
</body>

</html>
