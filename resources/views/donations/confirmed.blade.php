<!DOCTYPE html>
<html lang="pt-BR" class="transition-colors duration-500">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Agradecimento/sucesso</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <link rel="stylesheet" href="{{ asset('css/fonts.css') }}">
  <link rel="icon" href="{{ asset('assets/favicon.svg') }}" type="image/x-icon" />
</head>

<body class="bg-white dark:bg-[#1e1e21] font-[Poppins] text-gray-900 dark:text-gray-100 transition-colors duration-500">
  <section class="lg:grid lg:h-screen lg:place-content-center">
    <div class="mx-auto w-screen max-w-screen-xl px-4 py-16 sm:px-6 sm:py-24 lg:px-8 lg:py-32">
      <div class="mx-auto max-w-prose text-center opacity-0 translate-y-8 transition-all duration-700 delay-100 animate-fade-in">

        <div class="flex justify-center mb-6">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-[#2AB036] animate-pulse" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 
            5.42 4.42 3 7.5 3c1.74 0 3.41 0.81 4.5 
            2.09C13.09 3.81 14.76 3 16.5 
            3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 
            6.86-8.55 11.54L12 21.35z"/>
          </svg>
        </div>

        <h1 class="text-4xl font-bold sm:text-5xl">
          Obrigado por doar com a
          <strong class="text-[#2AB036]">DoeIt</strong>
          e fazer a diferença!
        </h1>

        <p class="mt-4 text-base sm:text-lg/relaxed text-gray-700 dark:text-gray-300">
          Sua doação já está fazendo a diferença na vida de alguém. Obrigado por acreditar e confiar na DoeIt.
        </p>

        <div class="mt-6 flex justify-center">
          <a
            href="/home"
            class="inline-block rounded-lg border border-green-600 bg-[#2AB036] px-6 py-3 text-white font-medium shadow-md transition-transform duration-300 hover:bg-[#5FCB69] hover:scale-105 hover:shadow-lg"
          >
            Voltar para o Início
          </a>
        </div>

      </div>
    </div>
  </section>

  <script>
    const root = document.documentElement;

    function setTheme(theme) {
      if (theme === 'dark') {
        root.classList.add('dark');
      } else {
        root.classList.remove('dark');
      }
      localStorage.setItem('theme', theme);
    }

    document.addEventListener("DOMContentLoaded", () => {
      const el = document.querySelector(".animate-fade-in");
      if (el) {
        el.classList.remove("opacity-0", "translate-y-8");
        el.classList.add("opacity-100", "translate-y-0");
      }

      const saved = localStorage.getItem('theme');
      if (saved === 'dark' || saved === 'light') {
        setTheme(saved);
      } else if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
        setTheme('dark');
      } else {
        setTheme('light');
      }
    });
  </script>
</body>
</html>
