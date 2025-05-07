<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="{{ asset('assets/logo1.svg') }}" type="image/x-icon"/>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
  <title>Login - Doeit</title>
</head>
<body>
<main class="w-full flex">


  <div class="relative flex-[3] hidden items-center justify-center h-screen lg:flex" style="background-color: #2AB036;">
    <div class="relative w-full max-w-md flex flex-col items-center space-y-6">
      <img src="assets/maodoação.svg" width="347" />
      <p class="text-gray-300 text-center px-10 font-bold">
        “No <span style="color: #FF5800;">Doeit</span>, cada doação é um ato de amor que pode transformar vidas.”
        Junte-se a nós e faça a diferença!
      </p>
    </div>
  </div>


  <div class="flex-[2] flex items-center justify-center h-screen">
    <div class="w-full max-w-md space-y-8 px-4 bg-white text-gray-600 sm:px-0">

      <!-- Espaço para imagem -->
      <div class="flex justify-center mb-6">
        <img src="assets/logo1.svg
        " alt="Sua imagem aqui" class="w-32 h-32 object-contain">
      </div>

      <form onSubmit="/login" class="space-y-5" method="POST">
        @csrf
        <div>
          <label class="font-medium">Email</label>
          <input
            type="email"
            name="email"
            required
            class="w-full mt-2 px-3 py-2 text-gray-500 bg-transparent outline-none border focus:border-indigo-600 shadow-sm rounded-lg"
            placeholder="Insira seu e-mail"
          />
          @error('email')
              @include('layouts.error_popup')
          @enderror

        </div>
        <div class="relative">
          <label class="font-medium">Senha</label>
          <input
            id="password"
            type="password"
            name="password"
            required
            class="w-full mt-2 px-3 py-2 text-gray-500 bg-transparent outline-none border focus:border-indigo-600 shadow-sm rounded-lg pr-10"
            placeholder="Insira sua senha"
          />
          @error('password')
              @include('layouts.error_popup')
          @enderror
          <!-- Ícone do olho -->
          <img
            id="eyeIcon"
            src="assets/oculto.svg"
            alt="Mostrar senha"
            class="w-5 h-5 absolute top-11 right-2 cursor-pointer"
          />

          <a href="/forgot-password" class="text-gray-500 text-sm mt-2 block text-right">Esqueceu sua senha?</a>
        </div>

        <div class="flex flex-col items-center">
          <button
            class="w-2/5 mt-3 px-4 py-2 text-white font-bold bg-[#2AB036] hover:bg-green-600 active:bg-green-700 rounded-lg duration-150 text-sm"
          >
            Entrar
          </button>

          <a href="/register" class="text-sm text-[#575761] hover:underline mt-4 text-center">
            Ainda não tem uma conta?<span class="text-[#FF5800]"> Cadastre-se</span>
          </a>
        </div>



        <!-- Ícone do Google abaixo do botão -->
        <div class="flex justify-center mt-4">
          <a class="flex items-center justify-center p-2 border rounded-full hover:bg-gray-50 duration-150 active:bg-gray-100" href="{{ url('/login/google') }}">
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
rf</main>
</body>
</html>

<script>
  const passwordField = document.getElementById('password');
  const eyeIcon = document.getElementById('eyeIcon');

  eyeIcon.addEventListener('click', function () {
    if (passwordField.type === 'password') {
      passwordField.type = 'text';
      eyeIcon.src = 'assets/visivel.svg'; // troca para ícone de senha visível
    } else {
      passwordField.type = 'password';
      eyeIcon.src = 'assets/oculto.svg'; // volta para ícone de senha oculta
    }
  });
</script>
