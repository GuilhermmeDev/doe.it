<!DOCTYPE html>
<html lang="pt-br" class="h-full overflow-hidden">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
 <link rel="icon" href="{{ asset('assets/favicon.svg') }}" type="image/x-icon" />  <script defer src="js/cdn.min.js"></script>
  <link rel="stylesheet" href="{{ asset('css/fonts.css') }}">
  <title>DoeIt - Cadastro de CPF</title>
  <style>
    /* Estilo para garantir que o conteúdo da main preencha o espaço abaixo do navbar */
    .content-area {
        height: calc(100vh - 64px); /* Supondo que seu navbar tenha 64px (h-16) de altura */
        /* Ajuste 64px se o seu secondary_navbar tiver uma altura diferente */
    }
  </style>
</head>
<body class="h-full bg-white dark:bg-neutral-900 text-gray-600 dark:text-gray-100 flex flex-col"> {{-- Adicionado flex flex-col aqui --}}
    @include('layouts.secondary_navbar')

{{-- Alterado main para ser um flex container que ocupa a altura restante --}}
<main class="w-full flex-grow flex flex-col items-center justify-center p-4 content-area"> {{-- Adicionado content-area --}}
  <div class="w-full max-w-md space-y-8 px-4 bg-white dark:bg-neutral-800 text-gray-600 dark:text-gray-100 sm:px-0 py-8 rounded-lg shadow-lg">

      <div class="flex justify-center mb-2">
          <p class="text-[30px] text-center text-gray-900 dark:text-gray-100" style="font-family: 'Poppins', sans-serif;">CPF</p>
      </div>
      <div class="flex justify-center mb-6">
          <p class="text-[16px] text-center text-gray-700 dark:text-gray-300" style="font-family: 'Poppins', sans-serif;">Insira seu CPF para o cadastro</p>
      </div>

    <form action="/cpf" method="POST" class="space-y-5" onsubmit="return validateForm()">
      @csrf
      @method('PATCH')
      <div class="px-4">
          <label for="cpf" class="font-medium text-gray-900 dark:text-gray-100">CPF</label>
          <input
            type="text"
            required
            maxlength="14"
            id="cpf"
            name="cpf"
            value="{{ old('cpf') }}"
            class="w-full mt-2 px-3 py-2 text-gray-500 dark:text-gray-300 bg-transparent outline-none border border-gray-300 dark:border-neutral-600 focus:border-indigo-600 shadow-sm rounded-lg"
            placeholder="000.000.000-00"
            onkeyup="formatarCPF(this)"
            onblur="validarCPFErro(this)"
          />
          <p id="cpf-error" style="color: red; font-size: 0.8rem; margin-top: 0.2rem; display: none;">CPF inválido.</p>
          @error('cpf')
              <p style="color: red; font-size: 0.8rem; margin-top: 0.2rem;">{{ $message }}</p>
          @enderror
      </div>

      <div class="flex flex-col items-center pt-2">
        <button
          type="submit"
          class="w-2/5 px-4 py-2 text-white font-medium bg-[#2AB036] hover:bg-green-700 active:bg-green-800 rounded-lg duration-150 text-sm"
        >
          Salvar CPF
        </button>

        <p class="text-sm text-[#575761] dark:text-gray-400 mt-4 text-center">
          Para continuar é necessário seu CPF.
        </p>
      </div>
    </form>
  </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const cpfInput = document.getElementById('cpf');

    if (cpfInput) {
        formatarCPF(cpfInput);
    }
});

function formatarCPF(input) {
  let value = input.value.replace(/\D/g, '');
  let formattedValue = '';

  if (value.length > 0) {
    formattedValue = value.substring(0, 3);
    if (value.length > 3) {
      formattedValue += '.' + value.substring(3, 6);
    }
    if (value.length > 6) {
      formattedValue += '.' + value.substring(6, 9);
    }
    if (value.length > 9) {
      formattedValue += '-' + value.substring(9, 11);
    }
  }
  input.value = formattedValue;
}

function validarCPF(cpf) {
  cpf = cpf.replace(/[^\d]+/g, '');

  if (cpf.length !== 11 || /^(\d)\1{10}$/.test(cpf)) {
    return false;
  }

  let sum = 0;
  let remainder;

  for (let i = 1; i <= 9; i++) {
    sum = sum + parseInt(cpf.substring(i - 1, i)) * (11 - i);
  }
  remainder = (sum * 10) % 11;
  if ((remainder === 10) || (remainder === 11)) {
    remainder = 0;
  }
  if (remainder !== parseInt(cpf.substring(9, 10))) {
    return false;
  }

  sum = 0;
  for (let i = 1; i <= 10; i++) {
    sum = sum + parseInt(cpf.substring(i - 1, i)) * (12 - i);
  }
  remainder = (sum * 10) % 11;
  if ((remainder === 10) || (remainder === 11)) {
    remainder = 0;
  }
  if (remainder !== parseInt(cpf.substring(10, 11))) {
    return false;
  }
  return true;
}

function validarCPFErro(input) {
  const cpfError = document.getElementById('cpf-error');
  if (!validarCPF(input.value)) {
    cpfError.style.display = 'block';
    input.classList.add('border-red-500');
    input.classList.remove('border-gray-300', 'dark:border-neutral-600', 'focus:border-indigo-600');
    return false;
  } else {
    cpfError.style.display = 'none';
    input.classList.remove('border-red-500');
    input.classList.add('border-gray-300', 'dark:border-neutral-600');
    return true;
  }
}

function validateForm() {
  const cpfInput = document.getElementById('cpf');
  return validarCPFErro(cpfInput);
}
</script>
</body>
</html>