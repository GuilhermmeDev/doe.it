<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Doeit - Sistema de Doação</title>
  <link rel="stylesheet" href="{{asset('css/landing_page.css')}}">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <link rel="icon" href="{{ asset('assets/logo1.svg') }}" type="image/x-icon"/>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Bona+Nova+SC:ital,wght@0,400;0,700;1,400&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Righteous&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');
  </style>
</head>
<body class="light-theme dark:bg-neutral-900 dark:text-white duration-200 overflow-x-hidden h-fit">

    @include('layouts.secondary_navbar')

    <div id="fullsecao" class="justify-items-center">
      <section class="2xl:py-24 2xl:mt-[-25px] xl:mt-[50px] lg:mt-[80px] md:mt-[80px] sm:mt-[80px] mt-[80px] px-4 sm:px-6 lg:px-8 lg:text-left text-center">
        <div id="secao" class="mx-auto overflow-hidden max-w-7xl sm:px-6 lg:px-8 rounded-[20px] flex flex-col">
          <div class="py-10 sm:py-16 items-center justify-center">
            <div class="grid items-center grid-cols-1 gap-y-12 lg:grid-cols-2 lg:gap-x-8 2xl:gap-x-20 w-full">
              <div class="flex flex-col lg:items-start lg:justify-start items-center justify-center">
                <h2 id="titulo" class="text-3xl font-bold leading-tight text-white sm:text-4xl lg:text-5xl lg:leading-tight">DoeIT - Conectando solidariedade e esperança!</h2>
                <p id="titulo" class="mt-4 text-base text-gray-50">Sabemos que pequenos gestos podem transformar vidas de maneira significativa. No DoeIT, conectamos pessoas dispostas a ajudar com aqueles que mais precisam, promovendo solidariedade, esperança e mudanças reais na vida de quem recebe o apoio.</p>

                <div class="flex flex-row items-center mt-8 lg:mt-12 w-fit">
                  <a id="vamos" href="/register" title="" class="flex w-40 h-10" role="button">
                    <button id="buttonvamos" class="flex items-center justify-center w-full text-center rounded-[40px]">Vamos</button>
                  </a>
                </div>
              </div>

              <div class="relative px-12">
                <svg class="absolute inset-x-0 bottom-0 left-1/2 -mb-48 lg:-mb-72 w-[460px] h-[460px] sm:w-[600px] sm:h-[600px]" viewBox="0 0 8 8">
                  <circle id="circle" cx="4" cy="4" r="3" fill="#FF5800" />
                </svg>
                <img class="relative w-full max-w-xs mx-auto -mb-60 lg:-mb-64" src="{{asset('assets/phone_doeit.png')}}" alt="" />
              </div>

            </div>
          </div>
        </div>
      </section id="secao2">


      <section id="modsecao2" class="pt-15 mt-[60px] overflow-hidden md:pt-40 sm:pt-16 2xl:pt-16">
        <div class="px-4 mx-auto sm:px-6 relative h-[600px] lg:px-8 max-w-7xl">
            <div class="grid items-center grid-cols-1 md:grid-cols-2 justify-items-center">
                <div>
                  <h2 class="text-3xl font-bold leading-none sm:text-4xl lg:text-[38px]">
                    <span class="border-b-4" style="border-color: #FF5800;">
                      Ajuda
                    </span> ao alcance
                  </h2>


                    <br>
                    <h3 class="text-2xl leading-tight sm:text-xl lg:text-2xl">Precisa de ajuda com alimentação?</h3>
                    <p id="textinfor" class="text-justify max-w-lg mt-3 text-xl leading-relaxed md:mt-8 dark:text-gray-400">No <span id="doeitext"> <b> DoeIT</b></span>,
                      conectamos você a quem pode oferecer o apoio que você precisa. Nossa missão é
                      garantir que ninguém fique sem o essencial. Seja para receber doações de alimentos
                      ou para contribuir com aqueles que precisam.
                      <br>
                      <br>
                      Estamos aqui para facilitar o processo e tornar
                       a solidariedade mais acessível. Com apenas alguns
                        cliques, você pode fazer a diferença na vida de quem mais precisa.</p>
                </div>

                <div class="relative w-2/3 translate-x-15 translate-y-5 xl:max-w-md xl:mx-auto 2xl:origin-bottom 2xl:scale-105">
                  <img
                    class="relative z-10"
                    src="{{ asset('assets/seclogo.svg') }}"
                    alt=""
                  />
                  <div class="absolute bottom-0 left-1/2 w-2/3 h-4 bg-black/20 rounded-full -translate-x-1/2 blur-md"></div>
                </div>
            </div>
        </div>
    </section>


    <section id="secao3" class="py-10 sm:py-16 lg:py-24">
      <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
          <div class="max-w-2xl mx-auto text-center">
              <h2 class="text-3xl font-bold leading-tight sm:text-4xl lg:text-5xl">Como funciona?</h2>
              <p class="max-w-lg mx-auto mt-4 text-base leading-relaxed text-gray-600 dark:text-gray-300">Conectar doadores e organizações nunca foi tão fácil. No doe.it, cada etapa garante segurança, transparência e simplicidade na doação.</p>
          </div>

          <div class="relative mt-12 lg:mt-20">
              <div class="absolute inset-x-0 hidden xl:px-44 top-2 md:block md:px-20 lg:px-28">
                  <img class="w-full" src="{{ asset('images/curved-dotted-line.svg') }}" alt="" />
              </div>

              <div class="relative grid grid-cols-1 text-center gap-y-12 md:grid-cols-3 gap-x-12">
                <div>
                  <div class="flex items-center justify-center w-16 h-16 mx-auto bg-[#FF5800] border-2 border-gray-200 rounded-full shadow">
                    <span class="text-xl font-semibold text-white">1</span>
                  </div>
                  <h3 class="mt-6 text-xl font-semibold leading-tight md:mt-10">Crie sua conta gratuita</h3>
                  <p class="mt-4 text-center text-gray-600 dark:text-gray-300">Cadastre-se rapidamente e personalize seu perfil. Escolha se deseja doar, criar campanhas ou receber doações. Nossa plataforma garante a segurança dos seus dados com tecnologia de ponta.</p>
                </div>

                <div>
                  <div class="flex items-center justify-center w-16 h-16 mx-auto bg-[#FF5800] border-2 border-gray-200 rounded-full shadow">
                    <span class="text-xl font-semibold text-white">2</span>
                  </div>
                  <h3 class="mt-6 text-xl font-semibold leading-tight md:mt-10">Crie campanhas ou doe diretamente</h3>
                  <p class="mt-4 text-center text-gray-600 dark:text-gray-300">Inicie uma campanha de arrecadação ou navegue pelas campanhas existentes. Cada transação gera um QR Code seguro, que valida a autenticidade da doação e conecta você diretamente à causa escolhida.</p>
                </div>

                <div>
                  <div class="flex items-center justify-center w-16 h-16 mx-auto bg-[#FF5800] border-2 border-gray-200 rounded-full shadow">
                    <span class="text-xl font-semibold text-white">3</span>
                  </div>
                  <h3 class="mt-6 text-xl font-semibold leading-tight md:mt-10">Acompanhe e compartilhe seu impacto</h3>
                  <p class="mt-4 text-center text-gray-600 dark:text-gray-300">Visualize seu histórico de doações e acompanhe como sua contribuição está fazendo a diferença. Receba relatórios de impacto e ajude a espalhar solidariedade de forma simples e confiável.</p>
                </div>
              </div>

          </div>
      </div>
  </section>



  <section id="secao4" class="text-gray-400 w-3/4 body-font relative min-h-screen flex items-center justify-center">
    <div class="container px-5 py-24 mx-auto flex flex-col items-center justify-center relative z-10">

      <div class="w-full bg-[#2AB036] shadow-lg rounded-xl flex flex-col md:flex-row overflow-hidden p-8">

        <div class="w-full md:w-1/2 p-4 flex flex-col">
          <h2 class="text-white text-2xl md:text-4xl font-bold mb-6">
            Como criar a sua<br class="hidden md:block"> campanha online no <br> DoeIT
          </h2>

          <div class="bg-white rounded-lg overflow-hidden h-96">
            <iframe
              title="map"
              width="100%"
              height="100%"
              frameborder="0"
              marginheight="0"
              marginwidth="0"
              scrolling="no"
              src="https://maps.google.com/maps?hl=en&q=Pereiro,+Ceará&ie=UTF8&t=&z=14&iwloc=B&output=embed"
              style="border:0; filter: grayscale(1) contrast(1.2) opacity(0.9);">
            </iframe>
          </div>
        </div>

        <div class="w-full md:w-1/2 p-4">
          <div class="bg-white rounded-lg p-8 h-auto flex flex-col justify-center gap-4">

            <div class="flex flex-col">
              <label for="titulo" class="text-gray-800 text-sm font-semibold mb-2">Título</label>
              <input id="inpudefeituoso" type="text" id="titulo" name="titulo" readonly
                class="w-full bg-gray-100 rounded border border-gray-300 focus:border-orange-500 focus:ring-2 focus:ring-orange-500 text-base outline-none text-gray-900 py-2 px-3 leading-8 transition-colors duration-200 ease-in-out" >
            </div>

            <div class="flex flex-col">
              <label for="estado" class="text-gray-800 text-sm font-semibold mb-2">Estado</label>
              <input type="text" id="estado" name="estado" readonly
                class="w-full bg-gray-100 rounded border border-gray-300 focus:border-orange-500 focus:ring-2 focus:ring-orange-500 text-base outline-none text-gray-900 py-2 px-3 leading-8 transition-colors duration-200 ease-in-out">
            </div>

            <div class="flex flex-col">
              <label for="data" class="text-gray-800 text-sm font-semibold mb-2">Data</label>
              <input type="date" id="data" name="data" readonly
                class="w-full bg-gray-100 rounded border border-gray-300 focus:border-orange-500 focus:ring-2 focus:ring-orange-500 text-base outline-Lnone text-gray-900 py-2 px-3 leading-8 transition-colors duration-200 ease-in-out">
            </div>

            <div class="flex flex-col">
              <label for="descricao" class="text-gray-800 text-sm font-semibold mb-2">Descrição</label>
              <textarea id="descricao" name="descricao" readonly
                class="w-full bg-gray-100 rounded border border-gray-300 focus:border-orange-500 focus:ring-2 focus:ring-orange-500 h-32 text-base outline-none text-gray-900 py-2 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>
            </div>

            <a href="/register" class="text-white flex items-center justify-center bg-orange-500 border-0 py-1 px-4 focus:outline-none hover:bg-orange-600 rounded text-sm h-10 w-32">
              Enviar
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="mt-10 w-3/4" x-data="footerComponent()">
    <footer class=" px-4 py-5 max-w-full mx-auto md:px-8">
      <div class="gap-6 justify-between md:flex">
        <div class="flex-1">
          <div class="w-xs">
            <img src="{{ asset('assets/logo1.svg') }}" class="w-20" />
          </div>
        </div>
        <div class="flex-1 mt-10 space-y-6 items-center justify-between sm:flex md:space-y-0 md:mt-0">
          <template x-for="(item, idx) in footerNavs" :key="idx">
            <ul class="space-y-4">
              <h4 class=" font-medium" x-text="item.label"></h4>
              <template x-for="(el, idx2) in item.items" :key="idx2">
                <li>
                  <a :href="el.href" class="hover:underline hover:text-indigo-600" x-text="el.name"></a>
                </li>
              </template>
            </ul>
          </template>
        </div>
      </div>
      <div class="mt-8 py-6 border-t items-center justify-between w-full sm:flex w-full">
        <div class="mt-6 sm:mt-0 w-full">
          </div>
      </div>
    </footer>
  </div>
</body>
</html>