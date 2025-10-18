<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <link rel="icon" href="{{ asset('assets/favicon.svg') }}" type="image/x-icon" />

  <title>{{$campaign->Title}}</title>
</head>

<body class="bg-gray-50 dark:bg-neutral-900 min-h-screen overflow-x-hidden">
  @include('layouts.secondary_navbar')

  <main class="max-w-7xl mx-auto px-4 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
      <div class="lg:col-span-2">
        <section class="bg-white dark:bg-neutral-800 rounded-lg shadow-sm overflow-hidden">
          <div class="relative w-full">
            <div class="aspect-video w-full overflow-hidden">
              <img src="{{asset('storage/' . $campaign->Image)}}"
                alt="Imagem de doação"
                class="w-full h-full object-cover">
            </div>
          </div>

          <div class="p-6">
            <div class="text-wrap break-words">
              <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">{{$campaign->Title}}</h1>
            </div>

            <div class="bg-gray-50 dark:bg-neutral-700 rounded-lg p-4 mb-6">
              <label for="share-input" class="block text-xl font-medium text-gray-700 dark:text-gray-300 mb-2">Compartilhe:</label>
              <div class="flex flex-wrap gap-2">
                <input id="share-input"
                  type="text"
                  value="{{request()->url()}}"
                  readonly
                  class="flex-1 min-w-[200px] px-3 py-2 border border-gray-300 dark:border-neutral-600 rounded-md text-sm bg-white dark:bg-neutral-800 text-gray-900 dark:text-white">
                <button class="copy-button shrink-0 px-4 py-2 bg-gray-600 dark:bg-gray-400 text-white rounded-md hover:bg-gray-700 dark:hover:bg-gray-500 text-sm transition-colors" id="copy">
                  Copiar
                </button>
              </div>
            </div>

            <div class="text-wrap break-words">
              <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Descrição</h2>
              <p class="text-gray-700 dark:text-gray-300 leading-relaxed">{{$campaign->Description}}</p>
            </div>
          </div>
        </section>
      </div>

      <div class="lg:col-span-1">
        <aside class="bg-white dark:bg-neutral-800 rounded-lg shadow-sm p-6 sticky top-8">
          <section class="text-center mb-6">
            <p class="text-lg text-gray-500 dark:text-gray-400 mb-1">Arrecadado</p>
            <div class="text-3xl font-bold text-green-500 dark:text-green-400 mb-4">{{$campaign->meta['current']}}
              @if($campaign->Type === "food")
              <span class="text-xl text-gray-600 dark:text-gray-300">Kg</span>
              @else
              <span class="text-xl text-gray-600 dark:text-gray-300">Unidades</span>
              @endif
            </div>

            <p class="text-lg text-gray-500 dark:text-gray-400 mb-1">Meta</p>
            <div class="text-3xl font-bold text-gray-700 dark:text-gray-300 mb-4">{{$campaign->meta['target']}}
              @if($campaign->Type === "food")
              <span class="text-xl text-gray-600 dark:text-gray-300">Kg</span>
              @else
              <span class="text-xl text-gray-600 dark:text-gray-300">Unidades</span>
              @endif
            </div>

            <div class="progress-bar">
              <div class="progress" style="width: {{ $progress }}%;"></div>
            </div>
          </section>

          @if ($donation)
          <div class="flex flex-col items-center mb-6 space-y-2">
            <p class="text-center text-base text-gray-600 dark:text-gray-400">
              Você possui uma doação que ainda não foi validada</p>
            <a href="/donation/{{$donation->id}}" class="text-white text-sm font-semibold bg-green-500 hover:bg-green-600 rounded-md py-2 px-4">Ver QR Code</a>
          </div>
          @elseif($campaign->user_id !== auth()->user()->id && $campaign->meta['current'] < $campaign->meta['target'])
            <div class="flex flex-col items-center mb-6 space-y-2">
              <a class="help-button w-full max-w-[250px] bg-green-500 hover:bg-green-600 text-white font-semibold py-4 px-6 rounded-lg text-lg mb-6 transition-colors block text-center"
                href="/donate/{{$campaign->id}}">
                Quero Ajudar
              </a>
            </div>
            @endif

            <section class="border-t pt-4 text-wrap break-words">
              <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Sobre a campanha</h2>
              <div class="space-y-4">
                <ul class="text-base text-gray-700 dark:text-gray-300 space-y-3">
                  @if ($validators->count())
                  <li>
                    <strong class="text-lg font-semibold text-gray-900 dark:text-white">Validadores:</strong>
                    <ul class="mt-2 pl-4 space-y-2">
                      @foreach ($validators as $validator)
                      <li class="flex items-center justify-between py-1 border-b border-gray-200 dark:border-gray-700">
                        <span class="text-sm font-medium text-gray-800 dark:text-gray-200">{{ $validator->name }}</span>

                        @if (auth()->id() === $campaign->user_id && $validator->id !== $campaign->user_id)
                        <form action="{{ route('campaigns.removeValidator', [$campaign->id, $validator->id]) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <button type="submit"
                            class="text-xs font-medium px-2 py-1 rounded-md border border-red-600 text-red-600 bg-red-100 hover:bg-red-200 transition">
                            Remover
                          </button>
                        </form>
                        @endif
                      </li>
                      @endforeach
                    </ul>
                  </li>
                  @endif

                  <li>
                    <strong class="text-base font-semibold text-gray-900 dark:text-white">Arrecadados:</strong>
                    <span class="ml-2">{{ $campaign->meta['current'] }}</span>
                  </li>
                  <li>
                    <strong class="text-base font-semibold text-gray-900 dark:text-white">Nossa meta:</strong>
                    <span class="ml-2">{{ $campaign->meta['target'] }}</span>
                  </li>
                </ul>

                <div>
                  <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Local da campanha</h2>
                  <ul class="text-base text-gray-700 dark:text-gray-300 space-y-2">
                    <li><strong class="font-semibold">Estado:</strong> {{$address->State}}</li>
                    <li><strong class="font-semibold">Rua:</strong> {{$address->Street}}</li>
                    <li><strong class="font-semibold">Cidade:</strong> {{$address->City}}</li>
                    <li><strong class="font-semibold">Número:</strong> {{$address->Number}}</li>
                    <li><strong class="font-semibold">Dia e hora da coleta:</strong> {{\Carbon\Carbon::parse($address->Collection_date)->format('d/m/Y \à\s H:i')}}</li>
                  </ul>
                </div>
              </div>

            </section>

            @if($campaign->user_id === auth()->user()->id)
            <div class="border-t pt-6 space-y-3 items-center mt-4">
              <form action="/campaign/{{$campaign->id}}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit"
                  class="delete_button w-full max-w-sm mx-auto bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-md text-sm font-medium transition-colors items-center justify-center block text-center">
                  Deletar Campanha
                </button>
              </form>

              <a href="/campaign/edit/{{$campaign->id}}"
                class="update_button w-full max-w-sm mx-auto bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md text-sm font-medium transition-colors block text-center">
                Editar campanha
              </a>

              <button class="validator_button w-full max-w-sm mx-auto bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-md text-sm font-medium transition-colors flex items-center justify-center"
                onclick="openInviteModal()">
                Convidar para campanha
                <svg class="w-4 h-4 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                  <path d="M22 13H20V7.23792L12.0718 14.338L4 7.21594V19H14V21H3C2.44772 21 2 20.5523 2 20V4C2 3.44772 2.44772 3 3 3H21C21.5523 3 22 3.44772 22 4V13ZM4.51146 5L12.0619 11.662L19.501 5H4.51146ZM21 18H24V20H21V23H19V20H16V18H19V15H21V18Z"></path>
                </svg>
              </button>
              {{-- Botão para abrir o scanner --}}
              <button
                id="openScannerBtn"
                class="w-full max-w-sm mx-auto text-white py-2 px-4 rounded-md text-sm font-medium transition-colors flex items-center justify-center"
                style="background-color: #FF5800;">
                Ler QR Code
              </button>
            </div>
            @endif
        </aside>
      </div>
    </div>

    <div id="invite_modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" style="display: none;">
      <div class="bg-white dark:bg-neutral-800 rounded-lg p-6 w-full max-w-md mx-4">
        <div class="flex justify-between items-center mb-4">
          <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Convidar para campanha</h3>
          <button onclick="closeModal()" class="close_modal text-gray-400 hover:text-gray-600 text-2xl font-bold">
            ×
          </button>
        </div>

        <form id="invite_form">
          @csrf
          <div class="mb-4">
            <label for="inviteEmail" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Digite o e-mail</label>
            <input id="inviteEmail"
              type="email"
              name="email"
              placeholder="exemplo@email.com"
              required
              class="w-full px-3 py-2 border border-gray-300 dark:border-neutral-600 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent bg-white dark:bg-neutral-800 text-gray-900 dark:text-white" />
          </div>

          <input type="hidden" name="campaign_id" value="{{ $campaign->id }}" />

          <p class="alert text-sm text-amber-600 bg-amber-50 dark:bg-amber-900 p-3 rounded-md mb-4">
            Só compartilhe sua campanha com pessoas de confiança
          </p>

          <button type="submit"
            class="validator_button w-full bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-md font-medium transition-colors">
            Enviar convite
          </button>
        </form>
      </div>
    </div>
    {{-- Modal do scanner --}}
    <div id="scannerModal" class="fixed inset-0 hidden z-50">
      <!-- Fundo escuro com blur -->
      <div class="absolute inset-0 bg-black bg-opacity-50 backdrop-blur-sm"></div>
      <!-- Conteúdo do modal: scanner e botão abrir link -->
      <div class="relative z-10 flex flex-col items-center justify-center min-h-screen">
        <div class="flex flex-col items-center space-y-4 bg-gray-100 dark:bg-neutral-800 border border-black rounded-lg p-4 md:p-6 shadow-lg">
          <!-- Container da linha do título e botão -->
          <div class="w-full flex justify-between items-center px-2 pt-2 pb-2">
            <!-- Título do scanner -->
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-0">Scanner QR Code</h3>

            <!-- Botão de fechar -->
            <button
              id="closeScannerBtnInside"
              class="w-8 h-8 flex items-center justify-center bg-white dark:bg-neutral-700 text-gray-700 dark:text-gray-300 rounded-full border border-gray-300 dark:border-gray-600 hover:bg-gray-200 dark:hover:bg-neutral-600 transition-colors z-10"
              aria-label="Fechar scanner">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
              </svg>
            </button>
          </div>

          <!-- Scanner quadrado com tamanho responsivo -->
          <div id="qr-reader" class="w-64 h-64 md:w-80 md:h-80 rounded-md overflow-hidden bg-white border border-black"></div>

          <!-- Instrução para o usuário -->
          <p id="scannerInstructions" class="text-sm text-gray-600 dark:text-gray-400 text-center mt-2">
            Posicione o QR Code no centro da câmera
          </p>

          <!-- Botão abrir link (dentro do container do scanner) -->
          <button
            id="openLinkBtn"
            class="px-6 py-2 bg-[#2AB036] dark:bg-[#2AB036] border border-black rounded-md text-black dark:text-white font-semibold shadow-md transition-colors mt-2"
            style="display: none;">
            Abrir Link
          </button>
          <!-- Parágrafo com o link -->
          <p id="linkPreview" class="text-sm text-gray-600 dark:text-gray-400 text-center mt-2 break-all" style="display: none;">
          </p>
        </div>
      </div>
    </div>
  </main>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      // --- Elementos do DOM ---
      const scannerModal = document.getElementById('scannerModal');
      const openScannerBtn = document.getElementById('openScannerBtn');
      const closeScannerBtnInside = document.getElementById('closeScannerBtnInside');
      const scannerInstructions = document.getElementById('scannerInstructions');
      const openLinkBtn = document.getElementById('openLinkBtn');
      const linkPreview = document.getElementById('linkPreview');

      // Instância do leitor de QR Code
      // O ID "qr-reader" é o ID da <div> que criamos no HTML
      const html5QrCode = new Html5Qrcode("qr-reader");

      // --- Funções de Controle do Modal e Câmera ---

      const disableScroll = () => document.body.style.overflow = 'hidden';
      const enableScroll = () => document.body.style.overflow = '';

      // Função para ABRIR o modal e INICIAR a câmera
      const showScanner = () => {
        disableScroll();
        scannerModal.classList.remove('hidden');
        startScanner();
      };

      // Função para FECHAR o modal e PARAR a câmera
      const hideScanner = () => {
        enableScroll();
        scannerModal.classList.add('hidden');
        stopScanner();
      };

      // --- Funções de Controle do Scanner ---

      const startScanner = () => {
        // Reseta a UI para o estado inicial
        scannerInstructions.style.display = 'block';
        linkPreview.style.display = 'none';
        openLinkBtn.style.display = 'none';

        const config = {
          fps: 10,
          qrbox: {
            width: 250,
            height: 250
          }
        };

        // Função de callback para quando um QR code for lido com sucesso
        const onScanSuccess = (decodedText, decodedResult) => {
          console.log(`QR Code lido: ${decodedText}`);

          // Atualiza a UI com o resultado
          scannerInstructions.style.display = 'none';
          linkPreview.textContent = decodedText;
          linkPreview.style.display = 'block';
          openLinkBtn.style.display = 'block';

          // Define a ação do botão para abrir o link
          openLinkBtn.onclick = () => {
            window.open(decodedText, '_blank');
          };

          // Para o scanner após uma leitura bem-sucedida para economizar recursos
          stopScanner();
        };

        // Inicia o scanner
        html5QrCode.start({
            facingMode: "environment"
          }, config, onScanSuccess)
          .catch(err => {
            console.error("Erro ao iniciar a câmera.", err);
            alert("Não foi possível acessar a câmera. Verifique as permissões.");
            hideScanner();
          });
      };

      const stopScanner = () => {
        // O `getState()` verifica se o scanner está rodando
        if (html5QrCode.getState() === 2) { // 2 = SCANNING
          html5QrCode.stop()
            .then(() => console.log("Scanner parado com sucesso."))
            .catch(err => console.error("Erro ao parar o scanner.", err));
        }
      };

      // --- Adiciona os Event Listeners ---

      if (openScannerBtn) {
        openScannerBtn.addEventListener('click', async () => {
          // Mostra um feedback visual de que algo está acontecendo (opcional, mas bom para UX)
          openScannerBtn.disabled = true;
          openScannerBtn.textContent = 'Aguardando permissão...';

          try {
            // 1. Pede a permissão para listar as câmeras.
            // Esta linha é o que aciona o prompt do navegador.
            const cameras = await Html5Qrcode.getCameras();

            // 2. Se o usuário permitir e houver câmeras, continue.
            if (cameras && cameras.length) {
              console.log("Permissão da câmera concedida.");
              // Agora que temos a permissão, chame a função para mostrar o modal e iniciar o scanner.
              showScanner();
            } else {
              // Caso raro onde a permissão é dada, mas nenhuma câmera é encontrada.
              alert("Nenhuma câmera foi encontrada neste dispositivo.");
            }

          } catch (error) {
            // 3. Se o usuário negar a permissão, o 'await' falha e o código entra no 'catch'.
            console.error("Erro ao obter permissão da câmera:", error);
            alert("Você precisa permitir o acesso à câmera para ler um QR Code.");

          } finally {
            // Restaura o estado do botão, seja com sucesso ou erro.
            openScannerBtn.disabled = false;
            openScannerBtn.textContent = 'Ler QR Code';
          }
        });
      }

      if (closeScannerBtnInside) {
        closeScannerBtnInside.addEventListener('click', hideScanner);
      }
    });
  </script>
</body>

</html>