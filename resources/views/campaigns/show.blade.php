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
                    <li><strong class="font-semibold">Número:</strong> @if ($address->Number == 0) S/N @else {{ $address->Number }} @endif</li>
                    <li><strong class="font-semibold">Dia e hora da coleta:</strong> {{\Carbon\Carbon::parse($address->Collection_date)->format('d/m/Y \à\s H:i')}}</li>
                  </ul>
                </div>
              </div>

            </section>

            <div class="border-t pt-6 space-y-3 items-center mt-4">
              @php
              $user = auth()->user();
              $isOwner = $campaign->user_id === $user->id;
              $isValidator = $validators->contains('id', $user->id);
              @endphp

              @if ($isOwner)
              <form action="/campaign/{{ $campaign->id }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit"
                  class="delete_button w-full max-w-sm mx-auto bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-md text-sm font-medium transition-colors items-center justify-center block text-center">
                  Deletar Campanha
                </button>
              </form>

              <a href="/campaign/edit/{{ $campaign->id }}"
                class="update_button w-full max-w-sm mx-auto bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md text-sm font-medium transition-colors block text-center">
                Editar Campanha
              </a>

              <button
                class="validator_button w-full max-w-sm mx-auto bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-md text-sm font-medium transition-colors flex items-center justify-center"
                onclick="openInviteModal()">
                Convidar para Campanha
                <svg class="w-4 h-4 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                  <path
                    d="M22 13H20V7.23792L12.0718 14.338L4 7.21594V19H14V21H3C2.44772 21 2 20.5523 2 20V4C2 3.44772 2.44772 3 3 3H21C21.5523 3 22 3.44772 22 4V13ZM4.51146 5L12.0619 11.662L19.501 5H4.51146ZM21 18H24V20H21V23H19V20H16V18H19V15H21V18Z">
                  </path>
                </svg>
              </button>
              @endif

              @if ($isOwner || $isValidator)
              <button
                id="openScannerBtn"
                class="w-full max-w-sm mx-auto text-white py-2 px-4 rounded-md text-sm font-medium transition-colors flex items-center justify-center"
                style="background-color: #FF5800;">
                Ler QR Code
              </button>
              @endif
            </div>

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
          <div id="qr-reader" class="w-64 h-64 md:w-80 md:h-80 rounded-md overflow-hidden border border-black 
                        bg-gray-200 dark:bg-neutral-700 
                        flex items-center justify-center">
            <svg class="w-24 h-24 text-gray-400 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 013.75 9.375v-4.5zM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 01-1.125-1.125v-4.5zM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0113.5 9.375v-4.5z" />
              <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 14.625a1.125 1.125 0 011.125-1.125h4.5a1.125 1.125 0 011.125 1.125v4.5a1.125 1.125 0 01-1.125 1.125h-4.5a1.125 1.125 0 01-1.125-1.125v-4.5z" />
            </svg>
          </div>

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
      const qrReaderContainer = document.getElementById('qr-reader');

      const html5QrCode = new Html5Qrcode("qr-reader");

      // --- Funções de Controle do Modal e Câmera ---
      const disableScroll = () => document.body.style.overflow = 'hidden';
      const enableScroll = () => document.body.style.overflow = '';

      const showScanner = () => {
        disableScroll();
        scannerModal.classList.remove('hidden');
        startScanner();
      };

      const hideScanner = () => {
        enableScroll();
        scannerModal.classList.add('hidden');
        stopScanner();
      };

      // --- Funções de Controle do Scanner ---
      const startScanner = () => {
        qrReaderContainer.style.display = 'flex';
        scannerInstructions.innerHTML = 'Posicione o QR Code no centro da câmera'; // Reseta o texto
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

        const onScanSuccess = (decodedText, decodedResult) => {
          const siteOrigin = window.location.origin;

          if (decodedText.startsWith(siteOrigin)) {
            scannerInstructions.style.display = 'none';
            linkPreview.textContent = decodedText;
            linkPreview.className = 'text-sm text-gray-600 dark:text-gray-400 text-center mt-2 break-all';
            linkPreview.style.display = 'block';
            openLinkBtn.style.display = 'block';
            openLinkBtn.onclick = () => window.open(decodedText, '_blank');
            stopScanner();
          } else {
            openLinkBtn.style.display = 'none';
            linkPreview.textContent = 'QR Code inválido ou não pertence a este site.';
            linkPreview.className = 'text-sm text-red-600 dark:text-red-500 font-semibold text-center mt-2 break-all';
            linkPreview.style.display = 'block';
          }
        };

        html5QrCode.start({
            facingMode: "environment"
          }, config, onScanSuccess)
          .catch(err => {
            console.error("Erro ao iniciar a câmera.", err);
            // Erro genérico caso o start() falhe por outros motivos
            handleScannerError("Não foi possível iniciar a câmera. Tente novamente.", 'generic');
          });
      };

      const stopScanner = () => {
        if (html5QrCode.getState() === 2) { // 2 = SCANNING
          html5QrCode.stop()
            .then(() => console.log("Scanner parado com sucesso."))
            .catch(err => console.error("Erro ao parar o scanner.", err));
        }
      };

      // ALTERADO: Função de erro mais inteligente com tipos
      const handleScannerError = (message, type = 'generic') => {
        disableScroll();
        scannerModal.classList.remove('hidden');
        qrReaderContainer.style.display = 'none';
        linkPreview.style.display = 'none';
        openLinkBtn.style.display = 'none';

        let errorTitle = 'Ocorreu um Erro';
        let errorInstructions = `<p class="mt-2">${message}</p>`;

        if (type === 'permission_denied') {
          errorTitle = 'Acesso à câmera bloqueado';
          errorInstructions = `
            <p class="mt-2">${message}</p>
            <p class="mt-1 text-xs">Você precisa permitir o acesso nas configurações do seu navegador para este site.</p>
          `;
        } else if (type === 'no_camera') {
          errorTitle = 'Nenhuma câmera detectada';
          errorInstructions = `<p class="mt-2">${message}</p>`;
        }

        scannerInstructions.innerHTML = `
          <strong class="text-red-600 dark:text-red-500">${errorTitle}</strong>
          ${errorInstructions}
        `;
        scannerInstructions.style.display = 'block';
      };

      // --- Adiciona os Event Listeners ---
      if (openScannerBtn) {
        openScannerBtn.addEventListener('click', async () => {
          openScannerBtn.disabled = true;
          openScannerBtn.textContent = 'Aguardando permissão...';

          try {
            const cameras = await Html5Qrcode.getCameras();
            if (cameras && cameras.length) {
              showScanner();
            } else {
              // ALTERADO: Chama o handler com o tipo correto
              handleScannerError("Nenhuma câmera foi encontrada neste dispositivo.", 'no_camera');
            }
          } catch (error) {
            console.error("Erro ao obter permissão da câmera:", error);
            // ALTERADO: Chama o handler com o tipo correto
            handleScannerError("Você negou a permissão de acesso à câmera.", 'permission_denied');
          } finally {
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