<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="robots" content="index, follow">

  <meta name="description" content="Crie sua conta gratuita no DoeIT em minutos. Junte-se à nossa comunidade para criar campanhas, doar com segurança e fazer a diferença na vida de quem precisa.">

  <link rel="canonical" href="https://doeit.com.br/register" />
  <link rel="icon" href="{{ asset('assets/favicon.svg') }}" type="image/x-icon"/>
  <title>Registro - Doeit</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])

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
<body class="bg-white dark:bg-neutral-900 text-gray-600 dark:text-gray-100">
<main class="w-full flex">

  <section class="relative flex-[3] hidden items-center justify-center h-screen lg:flex" style="background-color: #2AB036;">
    <div class="relative w-full max-w-md flex flex-col items-center space-y-6">
      <img src="{{asset('assets/maodoação.svg')}}" class="size-64" />
      <p class="text-gray-300 text-center px-10 font-bold">
        “No <span style="color: #FF5800;">Doeit</span>, cada doação é um ato de amor que pode transformar vidas.”
        Junte-se a nós e faça a diferença!
      </p>
    </div>
  </section>

  <section class="flex-[2] flex items-center justify-center h-screen">
    <div class="w-full max-w-md  px-4 bg-white dark:bg-neutral-900 text-gray-600 dark:text-gray-100">

      <header class="flex justify-center">
        <img src="{{ asset('assets/logo1.svg') }}" alt="Logo Doeit" class="w-24 h-24 object-contain">
      </header>

      <form action="{{ route('register') }}" class="space-y-3" method="POST">
        @csrf
        <div>
          <label class="font-medium text-gray-900 dark:text-gray-100">Nome</label>
          <input
            type="text"
            name="name"
            required
            class="w-full mt-1 px-3 py-2 text-gray-500 dark:text-gray-300 bg-transparent outline-none border border-gray-300 dark:border-neutral-600 focus:border-indigo-600 shadow-sm rounded-lg"
            placeholder="Insira seu nome"
            value="{{ old('name') }}"
          />
          @error('name')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
          @enderror
        </div>
        <div>
          <label class="font-medium text-gray-900 dark:text-gray-100">Email</label>
          <input
            type="email"
            name="email"
            required
            class="w-full mt-1 px-3 py-2 text-gray-500 dark:text-gray-300 bg-transparent outline-none border border-gray-300 dark:border-neutral-600 focus:border-indigo-600 shadow-sm rounded-lg"
            placeholder="Insira seu e-mail"
            value="{{ old('email') }}"
          />
          @error('email')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
          @enderror
        </div>
        <div class="relative">
          <label class="font-medium text-gray-900 dark:text-gray-100">Senha</label>
          <div class="flex flex-col w-full">
            <div class="flex flex-row w-full px-3 py-2 mt-2 text-gray-500 dark:text-gray-300  border border-gray-300 dark:border-neutral-600 focus:border-indigo-600 shadow-sm rounded-lg pr-5 items-center justify-between">
                <input
                placeholder="Insira sua senha"
                id="password"
                name="password"
                type="password"
                required
                class="bg-transparent outline-none border-none"
                />
                <img
                id="eyeIcon1"
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
            type="submit"
            class="w-2/5 mt-3 px-4 py-2 text-white font-bold bg-[#2AB036] hover:bg-green-600 active:bg-green-700 rounded-lg duration-150 text-sm"
          >
          Cadastrar-se
          </button>
        </div>

        <div class="flex justify-center mt-3">
          <a class="flex items-center justify-center p-2 border border-gray-300 dark:border-neutral-600 rounded-full hover:bg-gray-50 dark:hover:bg-neutral-700 duration-150 active:bg-gray-100 dark:active:bg-neutral-800" href="{{ url('/login/google') }}">
            <img
              src="{{asset('assets/google-logo.png')}}"
              alt="Google"
              class="w-6 h-6"
            />
          </a>
        </div>

        <div class="text-center mt-3">
          <a href="{{ route('login') }}" class="text-sm text-[#575761] dark:text-gray-400 hover:underline inline-block">
            Já possui uma conta?<span class="text-[#FF5800]"> Faça login</span>
          </a>
        </div>

      </form>
    </div>
  </section>
</main>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    function setupPasswordToggle(passwordFieldId, eyeIconId) {
      const passwordField = document.getElementById(passwordFieldId);
      const eyeIcon = document.getElementById(eyeIconId);

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
    }

    setupPasswordToggle('password', 'eyeIcon1');
    setupPasswordToggle('cpassword', 'eyeIcon2');
  });
</script>
</body>
</html>
