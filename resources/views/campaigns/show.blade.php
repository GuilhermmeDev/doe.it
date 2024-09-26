<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
    <h2>Sobre a campanha</h2>
    <p>ID da campanha: {{$campaign->id}}</p>
    <p>Título: {{$campaign->Title}}</p>
    <p>Descrição: {{$campaign->Description}}</p>
    <p>Dono da campanha: {{$campaign->user->name}}</p>
    <h2>Local da campanha</h2>
    <p>Estado: {{$address->State}}</p>
    <p>CEP: {{$address->CEP}}</p>
    <p>Cidade: {{$address->City}}</p>
    <p>Rua: {{$address->Street}}</p>
    <p>Num: {{$address->Number}}</p>
    <p>Dia de coleta: {{$address->Collection_date}}</p>
    @if ($progress !== null || $progress === 0)
        <p id="target">Meta: {{$campaign->meta['target']}}</p>
        <p id="current">Arrecadado: {{$campaign->meta['current']}}</p>

        <div class="container_bar">
            <div class="total_bar">
                <div class="progress_bar" style="width: {{$progress}}%;"></div>
            </div>
        </div>
        <p id="progress">{{$progress}}%</p>
    @else 
        <p>Essa campanha não possui meta.</p>
    @endif
    @if ($donation && $donation->campaign_id === $campaign->id && $donation->Status != 'confirmed')
        <p>Veja o qr code de sua doação <a href="/donation/{{$donation->id}}">aqui</a></p>
    @elseif($campaign->user_id !== auth()->user()->id && $campaign->meta['current'] < $campaign->meta['target'])
        <a href="/donate/{{$campaign->id}}">Doar para essa campanha</a>
    @endif

    <p>Apoiadores: {{$donation_count}}</p>

    @if(auth()->user()->id === $campaign->user_id)
        <form action="/campaign/{{$campaign->id}}" method="post">
            @csrf 
            @method('DELETE')

            <button type="submit">Deletar Campanha</button>
        </form>
        <a href="/campaign/edit/{{$campaign->id}}">Editar Campanha</a>
    @endif

    <script>
        window.onload=function() {
            Echo.channel(`testMeta`)
            .listen('CampaignMeta', (e) => {
                const currentText = document.querySelector('#current');
                const targetText = document.querySelector('#target');

                const currentMeta = e.meta.current;
                const targetMeta = e.meta.target;

                currentText.innerText = `Meta: ${currentMeta}`;
                targetText.innerText = `Meta: ${targetMeta}`;

                const progressText =  document.querySelector('#progress');

                const percent = (currentMeta/targetMeta) * 100;
                const progress = Math.round(percent, -1);
                progressText.innerText = `${progress}%`;

                console.log(`OK! Perc: ${progress}`);
            }
            );
        }
    </script>
</body>
</html>