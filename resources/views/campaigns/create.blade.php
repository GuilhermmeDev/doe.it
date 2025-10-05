<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Doe.it - Criar Campanha</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <link rel="icon" href="{{asset('assets/logo1.svg')}}" type="image/x-icon"/>
  <link rel="stylesheet" href="{{ asset('css/fonts.css') }}">
  <style>
    .validation-error {
      color: red;
      background-color: #fee2e2;
      padding: 0.25rem 0.5rem;
      border-radius: 0.25rem;
      font-size: 0.75rem;
      margin-top: 0.25rem;
    }
    
    .div-wrapper-2 {
        width: 100%;
        border-radius: 0.375rem; /* rounded-md */
        border: 1px solid #D1D5DB; /* border-gray-300 */
        padding: 0.5rem; /* p-2 */
        font-size: 0.875rem; /* text-sm */
        background-color: white; /* Fundo branco para light mode */
    }
    .div-wrapper-2:focus {
        outline: 2px solid transparent;
        outline-offset: 2px;
        --tw-ring-offset-color: #fff;
        --tw-ring-color: #34D399; /* ring-green-500 */
        box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000);
        border-color: #34D399; /* border-green-500 */
    }
    .text-wrapper-4 { /* Para os labels dos novos selects */
        display: block;
        color: #4B5563; /* text-gray-600 */
        font-weight: 500; /* font-medium */
        margin-bottom: 0.25rem; /* mb-1 */
    }
  </style>
