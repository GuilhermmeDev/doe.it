<!DOCTYPE html>
<html lang="en" x-data="{ showPassword: false, showConfirmPassword: false }">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="{{ asset('assets/favicon.svg') }}" type="image/x-icon"/>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <script defer src="js/cdn.min.js"></script>
  <title>DoeIt - Redefinir Senha</title>
</head>
<body class="bg-white text-gray-600 dark:bg-neutral-900 dark:text-gray-400">
<main class="w-full flex">

  <!-- Lado esquerdo -->
  <div class="relative flex-[3] hidden items-center justify-center h-screen lg:flex bg-[#2AB036]">
    <div class="relative w-full max-w-md flex flex-col items-center space-y-6">
      <img src="{{asset('assets/shield.svg')}}" class="size-64" />
      <p class="text-gray-300 text-center px-10">
        <span class="text-[#FF5800]">Use uma senha forte:</span> Combine letras maiúsculas, minúsculas, números e caracteres especiais.
      </p>
    </div>
  </div>

  <!-- Formulário -->
  <div class="flex-[2] flex items-center justify-center h-screen">
    <div class="w-full max-w-md space-y-8 px-4 bg-white dark:bg-neutral-900 text-gray-600 dark:text-gray-400 sm:px-0 rounded-xl shadow-lg">

      <!-- Logo -->
      <div class="flex justify-center mb-6">
        <img src="{{asset('assets/logo1.svg')}}" alt="Sua imagem aqui" class="w-32 h-32 object-contain">
      </div>

      <form action="{{route('password.store')}}" class="space-y-5" method="POST">
        <input type="hidden" name="token" value="{{ request()->route('token') }}">
        @csrf

        <div>
          <label for="email" class="font-medium dark:text-gray-300">Email</label>
          <input
            type="email"
            name="email"
            id="email"
            required
            placeholder="Insira seu email"
            value="{{ old('email', request()->email) }}"
            class="w-full mt-2 px-3 py-2 text-gray-500 dark:text-gray-300 bg-transparent outline-none border dark:border-gray-700 focus:border-indigo-600 shadow-sm rounded-lg"
          />
          @error("email")
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div class="relative">
          <label for="password" class="font-medium dark:text-gray-300">Senha</label>
          <input
            :type="showPassword ? 'text' : 'password'"
            name="password"
            id="password"
            required
            placeholder="Digite sua nova senha"
            class="w-full mt-2 px-3 py-2 pr-10 text-gray-500 dark:text-gray-300 bg-transparent outline-none border dark:border-gray-700 focus:border-indigo-600 shadow-sm rounded-lg"
          />
          <button type="button" @click="showPassword = !showPassword" class="absolute top-1/2 -translate-y-1/2 right-3 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 mt-1">
            <svg x-show="!showPassword" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>
            <svg x-show="showPassword" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.973 9.973 0 013.362-4.568m4.105-2.107A10.05 10.05 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.973 9.973 0 01-1.357 2.572M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18" />
            </svg>
          </button>
          @error("password")
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div class="relative">
          <label for="password_confirmation" class="font-medium dark:text-gray-300">Confirmar Senha</label>
          <input
            :type="showConfirmPassword ? 'text' : 'password'"
            name="password_confirmation"
            id="password_confirmation"
            required
            placeholder="Confirme sua nova senha"
            class="w-full mt-2 px-3 py-2 pr-10 text-gray-500 dark:text-gray-300 bg-transparent outline-none border dark:border-gray-700 focus:border-indigo-600 shadow-sm rounded-lg"
          />
          <button type="button" @click="showConfirmPassword = !showConfirmPassword" class="absolute top-1/2 -translate-y-1/2 right-3 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 mt-1">
            <svg x-show="!showConfirmPassword" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>
            <svg x-show="showConfirmPassword" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.973 9.973 0 013.362-4.568m4.105-2.107A10.05 10.05 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.973 9.973 0 01-1.357 2.572M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18" />
            </svg>
          </button>
          @error("password_confirmation")
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div class="flex justify-center">
          <button
            class="w-2/5 mt-5 px-4 py-2 text-white font-medium bg-[#2AB036] hover:bg-green-600 active:bg-green-700 rounded-lg duration-150 text-sm"
            type="submit"
          >
            Redefinir Senha
          </button>
        </div>
      </form>
    </div>
  </div>
</main>

<script>
  // Garante que o tema seja aplicado antes do carregamento visual
  (function() {
    const theme = localStorage.getItem('theme');
    if (theme === 'dark') {
      document.documentElement.classList.add('dark');
    } else {
      document.documentElement.classList.remove('dark');
    }
  })();
</script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const passwordField = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');

    if (passwordField && eyeIcon) {
      const visivelSrc = eyeIcon.dataset.visivelSrc;
      const ocultoSrc = eyeIcon.dataset.ocultoSrc;

      eyeIcon.addEventListener('click', function () {
        if (passwordField.type === 'password') {
          passwordField.type = 'text';
          eyeIcon.src = visivelSrc;
        } else {
          passwordField.type = 'password';
          eyeIcon.src = ocultoSrc;
        }
      });
    }
  });
</script>
</body>
</html>
