<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  @include('layouts.head')
  <link rel="stylesheet" href="{{asset('css/campaign.css')}}">
  <title>{{$campaign->Title}}</title>
</head>

<body>
  @include('layouts.navbar')
  <main>
    <section class="campaign">
      <article class="campaign-content">
        <h1>{{$campaign->Title}}</h1>
        <img src="{{asset('img/campaigns/' . $campaign->Image)}}" alt="Imagem de doação" class="campaign-image">
        <div class="description">
          <div class="share">
            <label for="share-input" class="share-label">Compartilhe:</label>
            <input id="share-input" type="text" value="{{request()->url()}}" readonly>
            <button class="copy-button" id="copy">Copiar</button>
          </div>
          <h2>Descrição</h2>
          <p class="description-text">{{$campaign->Description}}</p>
        </div>
      </article>
      <aside class="campaign-details">
        <h2 class="sobre">Sobre a campanha</h2>
        <ul>
          <li><strong>Dono da campanha:</strong> {{$campaign->user->name}}</li>
          <li><strong>Arrecadados:</strong> {{$campaign->meta['current']}}</li>
          <li><strong>Nossa meta:</strong> {{$campaign->meta['target']}}</li>
        </ul>
        <h2 class="local">Local da campanha</h2>
        <ul>
          <li><strong>CEP:</strong> {{$address->CEP}}</li>
          <li><strong>Estado:</strong> {{$address->State}}</li>
          <li><strong>Rua:</strong> {{$address->Street}}</li>
          <li><strong>Cidade:</strong> {{$address->City}}</li>
          <li><strong>Número:</strong> {{$address->Number}}</li>
          <li><strong>Dia e hora da coleta:</strong> {{\Carbon\Carbon::parse($address->Collection_date)->format('d/m/Y \à\s H:i')}}</li>
        </ul>
        <div class="progress-bar">
          <div class="progress" style="width: {{$progress}}%;"></div>
        </div>
        @if ($donation)
        <p>Veja o qr code da sua doação <a href="/donation/{{$donation->id}}">aqui</a></p>
        @elseif($campaign->user_id !== auth()->user()->id && $campaign->meta['current'] < $campaign->meta['target'])
          <a class="help-button" href="/donate/{{$campaign->id}}">Doar</a>
          @endif

          @if($campaign->user_id === auth()->user()->id)
          <div style="display: flex; flex-direction: column; gap: 10px; width: fit-content;">
            <form action="/campaign/{{$campaign->id}}" method="post">
              @csrf
              @method('DELETE')

              <button type="submit" class="delete_button">Deletar Campanha</button>
            </form>
            <a href="/campaign/edit/{{$campaign->id}}" class="update_button">Editar campanha</a>

            <button class="validator_button" onclick="openInviteModal()">Convidar para campanha
              <div style="width: 20px;"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                  <path d="M22 13H20V7.23792L12.0718 14.338L4 7.21594V19H14V21H3C2.44772 21 2 20.5523 2 20V4C2 3.44772 2.44772 3 3 3H21C21.5523 3 22 3.44772 22 4V13ZM4.51146 5L12.0619 11.662L19.501 5H4.51146ZM21 18H24V20H21V23H19V20H16V18H19V15H21V18Z"></path>
                </svg></div>
            </button>
          </div>
          @endif
      </aside>

      <div id="invite_modal">
        <button onclick="closeModal()" class="close_modal">X</button>
        <form id="invite_form">
          @csrf
          <label for="inviteEmail">Digite o e-mail</label>
          <input id="inviteEmail" type="email" name="email" placeholder="exemplo@email.com" required />
          <input type="hidden" name="campaign_id" value="{{ $campaign->id }}" />
          <button type="submit" style="margin-top: 10px;" class="validator_button">Enviar convite</button>
        </form>
      </div>

    </section>
  </main>

  <script>
    const buttonCopy = document.querySelector('#copy');
    buttonCopy.addEventListener('click', (e) => {
      const input = document.querySelector('#share-input');
      input.select();
      document.execCommand('copy');

      buttonCopy.innerText = 'Copiado!';
    });

    function closeModal() {
      document.getElementById('invite_modal').style.display = 'none';
    }

    function openInviteModal() {
      document.getElementById('invite_modal').style.display = 'block';
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
          document.getElementById('inviteModal').style.display = 'none';
        })
        .catch(error => {
          console.error('Erro:', error);
        });
    });
  </script>

</body>

</html>