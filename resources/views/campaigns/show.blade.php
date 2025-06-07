<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>{{$campaign->Title}}</title>
</head>

<body class="bg-gray-50 dark:bg-neutral-900 min-h-screen overflow-x-hidden">
  @include('layouts.secondary_navbar')
  
  <main class="max-w-7xl mx-auto px-4 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
      <!-- Main Content -->
      <div class="lg:col-span-2">
        <div class="bg-white dark:bg-neutral-800 rounded-lg shadow-sm overflow-hidden">
          <!-- Campaign Image -->
          <div class="relative">
            <img src="{{asset('storage/' . $campaign->Image)}}" 
                 alt="Imagem de doação" 
                 class="w-full h-64 sm:h-80 object-cover">
          </div>
          
          <div class="p-6">
            <!-- Campaign Title -->
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">{{$campaign->Title}}</h1>
            
            <!-- Share Section -->
            <div class="bg-gray-50 dark:bg-neutral-700 rounded-lg p-4 mb-6">
              <label for="share-input" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Compartilhe:</label>
              <div class="flex space-x-2">
                <input id="share-input" 
                       type="text" 
                       value="{{request()->url()}}" 
                       readonly 
                       class="flex-1 px-3 py-2 border border-gray-300 dark:border-neutral-600 rounded-md text-sm bg-white dark:bg-neutral-800 text-gray-900 dark:text-white">
                <button class="copy-button px-4 py-2 bg-gray-600 dark:bg-gray-400 text-white rounded-md hover:bg-gray-700 dark:hover:bg-gray-500 text-sm transition-colors" id="copy">
                  Copiar
                </button>
              </div>
            </div>

            <!-- Description -->
            <div>
              <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Descrição</h2>
              <p class="text-gray-700 dark:text-gray-300 leading-relaxed">{{$campaign->Description}}</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Sidebar -->
      <div class="lg:col-span-1">
        <div class="bg-white dark:bg-neutral-800 rounded-lg shadow-sm p-6 sticky top-8">
          <!-- Campaign Stats -->
          <div class="text-center mb-6">
            <div class="text-sm text-gray-500 dark:text-gray-400 mb-1">Arrecadado</div>
            <div class="text-3xl font-bold text-green-500 dark:text-green-400 mb-4">{{$campaign->meta['current']}}
              @if($campaign->Type === "food")
                <span class="text-sm text-gray-600 dark:text-gray-300">Kg</span>
              @else
                <span class="text-sm text-gray-600 dark:text-gray-300">Unidades</span>
              @endif
            </div>
            
            <div class="text-sm text-gray-500 dark:text-gray-400 mb-1">Meta</div>
            <div class="text-lg text-gray-700 dark:text-gray-300 mb-4">{{$campaign->meta['target']}}
              @if($campaign->Type === "food")
                <span class="text-sm text-gray-600 dark:text-gray-400">Kg</span>
              @else
                <span class="text-sm text-gray-600 dark:text-gray-400">Unidades</span>
              @endif
            </div>
            
            <!-- Progress Bar -->
            <div class="progress-bar">
              <div class="progress" style="width: {{ $progress }}%;"></div>
            </div>
          </div>

          <!-- Donation Actions -->
          @if ($donation)
            <p class="text-center text-sm text-gray-600 dark:text-gray-400 mb-4">
              Veja o qr code da sua doação <a href="/donation/{{$donation->id}}" class="text-blue-500 hover:underline dark:text-blue-400">aqui</a>
            </p>
          @elseif($campaign->user_id !== auth()->user()->id && $campaign->meta['current'] < $campaign->meta['target'])
            <a class="help-button w-full bg-green-500 hover:bg-green-600 text-white font-semibold py-4 px-6 rounded-lg text-lg mb-6 transition-colors block text-center" 
               href="/donate/{{$campaign->id}}">
              Quero Ajudar
            </a>
          @endif

          <!-- Campaign Details -->
          <div class="border-t pt-6">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Sobre a campanha</h2>
            <ul class="text-sm text-gray-600 dark:text-gray-400 space-y-2 mb-6">
              <li><strong>Dono da campanha:</strong> {{$campaign->user->name}}</li>
              <li><strong>Arrecadados:</strong> {{$campaign->meta['current']}}</li>
              <li><strong>Nossa meta:</strong> {{$campaign->meta['target']}}</li>
            </ul>

            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Local da campanha</h2>
            <ul class="text-sm text-gray-600 dark:text-gray-400 space-y-2 mb-6">
              <li><strong>CEP:</strong> {{$address->CEP}}</li>
              <li><strong>Estado:</strong> {{$address->State}}</li>
              <li><strong>Rua:</strong> {{$address->Street}}</li>
              <li><strong>Cidade:</strong> {{$address->City}}</li>
              <li><strong>Número:</strong> {{$address->Number}}</li>
              <li><strong>Dia e hora da coleta:</strong> {{\Carbon\Carbon::parse($address->Collection_date)->format('d/m/Y \à\s H:i')}}</li>
            </ul>
          </div>

          <!-- Owner Actions -->
          @if($campaign->user_id === auth()->user()->id)
            <div class="border-t pt-6 space-y-3">
              <form action="/campaign/{{$campaign->id}}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="delete_button w-full bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-md text-sm font-medium transition-colors">
                  Deletar Campanha
                </button>
              </form>
              
              <a href="/campaign/edit/{{$campaign->id}}" 
                 class="update_button w-full bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md text-sm font-medium transition-colors block text-center">
                Editar campanha
              </a>

              <button class="validator_button w-full bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-md text-sm font-medium transition-colors flex items-center justify-center" 
                      onclick="openInviteModal()">
                Convidar para campanha
                <svg class="w-4 h-4 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                  <path d="M22 13H20V7.23792L12.0718 14.338L4 7.21594V19H14V21H3C2.44772 21 2 20.5523 2 20V4C2 3.44772 2.44772 3 3 3H21C21.5523 3 22 3.44772 22 4V13ZM4.51146 5L12.0619 11.662L19.501 5H4.51146ZM21 18H24V20H21V23H19V20H16V18H19V15H21V18Z"></path>
                </svg>
              </button>
            </div>
          @endif
        </div>
      </div>
    </div>

    <!-- Invite Modal -->
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
  </main>

  <script>
    const buttonCopy = document.querySelector('#copy');
    buttonCopy.addEventListener('click', (e) => {
      const input = document.querySelector('#share-input');
      input.select();
      document.execCommand('copy');
      
      buttonCopy.innerText = 'Copiado!';
      setTimeout(() => {
        buttonCopy.innerText = 'Copiar';
      }, 2000);
    });

    function closeModal() {
      document.getElementById('invite_modal').style.display = 'none';
    }

    function openInviteModal() {
      document.getElementById('invite_modal').style.display = 'flex';
    }

    document.getElementById('invite_form').addEventListener('submit', function(e) {
      e.preventDefault();

      const formData = new FormData(this);

      fetch('{{ route("campaign.invite") }}', {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
          },
          body: formData
        })
        .then(response => response.json())
        .then(data => {
          alert(data.message);
          closeModal();
        })
        .catch(error => {
          console.error('Erro:', error);
        });
    });
  </script>
</body>
</html>
