<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="{{ asset('assets/favicon.svg') }}" type="image/x-icon"/>
  <link rel="stylesheet" href="{{ asset('css/fonts.css') }}">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <script defer src="js/cdn.min.js"></script>
  <title>DoeIt - Verificação de E-mail</title>
</head>
<body class="bg-[#E0E0E0] text-[#73737F] dark:bg-[#1E1E21] dark:text-[#FFFFFF]">
<main class="w-full flex">

  <div class="relative flex-[3] hidden items-center justify-center h-screen lg:flex bg-[#2AB036] dark:bg-[#2AB036]">
    <div class="relative w-full max-w-md flex flex-col items-center space-y-6">
      <img src="{{ asset('assets/shield.svg') }}" width="347" />
      <p class="text-white text-center px-10">
        <span class="text-[#FF5800]">Verifique seu e-mail:</span> Clique no link enviado para confirmar sua conta antes de continuar.
      </p>
    </div>
  </div>

  <div class="flex-[2] flex items-center justify-center h-screen">
    <div class="w-full max-w-md space-y-8 px-4 bg-[#E0E0E0] dark:bg-[#1E1E21] sm:px-0 rounded-xl">

      <div class="flex justify-center mb-6">
        <img src="{{ asset('assets/logo1.svg') }}" alt="DoeIt" class="w-24 h-24 object-contain">
      </div>

      <div class="space-y-6 text-center">
        <p class="text-sm text-[#73737F] dark:text-white">
          Obrigado por se registrar! Antes de começar, verifique seu e-mail clicando no link que enviamos.
          <br><br>
          Caso não tenha recebido, clique abaixo para reenviar o link.
        </p>

        @if (session('status') == 'verification-link-sent')
          <div class="p-3 rounded-md bg-[#2AB036]/20 dark:bg-[#2AB036]/30 text-[#2AB036] dark:text-[#FFFFFF] font-medium text-sm">
            Um novo link de verificação foi enviado para seu e-mail.
          </div>
        @endif

        <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
          <form method="POST" action="{{ route('verification.send') }}" class="w-full sm:w-auto">
            @csrf
            <button
              type="submit"
              class="w-full px-4 py-2 text-[#FFFFFF] font-medium bg-[#2AB036] hover:bg-[#28A231] active:bg-[#23972C] rounded-lg duration-150 text-sm"
            >
              Reenviar E-mail de Verificação
            </button>
          </form>

          <form method="POST" action="{{ route('logout') }}" class="w-full sm:w-auto">
            @csrf
            <button
              type="submit"
              class="w-full px-4 py-2 text-white font-medium bg-red-600 hover:bg-red-700 active:bg-red-800 rounded-lg duration-150 text-sm"
            >
              Sair
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</main>

<script>
  // Aplica tema salvo
  (function() {
    const theme = localStorage.getItem('theme');
    if (theme === 'dark') {
      document.documentElement.classList.add('dark');
    } else {
      document.documentElement.classList.remove('dark');
    }
  })();
</script>

</body>
</html>