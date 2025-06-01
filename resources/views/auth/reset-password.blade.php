<!DOCTYPE html>
<html lang="en" x-data="{ showPassword: false, showConfirmPassword: false }">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="logo1.svg" type="image/x-icon"/>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet"/>
  <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
  <title>DoeIt</title>
</head>
<body>
<main class="w-full flex">

  <div class="relative flex-[3] hidden items-center justify-center h-screen lg:flex" style="background-color: #2AB036;">
    <div class="relative w-full max-w-md flex flex-col items-center space-y-6">
      <img src="{{asset('assets/shield.svg')}}" width="347" />
      <p class="text-gray-300 text-center px-10">
        <span style="color: #FF5800;">Use uma senha forte:</span> Combine letras maiúsculas, minúsculas, números e caracteres especiais.
      </p>
    </div>
  </div>

  <div class="flex-[2] flex items-center justify-center h-screen">
    <div class="w-full max-w-md space-y-8 px-4 bg-white text-gray-600 sm:px-0">

      <!-- Espaço para imagem -->
      <div class="flex justify-center mb-6">
        <img src="{{asset('assets/logo1.svg')}}" alt="Sua imagem aqui" class="w-32 h-32 object-contain">
      </div>

      <form action="{{route('password.store')}}" class="space-y-5" method="POST">
        <input type="hidden" name="token" value="{{ request()->route('token') }}">
        @csrf
        <div>
          <label class="font-medium">Email</label>
          <input
            type="email"
            name="email"
            required
            placeholder="Insira seu email"
            class="w-full mt-2 px-3 py-2 text-gray-500 bg-transparent outline-none border focus:border-indigo-600 shadow-sm rounded-lg"
          />
          @error("email")
            @include("layouts.error_popup")
          @enderror
        </div>

        <div class="relative">
          <label class="font-medium">Senha</label>
          <input
            :type="showPassword ? 'text' : 'password'"
            name="password"
            required
            placeholder="Digite sua senha"
            class="w-full mt-2 px-3 py-2 pr-10 text-gray-500 bg-transparent outline-none border focus:border-indigo-600 shadow-sm rounded-lg"
          />
          <button type="button" @click="showPassword = !showPassword" class="absolute top-11 right-3 text-gray-400 hover:text-gray-600">
            <svg x-show="!showPassword" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>
            <svg x-show="showPassword" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.973 9.973 0 013.362-4.568m4.105-2.107A10.05 10.05 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.973 9.973 0 01-1.357 2.572M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18" />
            </svg>
          </button>
          @error("password")
            @include("layouts.error_popup")
          @enderror
        </div>

        <div class="relative">
          <label class="font-medium">Confirmar Senha</label>
          <input
            :type="showConfirmPassword ? 'text' : 'password'"
            name="password_confirmation"
            required
            placeholder="Confirme sua senha"
            class="w-full mt-2 px-3 py-2 pr-10 text-gray-500 bg-transparent outline-none border focus:border-indigo-600 shadow-sm rounded-lg"
          />
          <button type="button" @click="showConfirmPassword = !showConfirmPassword" class="absolute top-11 right-3 text-gray-400 hover:text-gray-600">
            <svg x-show="!showConfirmPassword" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>
            <svg x-show="showConfirmPassword" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.973 9.973 0 013.362-4.568m4.105-2.107A10.05 10.05 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.973 9.973 0 01-1.357 2.572M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18" />
            </svg>
          </button>

          @error("password_confirmation")
            @include("layouts.error_popup")
          @enderror
        </div>

        <div class="flex justify-center">
          <button
            class="w-2/5 mt-5 px-4 py-2 text-white font-medium bg-[#2AB036] hover:bg-green-600 active:bg-green-700 rounded-lg duration-150 text-sm"
            type="submit"
          >
            Redefinir Senha
          </button>
        </div>

      </form>
    </div>
  </div>
</main>
</body>
</html>
