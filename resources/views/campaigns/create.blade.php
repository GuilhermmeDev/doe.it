<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Doeit - Criar Campanha</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <link rel="icon" href="{{asset('assets/logo1.svg')}}" type="image/x-icon"/>
  <link rel="stylesheet" href="{{ asset('css/fonts.css') }}">
  <style>
    /* Estilos para erro de validação (para o Alpine.js) */
    .validation-error-alpine {
      color: #dc2626; /* text-red-500 */
      font-weight: 600;
      font-size: 0.875rem; /* text-sm */
      margin-top: 0.25rem; /* mt-1 */
    }
    /* Estilo para inputs inválidos */
    input.invalid, textarea.invalid, select.invalid {
      border-color: #ef4444; /* border-red-500 */
    }
    input.invalid:focus, textarea.invalid:focus, select.invalid:focus {
      --tw-ring-color: #ef4444; /* ring-red-500 */
      border-color: #ef4444; /* border-red-500 */
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
      
      <form
        id="multiStepForm"
        x-data="formHandler()"
        action="/campaign"
        method="POST"
        enctype="multipart/form-data"
        class="space-y-4 text-sm text-gray-700 dark:text-gray-300"
        @submit.prevent="submitForm"
      >
        @csrf

        <div x-show="currentStep === 1" class="step flex flex-col gap-4">
          <div>
            <label for="Title" class="block text-gray-600 dark:text-gray-300 text-lg font-medium mb-1">Título:</label>
            <input type="text" name="Title" id="Title"
                   x-model="formData.Title"
                   @blur="validateField('Title')"
                   :class="{ 'invalid': errors.Title }"
                   placeholder="Escreva o título da sua campanha" class="w-full rounded-md border border-gray-300 dark:border-neutral-600 p-2 text-sm focus:ring-green-500 focus:border-green-500 bg-white dark:bg-neutral-900 text-gray-800 dark:text-gray-100" required>
            <p x-show="errors.Title" x-text="errors.Title" class="validation-error-alpine"></p>
          </div>

          <div>
            <label for="Description" class="block text-gray-600 dark:text-gray-300 text-lg font-medium mb-1">Descrição:</label>
            <textarea name="Description" id="Description"
                      x-model="formData.Description"
                      @blur="validateField('Description')"
                      :class="{ 'invalid': errors.Description }"
                      placeholder="Escreva a descrição detalhada da sua campanha" class="w-full rounded-md border border-gray-300 dark:border-neutral-600 p-2 text-sm focus:ring-green-500 focus:border-green-500 h-24 bg-white dark:bg-neutral-900 text-gray-800 dark:text-gray-100" required></textarea>
            <p x-show="errors.Description" x-text="errors.Description" class="validation-error-alpine"></p>
          </div>

          <div class="flex flex-col space-y-2">
            <label for="Image" class="block text-gray-700 dark:text-gray-200 text-lg font-medium">Imagem da Campanha:</label>
            <label for="Image" class="flex items-center justify-between w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-neutral-700 bg-white dark:bg-neutral-900 text-gray-700 dark:text-gray-300 cursor-pointer hover:bg-green-50 dark:hover:bg-neutral-800 transition-all duration-150" :class="{ 'invalid': errors.Image }">
              <span x-text="fileName" class="truncate text-sm">Nenhum arquivo selecionado</span>
              <span class="hidden sm:inline-flex bg-green-600 text-white px-3 py-1 rounded-md text-sm font-semibold hover:bg-green-700">Escolher</span>
            </label>
            <input type="file" name="Image" id="Image" accept=".jpeg,.png,.jpg,.svg" class="hidden" @change="handleFileChange($event); validateField('Image')"/>
            <p x-show="errors.Image" x-text="errors.Image" class="validation-error-alpine"></p>
          </div>
        </div>

        <div x-show="currentStep === 2" class="step flex flex-col gap-4">
          <div>
            <label for="State" class="block font-medium text-lg mb-1 text-gray-600 dark:text-gray-300">Estado:</label>
            <select id="State" name="State" required x-model="formData.State" @change="validateField('State')" :class="{ 'invalid': errors.State }" class="w-full rounded-md border border-gray-300 p-2 text-sm focus:ring-green-500 focus:border-green-500 bg-white text-gray-800 dark:bg-neutral-900 dark:border-neutral-600 dark:text-gray-100">
              <option value="">Selecione o Estado</option>
              <option value="Ceará">Ceará</option>
              <option value="Rio Grande do Norte">Rio Grande do Norte</option>
            </select>
            <p x-show="errors.State" x-text="errors.State" class="validation-error-alpine"></p>
          </div>
          <div>
            <label for="City" class="block font-medium mb-1 text-lg text-gray-600 dark:text-gray-300">Cidade:</label>
            <select name="City" id="City" required x-model="formData.City" @change="validateField('City')" :class="{ 'invalid': errors.City }" class="w-full rounded-md border border-gray-300 p-2 text-sm focus:ring-green-500 focus:border-green-500 bg-white text-gray-800 dark:bg-neutral-900 dark:border-neutral-600 dark:text-gray-100">
              <option value="">Selecione a Cidade</option>
              <option value="Pereiro">Pereiro</option>
              <option value="São Miguel">São Miguel</option>
            </select>
            <p x-show="errors.City" x-text="errors.City" class="validation-error-alpine"></p>
          </div>
          <div>
            <label for="Street" class="block font-medium mb-1 text-lg text-gray-600 dark:text-gray-300">Rua/Avenida:</label>
            <input type="text" name="Street" id="Street" x-model="formData.Street" @blur="validateField('Street')" :class="{ 'invalid': errors.Street }" placeholder="Ex: Av. Brasil" class="w-full rounded-md border border-gray-300 dark:border-neutral-600 p-2 text-sm focus:ring-green-500 focus:border-green-500 bg-white dark:bg-neutral-900 text-gray-800 dark:text-gray-100" required>
            <p x-show="errors.Street" x-text="errors.Street" class="validation-error-alpine"></p>
          </div>
          <div>
            <label for="Number" class="block font-medium mb-1 text-lg text-gray-600 dark:text-gray-300">Número:</label>
            <input type="text" name="Number" id="Number" maxlength="12" x-model="formData.Number" @blur="validateField('Number')" :class="{ 'invalid': errors.Number }" placeholder="Ex: 123 ou S/N" class="w-full rounded-md border border-gray-300 dark:border-neutral-600 p-2 text-sm focus:ring-green-500 focus:border-green-500 bg-white dark:bg-neutral-900 text-gray-800 dark:text-gray-100" required>
            <p x-show="errors.Number" x-text="errors.Number" class="validation-error-alpine"></p>
          </div>
          <div>
            <label for="Data" class="block font-medium text-lg mb-1 text-gray-600 dark:text-gray-300">Data da Coleta:</label>
            <input type="date" name="Data" id="Data" x-model="formData.Data" @change="validateField('Data')" :class="{ 'invalid': errors.Data }" class="w-full rounded-md border border-gray-300 dark:border-neutral-600 p-2 text-sm focus:ring-green-500 focus:border-green-500 bg-white dark:bg-neutral-900 text-gray-800 dark:text-gray-100" required>
            <p x-show="errors.Data" x-text="errors.Data" class="validation-error-alpine"></p>
          </div>
          <div>
            <label for="Hour" class="block font-medium mb-1 text-lg text-gray-600 dark:text-gray-300">Hora da Coleta:</label>
            <input type="time" name="Hour" id="Hour" x-model="formData.Hour" @change="validateField('Hour')" :class="{ 'invalid': errors.Hour }" class="w-full rounded-md border border-gray-300 dark:border-neutral-600 p-2 text-sm focus:ring-green-500 focus:border-green-500 bg-white dark:bg-neutral-900 text-gray-800 dark:text-gray-100" required>
            <p x-show="errors.Hour" x-text="errors.Hour" class="validation-error-alpine"></p>
          </div>
        </div>

        <div x-show="currentStep === 3" class="step flex flex-col gap-4">
          <div>
            <label for="Type" class="block font-medium mb-1 text-lg text-gray-600 dark:text-gray-300">Tipo da Arrecadação:</label>
            <select name="Type" id="tipo_arrecadacao" x-model="formData.Type" @change="validateField('Type')" :class="{ 'invalid': errors.Type }" class="w-full rounded-md border border-gray-300 p-2 text-sm focus:ring-green-500 focus:border-green-500 bg-white text-gray-800 dark:bg-neutral-900 dark:border-neutral-600 dark:text-gray-100">
              <option value="" disabled>Selecione o tipo</option>
              <option value="food">Comida</option>
              <option value="clothes">Roupa</option>
            </select>
            <p x-show="errors.Type" x-text="errors.Type" class="validation-error-alpine"></p>
          </div>

          <div>
            <label for="meta" class="block font-medium mb-1 text-lg text-gray-600 dark:text-gray-300">Meta de Arrecadação (em kg ou unidades):</label>
            <input type="number" name="meta" id="meta" x-model="formData.meta" @blur="validateField('meta')" :class="{ 'invalid': errors.meta }" placeholder="Ex: 100" class="w-full rounded-md border border-gray-300 dark:border-neutral-600 p-2 text-sm focus:ring-green-500 focus:border-green-500 bg-white dark:bg-neutral-900 text-gray-800 dark:text-gray-100" required min="1">
            <p x-show="errors.meta" x-text="errors.meta" class="validation-error-alpine"></p>
          </div>
        </div>

        <div class="pt-4 flex justify-between">
          <button type="button" x-show="currentStep > 1" @click="prevStep"
            class="bg-[#ff5800] text-white px-4 py-2 rounded-md font-medium hover:bg-[#d94c00] focus:outline-none focus:ring-2 focus:ring-[#ff5800] focus:ring-opacity-50">
            Voltar
          </button>
          
          <button type="button" x-show="currentStep < 3" @click="nextStep" :disabled="!isStepValid()"
            class="bg-[#ff5800] text-white px-4 py-2 rounded-md font-medium hover:bg-[#d94c00] focus:outline-none focus:ring-2 focus:ring-[#ff5800] focus:ring-opacity-50 disabled:bg-gray-400 disabled:cursor-not-allowed ml-auto">
            Próximo
          </button>
          
          <button type="submit" x-show="currentStep === 3" :disabled="!isStepValid()"
            class="bg-[#ff5800] text-white px-4 py-2 rounded-md font-medium hover:bg-[#d94c00] focus:outline-none focus:ring-2 focus:ring-[#ff5800] focus:ring-opacity-50 disabled:bg-gray-400 disabled:cursor-not-allowed ml-auto">
            Criar Campanha
          </button>
        </div>
      </form>
    </div>
  </main>
  
  <script>
    function formHandler() {
      return {
        currentStep: 1,
        fileName: 'Nenhum arquivo selecionado',
        formData: {
          Title: '{{ old('Title', '') }}',
          Description: '{{ old('Description', '') }}',
          Image: null,
          State: '{{ old('State', '') }}',
          City: '{{ old('City', '') }}',
          Street: '{{ old('Street', '') }}',
          Number: '{{ old('Number', '') }}',
          Data: '{{ old('Data', '') }}',
          Hour: '{{ old('Hour', '') }}',
          Type: '{{ old('Type', '') }}',
          meta: '{{ old('meta', '') }}',
        },
        errors: {},

        // Lida com a mudança do arquivo de imagem
        handleFileChange(event) {
          if (event.target.files.length > 0) {
            this.formData.Image = event.target.files[0];
            this.fileName = this.formData.Image.name;
          } else {
            this.formData.Image = null;
            this.fileName = 'Nenhum arquivo selecionado';
          }
        },
        
        // Valida um campo específico
        validateField(field) {
          this.errors[field] = ''; // Limpa erro anterior
          const value = this.formData[field];

          // Replicando as regras do Laravel Request
          switch (field) {
            case 'Title':
              if (!value) this.errors[field] = 'O título é obrigatório.';
              else if (value.length > 50) this.errors[field] = 'O título não pode exceder 50 caracteres.';
              break;
            case 'Description':
              if (!value) this.errors[field] = 'A descrição é obrigatória.';
              else if (value.length > 1000) this.errors[field] = 'A descrição não pode exceder 1000 caracteres.';
              break;
            case 'Image':
              if (!value) {
                  this.errors[field] = 'A imagem é obrigatória.';
              } else {
                  const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/svg+xml'];
                  const maxSize = 15 * 1024 * 1024; // 15MB
                  if (!allowedTypes.includes(value.type)) this.errors[field] = 'A imagem deve ser jpeg, png, jpg ou svg.';
                  if (value.size > maxSize) this.errors[field] = 'A imagem não pode exceder 15MB.';
              }
              break;
            case 'State':
            case 'City':
            case 'Street':
            case 'Hour':
            case 'Type':
              if (!value) this.errors[field] = 'Este campo é obrigatório.';
              break;
            case 'Number':
              if (!value) this.errors[field] = 'O número é obrigatório.';
              // Verifica se não é um número inteiro positivo
              else if (!/^\d+$/.test(value) || parseInt(value) < 1) this.errors[field] = 'O número deve ser um inteiro positivo.';
              break;
            case 'Data':
              if (!value) {
                this.errors[field] = 'A data é obrigatória.';
              } else {
                const today = new Date();
                const selectedDate = new Date(value + 'T00:00:00'); // Adiciona tempo para evitar problemas de fuso horário
                today.setHours(0, 0, 0, 0); // Zera a hora do dia atual para comparar apenas a data
                if (selectedDate <= today) this.errors[field] = 'A data deve ser futura.';
              }
              break;
            case 'meta':
              if (!value) this.errors[field] = 'A meta é obrigatória.';
              else if (parseInt(value) < 1) this.errors[field] = 'A meta deve ser pelo menos 1.';
              else if (parseInt(value) > 500) this.errors[field] = 'A meta não pode exceder 500.';
              break;
          }
        },

        // Verifica se a etapa atual é válida
        isStepValid() {
          let fieldsToValidate = [];
          if (this.currentStep === 1) fieldsToValidate = ['Title', 'Description', 'Image'];
          if (this.currentStep === 2) fieldsToValidate = ['State', 'City', 'Street', 'Number', 'Data', 'Hour'];
          if (this.currentStep === 3) fieldsToValidate = ['Type', 'meta'];

          // Roda a validação para todos os campos da etapa
          fieldsToValidate.forEach(field => this.validateField(field));
          
          // Verifica se há algum erro nos campos da etapa
          return fieldsToValidate.every(field => !this.errors[field]);
        },

        // Navega para a próxima etapa
        nextStep() {
          if (this.isStepValid()) {
            this.currentStep++;
          }
        },

        // Volta para a etapa anterior
        prevStep() {
          this.currentStep--;
        },

        // Submete o formulário
        submitForm() {
            if (this.isStepValid()) {
                // Se tudo estiver válido, submete o formulário de verdade
                document.getElementById('multiStepForm').submit();
            }
        }
      }
    }
  </script>
</body>
</html>