<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('layouts.head')
    <link rel="stylesheet" href="{{asset('css/campaign.css')}}">
    <title>{{$campaign->Title}}</title>
    <style>
        .container_bar {
            width: 20%;
            height: 10px;
        }

        .total_bar {
            border-radius: 16px;
            width: 100%;
            height: 100%;
            margin: 10px;
            background-color: rgb(165, 165, 165);
        }

        .progress_bar {
            max-width: 100%;
            height: 100%;
            border-radius: 16px;
            background-color: #00a900;
        }
    </style>
    @vite('resources/js/app.js')
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
              <li><strong>Dia da coleta e hora:</strong> {{$address->Collection_date}}</li>
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
                <form action="/campaign/{{$campaign->id}}" method="post">
                    @csrf 
                    @method('DELETE')

                    <button type="submit">Deletar Campanha</button>
                </form>
            @endif
          </aside>
        </section>
      </main>

<script>
    const buttonCopy = document.querySelector('#copy');
    buttonCopy.addEventListener('click', (e) => {
        const input = document.querySelector('#share-input');
        input.select();
        document.execCommand('copy');

        buttonCopy.innerText = 'Copiado!';
    })
</script>
    
</body>
</html>