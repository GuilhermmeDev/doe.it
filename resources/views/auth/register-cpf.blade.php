<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
<link rel="icon" href="{{asset('assets/logo1.svg')}}"
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
  <title>DoeIt</title>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }
  </style>

</head>
<body>
    <header class="absolute top-10 left-10">
        <img src="{{asset('assets/logo1.svg')}}" alt="Logo" class="h-8 w-auto">
      </header>

<main class="w-full flex">


  <div class="flex-[2] flex items-center justify-center h-screen">
    <div class="w-full max-w-md space-y-8 px-4 bg-white text-gray-600 sm:px-0">

        <div class="flex justify-center mb-2">
            <p class="text-[30px] text-center" style="font-family: 'Poppins', sans-serif;">CPF</p>
          </div>
          <div class="flex justify-center mb-6">
            <p class="text-[16px] text-center" style="font-family: 'Poppins', sans-serif;">Insira seu CPF para o cadastro</p>
          </div>


      <form action="/cpf" method="POST" class="space-y-5">
        @csrf
        @METHOD('PATCH')
        <div>
            <label class="font-medium">CPF</label>
            <input
              type="text"
              required
              maxlength="14"
              id="cpf"
                name="cpf"
              class="w-full mt-2 px-3 py-2 text-gray-500 bg-transparent outline-none border focus:border-indigo-600 shadow-sm rounded-lg"
              placeholder="Insira seu CPF"
            />



        <div class="flex flex-col items-center">
          <button
            type="submit"
            class="w-2/5 mt-3 px-4 py-2 text-white font-medium bg-[#2AB036] hover:bg-green-600 active:bg-green-700 rounded-lg duration-150 text-sm"
          >
            Entrar
          </button>

          <p class="text-sm text-[#575761] mt-4 text-center">
            Para continuar é necessario seu CPF
          </p>
        </div>

        </div>

      </form>
    </div>
  </div>
</main>
</body>
</html>

<script>
    const cpfInput = document.getElementById('cpf');

    cpfInput.addEventListener('input', () => {
      let value = cpfInput.value.replace(/\D/g, ''); // remove tudo que não for dígito

      if (value.length > 11) value = value.slice(0, 11); // limita a 11 dígitos

      value = value.replace(/(\d{3})(\d)/, '$1.$2');
      value = value.replace(/(\d{3})(\d)/, '$1.$2');
      value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');

      cpfInput.value = value;
    });
  </script>
