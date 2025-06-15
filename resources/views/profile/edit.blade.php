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
        /* Ajusta a altura mínima da área de conteúdo para ocupar o espaço restante da tela */
        main.content-area {
            min-height: calc(100vh - 64px); /* 64px é a altura aproximada da navbar */
        }
        /* Estilo para a imagem decorativa em tema claro/escuro */
        .curve-image {
            filter: brightness(0); /* Preto no tema claro */
        }
        @media (prefers-color-scheme: dark) {
            .curve-image {
                filter: none; /* Cor original no tema escuro */
            }
        }
        /* Transição para o overlay do modal */
        .modal-overlay {
            transition: opacity 0.3s ease;
        }
    </style>
</head>
<body class="h-full bg-white dark:bg-neutral-900 text-gray-900 dark:text-gray-100 flex flex-col">

    @include('layouts.secondary_navbar', ['hideUserProfile' => true])

    <main class="w-full flex-grow flex flex-col justify-center items-center px-4 py-6 sm:px-6 md:px-8 content-area">
        <div class="max-w-5xl w-full grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="flex flex-col justify-center">
                <h1 class="text-3xl font-bold sm:text-4xl text-gray-900 dark:text-gray-100">Atualizar Perfil</h1>
                <p class="mt-3 text-base sm:text-md max-w-md text-gray-700 dark:text-gray-300">
                    Gerencie suas informações pessoais para manter seu perfil sempre atualizado.
                </p>
                <img class="mt-6 hidden md:block w-2/3 curve-image"
                     src="https://cdn.rareblocks.xyz/collection/celebration/images/contact/4/curve-line.svg"
                     alt="Decorative curve" />
            </div>

            <div class="bg-white dark:bg-neutral-800 p-6 sm:p-8 rounded-2xl shadow-xl w-full mb-20">
                @if (session('status'))
                    <div class="mb-4 p-4 rounded-md bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300">
                        {{ session('status') }}
                    </div>
                @endif

                <h2 class="text-xl font-semibold mb-4 text-gray-900 dark:text-gray-100">Editar Detalhes</h2>

                <form method="POST" action="{{ route('profile.update') }}" class="space-y-4">
                    @csrf
                    @method('PATCH')

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Nome Completo
                        </label>
                        <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}" required
                            class="w-full px-3 py-2 bg-white dark:bg-neutral-900 border border-gray-300 dark:border-neutral-600 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                        @error('name')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Email
                        </label>
                        <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}" required
                            class="w-full px-3 py-2 bg-white dark:bg-neutral-900 border border-gray-300 dark:border-neutral-600 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                        @error('email')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            CPF
                        </label>
                        <div class="w-full px-3 py-2 bg-gray-100 dark:bg-neutral-700 rounded-md border border-gray-300 dark:border-neutral-600">
                            {{ $user->CPF }}
                        </div>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                            O CPF não pode ser alterado após o cadastro.
                        </p>
                    </div>

                    <div class="pt-2">
                        <button type="submit"
                                class="w-full px-4 py-2 text-white font-medium rounded-md transition duration-150 bg-[#5FCB69] hover:bg-[#357E3C]">
                            Salvar Alterações
                        </button>
                    </div>
                </form>

                <div class="mt-8 pt-6 border-t border-gray-200 dark:border-neutral-700">
                    <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-gray-100">Alterar Senha</h3>
                    <form method="POST" action="{{ route('profile.password.send') }}">
                        @csrf
                        <button type="submit"
                                class="w-full px-4 py-2 font-medium rounded-md transition duration-150
                                    bg-black text-white hover:bg-gray-800
                                    dark:bg-white dark:text-black dark:hover:bg-gray-200">
                            Enviar Link de Redefinição
                        </button>
                    </form>
                    @if (session('reset_message'))
                        <div class="mt-4 text-sm {{ session('reset_status') ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                            {{ session('reset_message') }}
                        </div>
                    @endif
                </div>

                <div class="mt-8 pt-6 border-t border-gray-200 dark:border-neutral-700">
                    <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-gray-100">Ações da Conta</h3>
                    <button onclick="showModal('deleteAccountModal')"
                            class="w-full px-4 py-2 font-medium rounded-md transition duration-150
                                   bg-red-600 text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                        Excluir Conta
                    </button>
                </div>
            </div>
        </div>
    </main>

    {{-- A classe 'hidden' é mantida por padrão. As classes 'flex items-center justify-center'
         serão aplicadas ao remover 'hidden' via JavaScript para centralizar o modal. --}}
    <div id="deleteAccountModal" class="fixed inset-0 z-50 hidden p-4">
        <div class="modal-overlay absolute inset-0 bg-gray-500 dark:bg-gray-900 opacity-75"></div>
        <div class="relative bg-white dark:bg-neutral-800 rounded-lg shadow-xl max-w-lg w-full p-6">
            <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-4">Confirmar Exclusão</h3>
            <p class="text-gray-700 dark:text-gray-300 mb-6">
                Tem certeza que deseja excluir sua conta? Esta ação é irreversível.
            </p>

            <form method="POST" action="{{ route('profile.destroy') }}">
                @csrf
                @method('DELETE')

                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Digite sua senha para confirmar:
                    </label>
                    <input id="password" name="password" type="password" required
                        class="w-full px-3 py-2 bg-white dark:bg-neutral-900 border border-gray-300 dark:border-neutral-600 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                    @error('password', 'userDeletion')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="hideModal('deleteAccountModal')"
                            class="px-4 py-2 font-medium rounded-md transition duration-150
                                   bg-gray-200 text-gray-800 hover:bg-gray-300 dark:bg-neutral-700 dark:text-gray-100 dark:hover:bg-neutral-600">
                        Cancelar
                    </button>
                    <button type="submit"
                            class="px-4 py-2 font-medium rounded-md transition duration-150
                                   bg-red-600 text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                        Confirmar Exclusão
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- A classe 'hidden' é mantida por padrão. As classes 'flex items-center justify-center'
         serão aplicadas ao remover 'hidden' via JavaScript para centralizar o modal. --}}
    <div id="resetConfirmModal" class="fixed inset-0 z-50 hidden p-4">
        <div class="modal-overlay absolute inset-0 bg-gray-500 dark:bg-gray-900 opacity-75"></div>
        <div class="relative bg-white dark:bg-neutral-800 rounded-lg shadow-xl max-w-lg w-full p-6">
            <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-4">
                @if(session('reset_status'))
                    Link Enviado!
                @else
                    Ocorreu um Erro
                @endif
            </h3>
            <p class="text-gray-700 dark:text-gray-300 mb-6">
                {{ session('reset_message') }}
            </p>

            <div class="flex justify-end">
                <button type="button" onclick="hideModal('resetConfirmModal')"
                        class="px-4 py-2 text-white font-medium rounded-md transition duration-150 bg-[#5FCB69] hover:bg-[#357E3C]">
                    OK
                </button>
            </div>
        </div>
    </div>

    <script>
        // Funções para manipulação de modais
        function showModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.classList.remove('hidden');
            // Adiciona as classes de flexbox para centralizar após remover 'hidden'
            modal.classList.add('flex', 'items-center', 'justify-center');
            document.body.classList.add('overflow-hidden');
        }

        function hideModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.classList.add('hidden');
            // Remove as classes de flexbox ao ocultar o modal para evitar interferências
            modal.classList.remove('flex', 'items-center', 'justify-center');
            document.body.classList.remove('overflow-hidden');
        }

        // Mostrar modais se houver mensagens de sessão
        @if(session('reset_message'))
            showModal('resetConfirmModal');
        @endif

        @if($errors->userDeletion->any())
            showModal('deleteAccountModal');
        @endif
    </script>
</body>
</html>