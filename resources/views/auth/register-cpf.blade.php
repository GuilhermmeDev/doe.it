<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <link rel="icon" href="{{asset('assets/logo1.svg')}}" type="image/x-icon"/> {{-- Adicionado type --}}
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
  <title>DoeIt - Cadastro de CPF</title> {{-- Título ajustado --}}
  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }
  </style>
</head>
<body class="overflow-hidden bg-white dark:bg-neutral-900 text-gray-600 dark:text-gray-100">
    @include('layouts.secondary_navbar') {{-- Incluído navbar secundária --}}

<main class="w-full flex">

  <div class="flex-1 flex items-center justify-center h-screen"> 
    <div class="w-full max-w-md space-y-8 px-4 bg-white dark:bg-neutral-800 text-gray-600 dark:text-gray-100 sm:px-0">

        <div class="flex justify-center mb-2">
            <p class="text-[30px] text-center text-gray-900 dark:text-gray-100" style="font-family: 'Poppins', sans-serif;">CPF</p>
        </div>
        <div class="flex justify-center mb-6">
            <p class="text-[16px] text-center text-gray-700 dark:text-gray-300" style="font-family: 'Poppins', sans-serif;">Insira seu CPF para o cadastro</p>
        </div>

      <form action="/cpf" method="POST" class="space-y-5">
        @csrf
        @method('PATCH') {{-- Mantido PATCH conforme seu código original --}}
        <div>
            <label for="cpf" class="font-medium text-gray-900 dark:text-gray-100">CPF</label>
            <input
              type="text"
              required
              maxlength="14"
              id="cpf"
              name="cpf"
              value="{{ old('cpf') }}" {{-- Adicionado old() para repopular --}}
              class="w-full mt-2 px-3 py-2 text-gray-500 dark:text-gray-300 bg-transparent outline-none border border-gray-300 dark:border-neutral-600 focus:border-indigo-600 shadow-sm rounded-lg"
              placeholder="000.000.000-00" {{-- Placeholder ajustado para formato com máscara --}}
            />
            @error('cpf')
                {{-- Sugestão de exibição de erro direto --}}
                <p style="color: red; font-size: 0.8rem; margin-top: 0.2rem;">{{ $message }}</p>
                {{-- @include('layouts.error_popup') --}}
            @enderror
        </div> {{-- Fechamento do div do input CPF --}}

        <div class="flex flex-col items-center pt-2"> {{-- Adicionado pt-2 para espaçamento --}}
          <button
            type="submit"
            class="w-2/5 px-4 py-2 text-white font-medium bg-[#2AB036] hover:bg-green-700 active:bg-green-800 rounded-lg duration-150 text-sm"
          >
            Salvar CPF {{-- Texto do botão ajustado para clareza --}}
          </button>

          <p class="text-sm text-[#575761] dark:text-gray-400 mt-4 text-center">
            Para continuar é necessário seu CPF.
          </p>
        </div>
      </form>
    </div>
  </div>
</main>
</body>
</html>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const cpfInput = document.getElementById('cpf');

    if (cpfInput) {
        cpfInput.addEventListener('input', () => {
          let value = cpfInput.value.replace(/\D/g, ''); // remove tudo que não for dígito

          // Limita a 11 dígitos, mas permite que o usuário apague além disso se a máscara já estiver aplicada
          if (value.length > 11 && cpfInput.value.length <= 14) {
            // Não faz nada se o usuário está apagando e já tem a máscara
          } else if (value.length > 11) {
             value = value.slice(0, 11);
          }

          let maskedValue = '';
          if (value.length > 0) {
            maskedValue = value.substring(0,3);
          }
          if (value.length > 3) {
            maskedValue += '.' + value.substring(3,6);
          }
          if (value.length > 6) {
            maskedValue += '.' + value.substring(6,9);
          }
          if (value.length > 9) {
            maskedValue += '-' + value.substring(9,11);
          }
          cpfInput.value = maskedValue;
        });
    }
});
</script>