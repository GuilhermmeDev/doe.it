<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="{{ asset('assets/logo1.svg') }}" type="image/x-icon"/>
  <script defer src="js/cdn.min.js"></script>
  <title>Login - Doeit</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white dark:bg-neutral-900 text-gray-600 dark:text-gray-100">
<main class="w-full flex">

  <div class="relative flex-[3] hidden items-center justify-center h-screen lg:flex" style="background-color: #2AB036;">
    <div class="relative w-full max-w-md flex flex-col items-center space-y-6">
      <img src="{{ asset('assets/maodoação.svg') }}" width="347" />
      <p class="text-gray-300 text-center px-10 font-bold">
        “No <span style="color: #FF5800;">Doeit</span>, cada doação é um ato de amor que pode transformar vidas.”
        Junte-se a nós e faça a diferença!
      </p>
    </div>
  </div>

  <div class="flex-[2] flex items-center justify-center h-screen">
    <div class="w-full max-w-md space-y-8 px-4 bg-white dark:bg-neutral-900 text-gray-600 dark:text-gray-100 sm:px-0">

      <div class="flex justify-center mb-6">
        <img src="{{ asset('assets/logo1.svg') }}" alt="Sua imagem aqui" class="w-32 h-32 object-contain">
      </div>

      <form action="{{ route('login') }}" class="space-y-5" method="POST">
        @csrf
        <div>
          <label class="font-medium text-gray-900 dark:text-gray-100">Email</label>
          <input
            type="email"
            name="email"
            required
            class="w-full mt-2 px-3 py-2 text-gray-500 dark:text-gray-300 bg-transparent outline-none border border-gray-300 dark:border-neutral-600 focus:border-indigo-600 shadow-sm rounded-lg"
            placeholder="Insira seu e-mail"
            value="{{ old('email') }}"
          />
          @error('email')
              <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
          @enderror
        </div>
        <div class="relative">
          <label class="font-medium text-gray-900 dark:text-gray-100" for="password">Senha</label>
          <div class="flex flex-row w-full  mt-2 text-gray-500 dark:text-gray-300  border border-gray-300 dark:border-neutral-600 focus:border-indigo-600 shadow-sm rounded-lg pr-5 items-center justify-between">
            <input
              id="password"
              type="password"
              name="password"
              required
              class="bg-transparent outline-none border-none"
              placeholder="Insira sua senha"
            />
            @error('password')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
            <img
              id="eyeIcon"
              src="{{ asset('assets/oculto.svg') }}"
              data-visivel-src="{{ asset('assets/visivel.svg') }}"
              data-oculto-src="{{ asset('assets/oculto.svg') }}"
              alt="Mostrar senha"
              class="object-cover size-6 cursor-pointer"
            />
          </div>
          <a href="{{ route('password.request') }}" class="text-gray-500 dark:text-gray-300 text-sm mt-2 block text-right">Esqueceu sua senha?</a>
        </div>

        <div class="flex flex-col items-center">
          <button
            type="submit"
            class="w-2/5 mt-3 px-4 py-2 text-white font-bold bg-[#2AB036] hover:bg-green-600 active:bg-green-700 rounded-lg duration-150 text-sm"
          >
            Entrar
          </button>
          <a href="{{ route('register') }}" class="text-sm text-[#575761] dark:text-gray-400 hover:underline mt-4 text-center">
            Ainda não tem uma conta?<span class="text-[#FF5800]"> Cadastre-se</span>
          </a>
        </div>

        <div class="flex justify-center mt-4">
          <a class="flex items-center justify-center p-2 border border-gray-300 dark:border-neutral-600 rounded-full hover:bg-gray-50 dark:hover:bg-neutral-700 duration-150 active:bg-gray-100 dark:active:bg-neutral-800" href="{{ url('/login/google') }}">
            <img
              src="{{asset('assets/google-logo.png')}}"
              alt="Google"
              class="w-6 h-6"
            />
          </a>
        </div>
      </form>
    </div>
  </div>
</main>
</body>
</html>

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