</head>
<body class="bg-white dark:bg-neutral-900 text-gray-800 dark:text-gray-100 overflow-x-hidden">

  @include('layouts.secondary_navbar')
  <main class="h-full flex flex-col lg:flex-row items-center justify-center gap-10 px-8 py-20 lg:py-8 max-w-7xl mx-auto">

    <div class="w-full lg:w-1/2 text-center lg:text-left">
      <h2 class="text-4xl lg:text-5xl font-bold leading-tight text-gray-800 dark:text-gray-100">
        Criando sua campanha no <span class="text-[#2ab036]">doeit</span>
      </h2>
      <p class="mt-6 text-gray-700 dark:text-gray-300 text-lg text-justify max-w-md mx-auto lg:mx-0">
        Com o <span class="text-[#2ab036] font-semibold">doeit</span>, você pode fazer a diferença! Crie campanhas solidárias de forma simples, gratuita e segura. Compartilhe sua causa e alcance pessoas em todo lugar.
      </p>
    </div>

    <div class="w-full lg:w-1/2 max-w-md bg-[#2ab036] rounded-xl p-6 shadow-xl border border-[#ff5800] border-opacity-40">
      <form id="multiStepForm" action="/campaign" method="POST" enctype="multipart/form-data" class="space-y-4 text-sm text-gray-700 dark:text-gray-300">
        @csrf
        <div id="step1" class="step flex flex-col gap-4">
          <div>
            <label for="Title" class="block text-gray-600 dark:text-gray-300 text-lg font-medium mb-1">Título:</label>
            <input type="text" name="Title" id="Title" value="{{ old('Title') }}" placeholder="Escreva o título da sua campanha" class="w-full rounded-md border border-gray-300 dark:border-neutral-600 p-2 text-sm focus:ring-green-500 focus:border-green-500 bg-white dark:bg-neutral-900 text-gray-800 dark:text-gray-100" required>
            @error("Title")
                <p class="validation-error">{{ $message }}</p>
            @enderror
          </div>
          <div>
            <label for="Description" class="block text-gray-600 dark:text-gray-300 text-lg font-medium mb-1">Descrição:</label>
            <textarea name="Description" id="Description" placeholder="Escreva a descrição detalhada da sua campanha" class="w-full rounded-md border border-gray-300 dark:border-neutral-600 p-2 text-sm focus:ring-green-500 focus:border-green-500 h-24 bg-white dark:bg-neutral-900 text-gray-800 dark:text-gray-100" required>{{ old('Description') }}</textarea>
            @error("Description")
                 <p class="validation-error">{{ $message }}</p>
            @enderror
          </div>
          <div>
            <label for="Image" class="block text-gray-600 dark:text-gray-300 text-lg font-medium mb-1">Imagem da Campanha:</label>
            <input type="file" name="Image" id="Image" accept=".jpeg,.png,.jpg,.svg" class="w-full text-sm text-gray-500 dark:text-gray-300 bg-white dark:bg-neutral-900 rounded-lg
              file:mr-4 file:py-2 file:px-4
              file:rounded-md file:border-0
              file:text-sm file:font-semibold
              file:bg-green-50 file:text-green-700
              hover:file:bg-green-100 cursor-pointer
            "
            value="{{ old('Image') }}"/>
            @error("Image")
                <p class="validation-error">{{ $message }}</p>
            @enderror
          </div>
        </div>

        <div id="step2" class="step hidden flex flex-col gap-4">
          {{-- CAMPOS DE ESTADO E CIDADE --}}
          <div class="frame-wrapper-2">
            <div class="div-6">
                {{-- Ajuste aqui: Remova a classe text-wrapper-4 e adicione as classes Tailwind diretamente --}}
                <label for="State" class="block font-medium text-lg mb-1 text-gray-600 dark:text-gray-300">Estado:</label>
                {{-- Ajuste aqui: Remova a classe div-wrapper-2 e adicione as classes Tailwind diretamente --}}
                <select id="State" name="State" required
                        class="w-full rounded-md border border-gray-300 p-2 text-sm focus:ring-green-500 focus:border-green-500
                               bg-white text-gray-800
                               dark:bg-neutral-900 dark:border-neutral-600 dark:text-gray-100">
                    <option value="">Selecione o Estado</option>
                    <option value="Ceará" {{ old('State') == 'Ceará' ? 'selected' : '' }}>Ceará</option>
                    <option value="Rio Grande do Norte" {{ old('State') == 'Rio Grande do Norte' ? 'selected' : '' }}>Rio Grande do Norte</option>
                </select>
                @error('State')
                    <p class="validation-error">{{ $message }}</p>
                @enderror
            </div>
          </div>
          <div class="frame-wrapper-3">
            <div class="div-6">
                {{-- Ajuste aqui: Remova a classe text-wrapper-4 e adicione as classes Tailwind diretamente --}}
                <label for="City" class="block font-medium mb-1 text-lg text-gray-600 dark:text-gray-300">Cidade:</label>
                {{-- Ajuste aqui: Remova a classe div-wrapper-2 e adicione as classes Tailwind diretamente --}}
                <select name="City" id="City" required
                        class="w-full rounded-md border border-gray-300 p-2 text-sm focus:ring-green-500 focus:border-green-500
                               bg-white text-gray-800
                               dark:bg-neutral-900 dark:border-neutral-600 dark:text-gray-100">
                    <option value="">Selecione a Cidade</option>
                    <option value="Pereiro" {{ old('City') == 'Pereiro' ? 'selected' : '' }}>Pereiro</option>
                    <option value="São Miguel" {{ old('City') == 'São Miguel' ? 'selected' : '' }}>São Miguel</option>
                </select>
                @error('City')
                    <p class="validation-error">{{ $message }}</p>
                @enderror
            </div>
          </div>

          <div>
            <label for="Street" class="block font-medium mb-1 text-lg text-gray-600 dark:text-gray-300">Rua/Avenida:</label>
            <input type="text" name="Street" id="Street" value="{{ old('Street') }}" placeholder="Ex: Av. Brasil" class="w-full rounded-md border border-gray-300 dark:border-neutral-600 p-2 text-sm focus:ring-green-500 focus:border-green-500 bg-white dark:bg-neutral-900 text-gray-800 dark:text-gray-100" required>
            @error("Street")
                 <p class="validation-error">{{ $message }}</p>
            @enderror
          </div>
          <div>
            <label for="Number" class="block font-medium mb-1 text-lg text-gray-600 dark:text-gray-300">Número:</label>
            <input type="text" name="Number" id="Number" maxlength="12" value="{{ old('Number') }}" placeholder="Ex: 123 ou S/N" class="w-full rounded-md border border-gray-300 dark:border-neutral-600 p-2 text-sm focus:ring-green-500 focus:border-green-500 bg-white dark:bg-neutral-900 text-gray-800 dark:text-gray-100" required>
            @error("Number")
                <p class="validation-error">{{ $message }}</p>
            @enderror
          </div>
          <div>
            <label for="Data" class="block font-medium text-lg mb-1 text-gray-600 dark:text-gray-300">Data da Coleta:</label>
            <input type="date" name="Data" id="Data" value="{{ old('Data') }}" class="w-full rounded-md border border-gray-300 dark:border-neutral-600 p-2 text-sm focus:ring-green-500 focus:border-green-500 bg-white dark:bg-neutral-900 text-gray-800 dark:text-gray-100" required>
            @error("Data")
                <p class="validation-error">{{ $message }}</p>
            @enderror
          </div>
          <div>
            <label for="Hour" class="block font-medium mb-1 text-lg text-gray-600 dark:text-gray-300">Hora da Coleta:</label>
            <input type="time" name="Hour" id="Hour" value="{{ old('Hour') }}" class="w-full rounded-md border border-gray-300 dark:border-neutral-600 p-2 text-sm focus:ring-green-500 focus:border-green-500 bg-white dark:bg-neutral-900 text-gray-800 dark:text-gray-100" required>
            @error("Hour")
                <p class="validation-error">{{ $message }}</p>
            @enderror
          </div>
        </div>

        <div id="step3" class="step hidden flex flex-col gap-4">
          <div>
            <label for="Type" class="block font-medium mb-1 text-lg text-gray-600 dark:text-gray-300">Tipo da Arrecadação:</label>
            <select name="Type" id="tipo_arrecadacao"
                    class="w-full rounded-md border border-gray-300 p-2 text-sm focus:ring-green-500 focus:border-green-500
                           bg-white text-gray-800
                           dark:bg-neutral-900 dark:border-neutral-600 dark:text-gray-100">
                <option value="" {{ old('Type') == '' ? 'selected' : '' }} disabled>Selecione o tipo</option>
                <option value="food" {{ old('Type') == 'food' ? 'selected' : '' }}>Comida</option>
                <option value="clothes" {{ old('Type') == 'clothes' ? 'selected' : '' }}>Roupa</option>
            </select>
            @error("Type")
                 <p class="validation-error">{{ $message }}</p>
            @enderror
          </div>

          <div>
            <label for="meta" class="block font-medium mb-1 text-lg text-gray-600 dark:text-gray-300">Meta de Arrecadação (em kg ou unidades):</label>
            <input type="number" name="meta" id="meta" value="{{ old('meta') }}" placeholder="Ex: 100" class="w-full rounded-md border border-gray-300 dark:border-neutral-600 p-2 text-sm focus:ring-green-500 focus:border-green-500 bg-white dark:bg-neutral-900 text-gray-800 dark:text-gray-100" required min="1">
             @error("meta")
                 <p class="validation-error">{{ $message }}</p>
            @enderror
          </div>
        </div>

        <div class="pt-4 flex justify-between">
          <button type="button" id="prevBtn"
            class="bg-[#ff5800] text-white px-4 py-2 rounded-md font-medium hidden
                   hover:bg-[#d94c00] focus:outline-none focus:ring-2 focus:ring-[#ff5800] focus:ring-opacity-50">
            Voltar
          </button>
          <button type="button" id="nextBtn"
            class="bg-[#ff5800] text-white px-4 py-2 rounded-md font-medium
                   hover:bg-[#d94c00] focus:outline-none focus:ring-2 focus:ring-[#ff5800] focus:ring-opacity-50">
            Próximo
          </button>
          <button type="submit" id="submitBtn"
            class="bg-[#ff5800] text-white px-4 py-2 rounded-md font-medium hidden
                   hover:bg-[#d94c00] focus:outline-none focus:ring-2 focus:ring-[#ff5800] focus:ring-opacity-50">
            Criar Campanha
          </button>
        </div>
      </form>
    </div>
  </main>

  {{-- Script JavaScript para a lógica de múltiplos passos --}}
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const steps = document.querySelectorAll('.step');
      const nextBtn = document.getElementById('nextBtn');
      const prevBtn = document.getElementById('prevBtn');
      const submitBtn = document.getElementById('submitBtn');
      let currentStep = 0;

      function updateButtonVisibility() {
        steps.forEach((step, index) => {
          step.classList.toggle('hidden', index !== currentStep);
        });

        if (prevBtn) prevBtn.classList.toggle('hidden', currentStep === 0);
        if (nextBtn) nextBtn.classList.toggle('hidden', currentStep === steps.length - 1);
        if (submitBtn) submitBtn.classList.toggle('hidden', currentStep !== steps.length - 1);
      }

      if (nextBtn) {
        nextBtn.addEventListener('click', () => {
          console.log('Botão Próximo clicado! Etapa atual:', currentStep);
          // Adicione validação aqui se desejar que os campos sejam preenchidos antes de avançar
          // Exemplo simples de validação (pode ser expandido):
          let canAdvance = true;
          const currentStepFields = steps[currentStep].querySelectorAll('input[required], textarea[required], select[required]');
          currentStepFields.forEach(field => {
              if (!field.value.trim()) {
                  canAdvance = false;
                  field.reportValidity(); // Mostra a mensagem de erro do navegador para campos obrigatórios
              }
          });

          if (canAdvance && currentStep < steps.length - 1) {
            currentStep++;
            updateButtonVisibility();
          } else if (!canAdvance) {
              alert('Por favor, preencha todos os campos obrigatórios nesta etapa.'); // Mensagem de alerta mais amigável
          }
        });
      }

      if (prevBtn) {
        prevBtn.addEventListener('click', () => {
          console.log('Botão Voltar clicado! Etapa atual:', currentStep);
          if (currentStep > 0) {
            currentStep--;
            updateButtonVisibility();
          }
        });
      }

      // Inicializa a visibilidade dos botões e passos quando a página carrega
      updateButtonVisibility();

      // Lógica de interdependência Cidade/Estado com jQuery
      // Certifique-se de que os selects existem no HTML antes de tentar acessá-los.
      if (typeof $ !== 'undefined') { // Garante que jQuery está carregado
          $(document).ready(function() {
              $('#City').change(function() {
                  if ($(this).val() == "São Miguel") {
                      $('#State').val('Rio Grande do Norte');
                  } else if ($(this).val() == "Pereiro") {
                      $('#State').val('Ceará');
                  }
              });

              $('#State').change(function() {
                  if ($(this).val() == "Rio Grande do Norte") {
                      $('#City').val('São Miguel');
                  } else if ($(this).val() == "Ceará") {
                      $('#City').val('Pereiro');
                  }
              });
          });
      } else {
          console.warn('jQuery não está carregado. A lógica de cidade/estado pode não funcionar.');
      }
    });
  </script>
</body>
</html>