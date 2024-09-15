<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$campaign->Title}}</title>
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

</body>
</html>