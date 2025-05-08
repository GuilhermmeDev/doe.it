<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Atualizar Campanha</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>
    <body class="w-full overflow-x-hidden light-theme duration-200">
    @include('layouts.secondary_navbar')
    <section class="min-h-screen flex flex-col justify-center items-center px-4 py-6 sm:px-6 md:px-8">
      <div class="max-w-5xl w-full grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Área de Texto -->
        <div class="flex flex-col justify-center">
          <h2 class="text-3xl font-bold sm:text-4xl">Atualizar Campanha</h2>
          <p class="mt-3 text-base sm:text-md  max-w-md">
            Mantenha suas campanhas atualizadas e maximize o impacto de suas ações.
          </p>
          <img
            class="mt-6 hidden md:block w-2/3"
            src="https://cdn.rareblocks.xyz/collection/celebration/images/contact/4/curve-line.svg"
            alt="Curva decorativa"
          />
        </div>

  
        <div class="bg-white text-black p-6 sm:p-8 rounded-2xl shadow-xl w-full mb-20">
            <h3 class="text-xl font-semibold mb-4">Editar Detalhes da Campanha</h3>
              <!-- Nome da Campanha -->
              <form method="POST" action="/campaign/update/{{$campaign->id}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                    <label for="Title" class="block text-sm font-medium">Nome da Campanha</label>
                    <input
                      id="nomecampanha"
                      type="text"
                    name="Title"
                    value="{{$campaign->Title}}"
                      required
                      class="w-full mt-2 px-3 py-2 resize-none appearance-none bg-transparent border border-gray-400 focus:border-indigo-600 shadow-sm rounded-md"
                    @error('Title')
                     @include('layouts.error_popup')
                    @enderror
                    />

     <!-- Descrição -->
                  <div>
                    <label class="font-medium" for="Description">Descrição</label>
                    <textarea
                        name="Description"
                      required
                      class="w-full mt-2 h-36 px-3 py-2 resize-none appearance-none bg-transparent border border-gray-400 focus:border-indigo-600 shadow-sm rounded-md"
                    >{{$campaign->Description}}</textarea>
                    @error('Description')
                     @include('layouts.error_popup')
                    @enderror
                  </div>
              
                  <!-- Upload de Imagem -->
                  <div>
                    <label for="Image" class="block text-sm font-medium">Imagem da Campanha</label>
                    <div class="mt-1">
                      <input
                        id="imagem"
                        name="Image"
                        type="file"
                        accept=".jpeg, .jpg, .png"
                        class="block w-full px-3 py-2 text-sm text-gray-900 border border-gray-300 rounded-md bg-white file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:bg-[#5FCB69] file:text-white hover:file:bg-[#357E3C] focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                      />
                    @error('Image')
                     @include('layouts.error_popup')
                    @enderror
                    </div>


                  </div>

                    <img src="{{asset('img/campaigns/' . $campaign->Image)}}" class="my-8 w-full" alt="Imagem da campanha" style="height: 200px">
    <!-- Botão de Envio -->
                  <div class="pt-2">
                    <button
                    type="submit"
                      class="w-full px-4 py-2 text-white font-medium bg-[#5FCB69] hover:bg-[#357E3C] active:bg-indigo-600 rounded-md duration-150"
                    >
                      Atualizar
                    </button>

                  </div>
                  </div>
          
          

            </form>
          </div>
  

           
        </div>
      </div>
    </section>
         <!-- Scripts para interatividade -->
         <script>
            // Seletores dos elementos
            const themeToggleButton = document.getElementById('theme-toggle');
            const body = document.body;
            const sol = document.getElementById('sol'); // ícone do sol (modo escuro)
            const lua = document.getElementById('lua'); // ícone da lua (modo claro)
        
            // Define o tamanho dos ícones
            const imageSize = "25px";
            sol.style.width = imageSize;
            sol.style.height = imageSize;
            lua.style.width = imageSize;
            lua.style.height = imageSize;
        
            // Exibe o ícone da lua (modo claro) inicialmente
            sol.style.display = "none";
            lua.style.display = "inline-block";
        
            // Alterna entre temas claro e escuro ao clicar no botão
            themeToggleButton.addEventListener('click', () => {
            if (body.classList.contains('light-theme')) {
                // Ativa o tema escuro
                body.classList.remove('light-theme');
                body.classList.add('dark-theme');
        
                // Mostra o ícone do sol, esconde o da lua
                sol.style.display = "inline-block";
                lua.style.display = "none";
            } else {
                // Volta ao tema claro
                body.classList.remove('dark-theme');
                body.classList.add('light-theme');
        
                // Mostra o ícone da lua, esconde o do sol
                sol.style.display = "none";
                lua.style.display = "inline-block";
            }
            });
        
            // Lógica do botão hamburguer (abre/fecha o menu mobile)
            document.getElementById("menu-toggle").addEventListener("click", function(event) {
            var menu = document.getElementById("mobile-menu");
            menu.classList.toggle("hidden"); // Adiciona ou remove a classe 'hidden'
            event.stopPropagation(); // Evita que o clique feche o menu imediatamente
            });
        
            // Fecha o menu mobile ao clicar fora dele
            document.addEventListener("click", function(event) {
            var menu = document.getElementById("mobile-menu");
            var toggleButton = document.getElementById("menu-toggle");
        
            // Se o clique não foi dentro do menu nem no botão, esconde o menu
            if (!menu.contains(event.target) && !toggleButton.contains(event.target)) {
                menu.classList.add("hidden");
            }
            });
        
          </script>
  </body>
</html>

