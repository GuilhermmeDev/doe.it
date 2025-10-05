<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('assets/logo1.svg') }}" type="image/x-icon"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Esqueceu a Senha? - Doeit</title>
    <script>
      // Aplica o tema salvo no localStorage antes do carregamento visual
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
    <main class="h-full flex flex-col justify-center items-center">
      <img src="{{ asset('assets/logo1.svg') }}" alt="logo doeit" class="w-24 h-24 mb-6">
      <section class="max-w-3xl px-6 py-16 mx-auto text-center bg-white dark:bg-neutral-800 rounded-lg shadow-lg">
          <h1 class="text-3xl font-semibold text-gray-900 dark:text-gray-100">Perdeu a Senha?</h1>
          <p class="max-w-md mx-auto mt-5 text-gray-700 dark:text-gray-300">Não se preocupe. Nós iremos te mandar um e-mail de recupação de senha.</p>

          <form class="flex flex-col mt-8 space-y-3 sm:space-y-0 sm:flex-row sm:justify-center sm:-mx-2" method="POST" action="{{route('password.email')}}">
              @csrf
              <input id="email" type="email" name="email" class="px-4 py-2 border border-gray-300 dark:border-neutral-600 rounded-md sm:mx-2 focus:border-blue-400 focus:outline-none focus:ring focus:ring-opacity-40 bg-white dark:bg-neutral-900 text-gray-900 dark:text-gray-100" placeholder="Digite seu email" required>
              @error('email')
                  @include('layouts.error_popup')
              @enderror
              <button class="px-4 py-2 text-sm font-medium tracking-wide capitalize text-white transition-colors duration-300 transform bg-[#2AB036] hover:bg-green-600 active:bg-green-700 rounded-md sm:mx-2 focus:outline-none ">
                  Recuperar Senha
              </button>
          </form>
      </section>
    </main>
</body>
</html>
