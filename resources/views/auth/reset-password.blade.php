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
            <div class="flex flex-col w-full">
                <div class="flex flex-row w-full px-3 py-2 mt-2 text-gray-500 dark:text-gray-300  border border-gray-300 dark:border-neutral-600 focus:border-indigo-600 shadow-sm rounded-lg pr-5 items-center justify-between">
                    <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    class="bg-transparent outline-none border-none"
                    placeholder="Insira sua senha"
                    />

                    <img
                        id="eyeIcon"
                        src="{{ asset('assets/oculto.svg') }}"
                        data-visivel-src="{{ asset('assets/visivel.svg') }}"
                        data-oculto-src="{{ asset('assets/oculto.svg') }}"
                        alt="Mostrar senha"
                        class="object-cover size-6 cursor-pointer"
                        />
                </div>
              @error('password')
                  <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
              @enderror
            </div>
        </div>

        <div class="relative">
            <label class="font-medium text-gray-900 dark:text-gray-100">Confirmar senha</label>
            <div class="flex flex-col w-full">
              <div class="flex flex-row w-full mt-2 px-3 py-2 text-gray-500 dark:text-gray-300  border border-gray-300 dark:border-neutral-600 focus:border-indigo-600 shadow-sm rounded-lg pr-5 items-center justify-between">
                  <input
                  placeholder="Confirme sua senha"
                  id="cpassword"
                  name="password_confirmation"
                  type="password"
                  required
                  class="bg-transparent outline-none border-none"
                  />
                  <img
                  id="eyeIcon2"
                  src="{{ asset('assets/oculto.svg') }}"
                  data-visivel-src="{{ asset('assets/visivel.svg') }}"
                  data-oculto-src="{{ asset('assets/oculto.svg') }}"
                  alt="Mostrar senha"
                  class="object-cover size-6 cursor-pointer"

                  />
              </div>
            @error('password_confirmation')
               <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
            </div>
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
