<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Não Encontrada</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-neutral-100 dark:bg-neutral-900 transition-colors duration-300">

    <main class="flex items-center justify-center w-screen h-screen px-4">
        <div class="flex flex-col items-center text-center space-y-6">

            <h1 class="text-9xl font-black text-[#FF5800] drop-shadow-sm">
                404
            </h1>

            <div class="space-y-2">
                <h2 class="text-4xl font-bold text-neutral-800 dark:text-white">
                    Oops! Canal errado.
                </h2>
                <p class="text-lg text-neutral-600 dark:text-neutral-400 max-w-md">
                    Parece que você se perdeu nos cabos. Não conseguimos encontrar a página que você está procurando.
                </p>
            </div>

            <a href="/"
               class="inline-block px-8 py-3 text-lg font-semibold text-white bg-[#5FCB69] rounded-lg shadow-lg transition-all duration-200 hover:scale-105 hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-[#5FCB69] focus:ring-opacity-50">
                Me leve de volta!
            </a>

        </div>
    </main>
    <script>
        window.addEventListener('DOMContentLoaded', function () {
            if (localStorage.getItem('theme') === 'dark')
            {
                document.documentElement.classList.add('dark');
            }
        })
    </script>
</body>
</html>
