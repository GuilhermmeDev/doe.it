<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Doe.it - Criar Campanha</title>

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>

  <link rel="icon" href="{{asset('assets/logo1.svg')}}"

  <!-- Flowbite -->
  <script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.js"></script>

  <!-- Google Fonts - Poppins -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }
  </style>
</head>
<body class="bg-white text-gray-800 h-screen ">


  <!-- Cabeçalho -->
  <header class="absolute top-10 left-10">
    <a href="/home">
        <img src="{{asset('assets/logo1.svg')}}" alt="Logo" class="h-8 w-auto">
    </a>
  </header>
  <!-- Conteúdo principal -->
  <main class="h-full flex flex-col lg:flex-row items-center justify-center gap-10 px-8 py-8 max-w-7xl mx-auto">



    <!-- Texto Esquerdo -->
    <div class="w-full lg:w-1/2 text-center lg:text-left">
      <h2 class="text-4xl lg:text-5xl font-bold leading-tight text-gray-800">
        Criando sua campanha<br> no <span class="text-green-500">doeit</span>
      </h2>
      <p class="mt-6 text-gray-700 text-base max-w-md mx-auto lg:mx-0">
        Com o <span class="text-green-500 font-semibold">doeit</span>, você pode fazer a diferença! Crie campanhas solidárias de forma simples, gratuita e segura. Compartilhe sua causa e alcance pessoas em todo lugar.
      </p>
    </div>

    <!-- Formulário Direita -->
    <div class="w-full lg:w-1/2 max-w-md bg-green-400 rounded-xl p-6 shadow-md">
      <form id="multiStepForm" action="/campaign" method="POST" enctype="multipart/form-data" class="space-y-4 text-sm text-gray-700">
        @csrf
        <!-- Etapa 1 -->
        <div id="step1" class="step flex flex-col gap-4">
          <div>
            <label class="block text-gray-600 font-medium mb-1 ">Título:</label>
            <input type="text" name="Title" placeholder="Escreva o título da sua campanha:" class="w-full rounded-md border border-gray-300 p-2 text-sm" required>
            @error("Title")
                @include('layouts.error_popup')
            @enderror
          </div>
          <div>
            <label class="block text-gray-600 font-medium mb-1">Descrição:</label>
            <input type="text" name="Description" placeholder="Escreva a descrição da sua campanha:" class="w-full rounded-md border border-gray-300 p-2 text-sm" required>
            @error("Description")
                @include('layouts.error_popup')
            @enderror

          </div>
        </div>

        <!-- Etapa 2 -->
        <div id="step2" class="step hidden flex flex-col gap-4">
          <div>
            <label class="block text-gray-600 font-medium mb-1">Estado:</label>
            <input type="text" name="State" placeholder="Escolha o estado" class="w-full rounded-md border border-gray-300 p-2 text-sm" required>
            @error("State")
                @include('layouts.error_popup')
            @enderror
          </div>
          <div>
            <label class="block font-medium text-gray-600 mb-1">Cidade:</label>
            <input type="text" name="City" placeholder="Escolha a cidade" class="w-full rounded-md border border-gray-300 p-2 text-sm" required>
            @error("City")
                @include('layouts.error_popup')
            @enderror

          </div>
          <div>
            <label class="block font-medium mb-1 text-gray-600">Data:</label>
            <input type="date" name="Data" placeholder="dd/mm/yyyy" class="w-full rounded-md border border-gray-300 p-2 text-sm" required>
            @error("Data")
                @include('layouts.error_popup')
            @enderror

          </div>
          <div>
            <label class="block font-medium mb-1 text-gray-600">Hora da Coleta:</label>
            <input type="time" name="Hour" placeholder="Digite a rua:" class="w-full rounded-md border border-gray-300 p-2 text-sm" required>
            @error("Hour")
                @include('layouts.error_popup')
            @enderror

          </div>
          <div>
            <label class="block font-medium mb-1 text-gray-600">Rua:</label>
            <input type="text" name="Street" placeholder="Digite o cep:" class="w-full rounded-md border border-gray-300 p-2 text-sm" required>
            @error("Street")
                @include('layouts.error_popup')
            @enderror

          </div>
          <div>
            <label class="block font-medium mb-1 text-gray-600">Número:</label>
            <input type="text" name="Number" placeholder="Digite o numero:" class="w-full rounded-md border border-gray-300 p-2 text-sm" required>
            @error("Number")
                @include('layouts.error_popup')
            @enderror

          </div>
        </div>

        <!-- Etapa 3 -->
        <div id="step3" class="step hidden flex flex-col gap-4">
          <div>
            <label class="block font-medium mb-1 text-gray-600">Tipo da Arrecadação:</label>
            <select class="bg-white w-full rounded-md border border-gray-300 p-2 text-sm" >
                <option value="food">Comida</option>
                <option value="clothes">Roupa</option>
            </select>
          </div>

          <div>
            <label class="block font-medium mb-1 text-gray-600">Meta:</label>
            <input type="text" name="Meta" placeholder="Meta(kg)" class="w-full rounded-md border border-gray-300 p-2 text-sm" required>
            @error("Meta")
                @include('layouts.error_popup')
            @enderror

          </div>

        </div>

        <!-- Botões -->
        <div class="pt-4 flex justify-between">
          <button type="button" id="prevBtn" class="bg-gray-600 text-white px-4 py-2 rounded-md font-medium hidden hover:bg-gray-700">Voltar</button>
          <button type="button" id="nextBtn" class="bg-gray-800 text-white px-4 py-2 rounded-md font-medium hover:bg-gray-900">Próximo</button>
          <button type="submit" id="submitBtn" class="bg-gray-900 text-white px-4 py-2 rounded-md font-medium hidden hover:bg-gray-800">Criar Campanha</button>
        </div>
      </form>
    </div>
  </main>

  <!-- Script de Navegação -->
  <script>
    const steps = document.querySelectorAll('.step');
    const nextBtn = document.getElementById('nextBtn');
    const prevBtn = document.getElementById('prevBtn');
    const submitBtn = document.getElementById('submitBtn');
    let currentStep = 0;

    function updateSteps() {
      steps.forEach((step, index) => {
        step.classList.toggle('hidden', index !== currentStep);
      });

      prevBtn.classList.toggle('hidden', currentStep === 0);
      nextBtn.classList.toggle('hidden', currentStep === steps.length - 1);
      submitBtn.classList.toggle('hidden', currentStep !== steps.length - 1);
    }

    nextBtn.addEventListener('click', () => {
      if (currentStep < steps.length - 1) {
        currentStep++;
        updateSteps();
      }
    });

    prevBtn.addEventListener('click', () => {
      if (currentStep > 0) {
        currentStep--;
        updateSteps();
      }
    });

    updateSteps(); // Inicializa
  </script>
</body>
</html>
