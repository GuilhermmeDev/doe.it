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
</head>
<body>
    <h2>Sobre a campanha</h2>
    <p>ID da campanha: {{$campaign->id}}</p>
    <p>Título: {{$campaign->Title}}</p>
    <p>Descrição: {{$campaign->Description}}</p>
    <h2>Local da campanha</h2>
    <p>Estado: {{$address->State}}</p>
    <p>CEP: {{$address->CEP}}</p>
    <p>Cidade: {{$address->City}}</p>
    <p>Rua: {{$address->Street}}</p>
    <p>Num: {{$address->Number}}</p>
    <p>Dia de coleta: {{$address->Collection_date}}</p>

    <p>Meta: {{$campaign->meta['target']}}</p>
    <p>Arrecadado: {{$campaign->meta['current']}}</p>

    <div class="container_bar">
        <div class="total_bar">
            <div class="progress_bar" style="width: {{$progress}}%;"></div>
        </div>
    </div>
    <p>{{$progress}}%</p>
</body>
</html>