<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="{{ asset('assets/logo1.svg') }}" type="image/x-icon"/>
  <script defer src="js/cdn.min.js"></script>
  <title>DoeIt - Redefinir Senha</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white dark:bg-neutral-900 text-gray-600 dark:text-gray-100">
<main class="w-full flex">

  <!-- Lado esquerdo -->
  <div class="relative flex-[3] hidden items-center justify-center h-screen lg:flex bg-[#2AB036]">
    <div class="relative w-full max-w-md flex flex-col items-center space-y-6">
      <img src="{{ asset('assets/shield.svg') }}" width="347" />
      <p class="text-gray-300 text-center px-10 font-bold">
        <span class="text-black">Use uma senha forte:</span> Combine letras maiúsculas, minúsculas, números e caracteres especiais.
      </p>
    </div>
  </div>

  <!-- Formulário -->
  <div class="flex-[2] flex items-center justify-center h-screen">
    <div class="w-full max-w-md space-y-8 px-4 bg-white dark:bg-neutral-900 text-gray-600 dark:text-gray-100 sm:px-0">

      <!-- Logo -->
      <div class="flex justify-center mb-6">
        <img src="{{ asset('assets/logo1.svg') }}" alt="Sua imagem aqui" class="w-32 h-32 object-contain">
      </div>

      <form action="{{route('password.store')}}" class="space-y-5" method="POST">
        <input type="hidden" name="token" value="{{ request()->route('token') }}">
        @csrf

        <!-- Email -->
        <div>
          <label class="font-medium text-gray-900 dark:text-gray-100">Email</label>
          <input
            type="email"
            name="email"
            id="email"
            required
            placeholder="Insira seu email"
            value="{{ old('email', request()->email) }}"
            class="w-full mt-2 px-3 py-2 text-gray-500 dark:text-gray-300 bg-transparent outline-none border border-gray-300 dark:border-neutral-600 focus:border-indigo-600 shadow-sm rounded-lg"
          />
          @error("email")
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Senha -->
        <div class="relative">
          <label for="password" class="font-medium text-gray-900 dark:text-gray-100">Senha</label>
          <div class="flex flex-row w-full mt-2 text-gray-500 dark:text-gray-300 border border-gray-300 dark:border-neutral-600 focus-within:border-indigo-600 shadow-sm rounded-lg pr-5 items-center justify-between">
            <input
              id="password"
              type="password"
              name="password"
              required
              class="bg-transparent outline-none border-none flex-1 px-3 py-2"
              placeholder="Digite sua nova senha"
            />
            <img
              id="eyePassword"
              src="{{ asset('assets/oculto.svg') }}"
              data-visivel-src="{{ asset('assets/visivel.svg') }}"
              data-oculto-src="{{ asset('assets/oculto.svg') }}"
              alt="Mostrar senha"
              class="object-cover size-6 cursor-pointer"
            />
          </div>
          @error("password")
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Confirmar Senha -->
        <div class="relative">
          <label for="password_confirmation" class="font-medium text-gray-900 dark:text-gray-100">Confirmar Senha</label>
          <div class="flex flex-row w-full mt-2 text-gray-500 dark:text-gray-300 border border-gray-300 dark:border-neutral-600 focus-within:border-indigo-600 shadow-sm rounded-lg pr-5 items-center justify-between">
            <input
              id="password_confirmation"
              type="password"
              name="password_confirmation"
              required
              class="bg-transparent outline-none border-none flex-1 px-3 py-2"
              placeholder="Confirme sua nova senha"
            />
            <img
              id="eyeConfirmPassword"
              src="{{ asset('assets/oculto.svg') }}"
              data-visivel-src="{{ asset('assets/visivel.svg') }}"
              data-oculto-src="{{ asset('assets/oculto.svg') }}"
              alt="Mostrar senha"
              class="object-cover size-6 cursor-pointer"
            />
          </div>
          @error("password_confirmation")
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Botão -->
        <div class="flex justify-center">
          <button
            class="w-2/5 mt-5 px-4 py-2 text-white font-bold bg-[#2AB036] hover:bg-green-600 active:bg-green-700 rounded-lg duration-150 text-sm"
            type="submit"
          >
            Redefinir Senha
          </button>
        </div>
      </form>
    </div>
  </div>
</main>
</body>
</html>

<script>
  // Dark mode persistente
  (function() {
    const theme = localStorage.getItem('theme');
    if (theme === 'dark') {
      document.documentElement.classList.add('dark');
    } else {
      document.documentElement.classList.remove('dark');
    }
  })();

  // Toggle de senha
  document.addEventListener('DOMContentLoaded', function () {
    function togglePassword(inputId, iconId) {
      const input = document.getElementById(inputId);
      const icon = document.getElementById(iconId);

      if (input && icon) {
        const visivelSrc = icon.dataset.visivelSrc;
        const ocultoSrc = icon.dataset.ocultoSrc;

        icon.addEventListener('click', function () {
          if (input.type === 'password') {
            input.type = 'text';
            icon.src = visivelSrc;
          } else {
            input.type = 'password';
            icon.src = ocultoSrc;
          }
        });
      }
    }

    togglePassword('password', 'eyePassword');
    togglePassword('password_confirmation', 'eyeConfirmPassword');
  });
</script>
