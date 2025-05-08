<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campanha</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <style>
        body {
        transition: background-color 0.3s, color 0.3s; /* Animação suave ao trocar o tema */
        font-family: "Poppins", sans-serif; /* Fonte personalizada */
        font-weight: 500;
        font-style: normal;

        }
    
        /* Tema claro */
        .light-theme {
        background-color: #ffffff;
        color: #000000;
        }
    
        /* Tema escuro */
        .dark-theme {
        background-color: #1b1b1b;
        color: #ffffff;
        }
    
        /* Estilização do menu mobile flutuante */
        #mobile-menu {
        position: absolute;
        left: 50%; /* Centralizado horizontalmente */
        top: -10%; /* Inicia fora da tela (oculto) */
        padding: 20px 30px;
        border-radius: 12px;
        border: 1px solid #cfcfcf; /* Borda leve */
        background-color: #ffffff; /* Fundo branco padrão */
        color: #1b1b1b; /* Texto escuro */
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1); /* Sombra */
        max-width: 90%; /* Largura máxima */
        backdrop-filter: blur(10px); /* Efeito de vidro fosco */
        transition: all 0.3s ease-in-out; /* Suavidade na transição */
        }
    
        /* Garante que o botão do menu fique acima do restante */
        #menunav {
        position: relative;
        z-index: 5;
        }
    
        /* Botão de alternância de tema */
        #theme-toggle {
        all: unset; /* Remove todos os estilos padrões */
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        position: relative;
        left: -23.5%; /* Posição personalizada para alinhar com layout */
        }
    
        /* Ajusta a posição do botão em tablets */
        @media (min-width: 629px) and (max-width: 767px) {
        #theme-toggle {
            margin-left: 450px;
        }
        }
    
        /* Ajusta a posição do botão em celulares */
        @media (min-width: 0px) and (max-width: 629px) {
        #theme-toggle {
            left: 70%;
        }
        }
    
        /* Botão de menu hambúrguer em dispositivos móveis */
        #menu-toggle {
        position: relative;
        left: 85%;
        top: -47px; /* Sobe o botão para alinhar com cabeçalho */
        }
    
      </style>
</head>
<body class="light-theme duration-200">
    @include('layouts.secondary_navbar')
    

  <div class="">
    <div class="max-w-screen-xl mx-auto px-4  md:px-8">
      <div
        class="max-w-lg mx-auto gap-12 justify-between lg:flex lg:max-w-none"
      >
        <div class="max-w-lg space-y-3">
          <br><br>
          <p class="text-[#2AB036] text-3xl font-semibold sm:text-4xl">
            Doar para a campanha 
          </p>
          <p class=" font-semibold">
            Meta: {{$campaign->meta['target']}}
          </p>
          <p class=" font-semibold">
            Arrecadado: {{$campaign->meta['current']}}
          </p>
          <br>
          <img src="{{asset('assets/doodle_group.svg')}}" alt="">
          <div>
            <ul class="mt-6 flex flex-wrap gap-x-10 gap-y-6 items-center">
              <template
                x-for="(item, index) in contactMethods"
                :key="index"
              >
                <li class="flex items-center gap-x-3">
                  <div
                    class="flex-none text-gray-400"
                    x-html="item.icon"
                  ></div>
                  <p x-text="item.contact"></p>
                </li>
              </template>
            </ul>
          </div>
        </div>
        <div class="flex-1 mt-12 sm:max-w-lg lg:max-w-md">
            <form method="POST" action="/donation/{{$campaign->id}}" class="space-y-8">
            @csrf
            <div class="mb-10 mt-8">
              <label class="font-medium"> Quantos kg de comida você pretende doar? </label>
              <input
                type="number"
                required
                class="w-full mt-2 px-3 py-2 text-gray-500 bg-transparent outline-none border focus:border-indigo-600 shadow-sm rounded-lg"
                name="Quantity" id="Quantity" min="0" max="{{$campaign->meta['target'] - $campaign->meta['current']}}"
              />
            </div>
          
            <div>
              <label class="font-medium">Descrição</label>
              <textarea
                required
                name="Description"
                class="w-full mt-2 h-36 px-3 py-2 resize-none appearance-none bg-transparent outline-none border focus:border-indigo-600 shadow-sm rounded-lg"
              ></textarea>
            </div>
            <div class="text-sm text-center">
                <p>Antes de doar, entenda como funciona o nosso sistema clique <a href="/info" class="text-[#1511FE]">aqui</a></p>
            </div>
            <div class="pb-5">
            <button
            type="submit"
              class="w-full  px-4 py-2 text-white font-medium bg-[#5FCB69] hover:bg-[#357E3C]  active:bg-indigo-600 rounded-lg duration-150"
            >
              Fazer Doação
            </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  
     </body>
</html>
