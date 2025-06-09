<!DOCTYPE html>
<html lang="pt-br" class="h-full overflow-hidden">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Atualizar Perfil</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/alpinejs" defer></script>
    <link rel="icon" href="{{ asset('assets/logo1.svg') }}" type="image/x-icon"/>
    <style>
        /* Define a altura da área de conteúdo principal, subtraindo a altura estimada do navbar */
        /* Ajuste '64px' se o seu secondary_navbar tiver uma altura diferente (ex: h-20 seria 80px) */
        main.content-area {
            min-height: calc(100vh - 64px);
        }
    </style>
</head>
<body class="h-full bg-white dark:bg-neutral-900 text-gray-900 dark:text-gray-100 flex flex-col">

    {{-- O header principal foi removido daqui --}}

    @include('layouts.secondary_navbar', ['hideUserProfile' => true])

    <main class="w-full flex-grow flex flex-col justify-center items-center px-4 py-6 sm:px-6 md:px-8 content-area">
      <div class="max-w-5xl w-full grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="flex flex-col justify-center">
          <h2 class="text-3xl font-bold sm:text-4xl text-gray-900 dark:text-gray-100">Atualizar Perfil</h2>
          <p class="mt-3 text-base sm:text-md max-w-md text-gray-700 dark:text-gray-300">
            Gerencie suas informações pessoais para manter seu perfil sempre atualizado.
          </p>
          <img
            class="mt-6 hidden md:block w-2/3"
            src="https://cdn.rareblocks.xyz/collection/celebration/images/contact/4/curve-line.svg"
            alt="Curva decorativa"
          />
        </div>

        <div class="bg-white dark:bg-neutral-800 text-black dark:text-gray-100 p-6 sm:p-8 rounded-2xl shadow-xl w-full mb-20">
            <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-gray-100">Editar Detalhes do Usuário</h3>
              <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PATCH') {{-- Alterado para PATCH para corresponder à sua rota --}}

                {{-- Nome do Usuário --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nome Completo</label>
                    <input
                      id="name"
                      type="text"
                      name="name"
                      value="{{ old('name', $user->name) }}"
                      required
                      class="w-full mt-2 px-3 py-2 resize-none appearance-none bg-white dark:bg-neutral-900 border border-gray-400 dark:border-neutral-600 focus:border-indigo-600 shadow-sm rounded-md text-gray-900 dark:text-gray-100"
                    />
                    @error('name')
                        <p style="color: red; font-size: 0.8rem; margin-top: 0.2rem;">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email do Usuário --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email', $user->email) }}"
                        required
                        class="w-full mt-2 px-3 py-2 resize-none appearance-none bg-white dark:bg-neutral-900 border border-gray-400 dark:border-neutral-600 focus:border-indigo-600 shadow-sm rounded-md text-gray-900 dark:text-gray-100"
                    />
                    @error('email')
                        <p style="color: red; font-size: 0.8rem; margin-top: 0.2rem;">{{ $message }}</p>
                    @enderror
                </div>

                {{-- CPF do Usuário --}}
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">CPF</label>
                    <p class="w-full mt-2 px-3 py-2 text-gray-900 dark:text-gray-100 bg-gray-100 dark:bg-neutral-700 rounded-md border border-gray-400 dark:border-neutral-600 select-all">
                        {{ $user->CPF }}
                    </p>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">O CPF não pode ser alterado após o cadastro.</p>
                </div>
              
                {{-- Senha Atual (Opcional, para confirmação ou reautenticação) --}}
                <div>
                    <label for="current_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Senha Atual <span class="text-xs text-gray-500 dark:text-gray-400">(Necessário para alterar o email ou senha)</span></label>
                    <input
                        id="current_password"
                        type="password"
                        name="current_password"
                        class="w-full mt-2 px-3 py-2 resize-none appearance-none bg-white dark:bg-neutral-900 border border-gray-400 dark:border-neutral-600 focus:border-indigo-600 shadow-sm rounded-md text-gray-900 dark:text-gray-100"
                    />
                    @error('current_password')
                        <p style="color: red; font-size: 0.8rem; margin-top: 0.2rem;">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Nova Senha (Opcional) --}}
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nova Senha <span class="text-xs text-gray-500 dark:text-gray-400">(Opcional: deixe em branco para manter a atual)</span></label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        class="w-full mt-2 px-3 py-2 resize-none appearance-none bg-white dark:bg-neutral-900 border border-gray-400 dark:border-neutral-600 focus:border-indigo-600 shadow-sm rounded-md text-gray-900 dark:text-gray-100"
                    />
                    @error('password')
                        <p style="color: red; font-size: 0.8rem; margin-top: 0.2rem;">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Confirmar Nova Senha (Opcional) --}}
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Confirmar Nova Senha</label>
                    <input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        class="w-full mt-2 px-3 py-2 resize-none appearance-none bg-white dark:bg-neutral-900 border border-gray-400 dark:border-neutral-600 focus:border-indigo-600 shadow-sm rounded-md text-gray-900 dark:text-gray-100"
                    />
                </div>
                
                <div>
                    <button
                    type="submit"
                      class="w-full px-4 py-2 text-white font-medium bg-[#5FCB69] hover:bg-[#357E3C] active:bg-indigo-600 rounded-md duration-150"
                    >
                      Salvar Alterações
                    </button>
                </div>
            </form>

            {{-- Nova Seção: Ações da Conta (AGORA APENAS O BOTÃO DE EXCLUIR) --}}
            <div class="mt-8 pt-6 border-t border-gray-200 dark:border-neutral-700">
                <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-gray-100">Ações da Conta</h3>
                
                {{-- Botão Excluir Conta --}}
                <button
                    type="button"
                    onclick="openDeleteAccountModal()"
                    class="w-full px-4 py-2 text-white font-medium bg-red-600 hover:bg-red-700 active:bg-red-800 rounded-md duration-150"
                >
                    Excluir Conta
                </button>
            </div>

        </div>
      </div>
    </section>

    {{-- Modal de Confirmação para Excluir Conta (Z-INDEX AUMENTADO) --}}
    <div id="deleteAccountModal" class="fixed inset-0 z-[9999] overflow-y-auto bg-black bg-opacity-50 hidden flex justify-center items-center p-4">
        <div class="bg-white dark:bg-neutral-800 rounded-lg shadow-xl p-6 w-full max-w-sm mx-auto">
            <h4 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-4">Confirmar Exclusão de Conta</h4>
            <p class="text-gray-700 dark:text-gray-300 mb-6">Tem certeza que deseja excluir sua conta? Esta ação é irreversível. Por favor, digite sua senha para confirmar.</p>
            
            {{-- O FORMULÁRIO COM O CAMPO DE SENHA DEVE ENGLOBAR TUDO NO MODAL QUE SERÁ ENVIADO --}}
            <form action="{{ route('profile.destroy') }}" method="POST" class="inline-block w-full">
                @csrf
                @method('DELETE')

                {{-- CAMPO DE SENHA A SER ADICIONADO --}}
                <div class="mb-4">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Sua Senha</label>
                    <input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation" {{-- Este é o nome do campo que o controlador espera --}}
                        required
                        class="w-full mt-1 px-3 py-2 resize-none appearance-none bg-white dark:bg-neutral-900 border border-gray-400 dark:border-neutral-600 focus:border-indigo-600 shadow-sm rounded-md text-gray-900 dark:text-gray-100"
                    />
                    {{-- Exibir erros de validação da senha se houver (importante usar a bag 'userDeletion') --}}
                    @error('password_confirmation', 'userDeletion')
                        <p style="color: red; font-size: 0.8rem; margin-top: 0.2rem;">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end space-x-3">
                    <button
                        type="button"
                        onclick="closeDeleteAccountModal()"
                        class="px-4 py-2 bg-gray-200 dark:bg-neutral-700 text-gray-800 dark:text-gray-200 rounded-md hover:bg-gray-300 dark:hover:bg-neutral-600 duration-150"
                    >
                        Cancelar
                    </button>
                    <button
                        type="submit"
                        class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 duration-150"
                    >
                        Sim, Excluir Conta
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
      // Funções para o Modal de Excluir Conta
      function openDeleteAccountModal() {
          document.getElementById('deleteAccountModal').classList.remove('hidden');
          document.getElementById('deleteAccountModal').classList.add('flex');
      }

      function closeDeleteAccountModal() {
          document.getElementById('deleteAccountModal').classList.add('hidden');
          document.getElementById('deleteAccountModal').classList.remove('flex');
      }
    </script>
  </body>
</html>