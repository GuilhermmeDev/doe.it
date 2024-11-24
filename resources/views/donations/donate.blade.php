<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Doar para {{$campaign->Title}}</title>
    @include('layouts.head')
    <link rel="stylesheet" href="{{asset('css/donate.css')}}">
    </style>
</head>
<body>
    @include('layouts.navbar')
    <h1 class="titulo">Doar para campanha {{$campaign->Title}}</h1>
    <p class="subtitulo">Meta: {{$campaign->meta['target']}} kg</p>
    <p class="subtitulos">Arrecadado: {{$campaign->meta['current']}} kg</p>
    <p class="text">Quantos kg de comida você pretende doar?</p>
    <p class="des">Descrição</p>
    <form action="/donation/{{$campaign->id}}" method="post">
        @csrf

        <input type="number" class="kilos" placeholder="Kilos de comida" name="Quantity" id="Quantity" max="{{$campaign->meta['target'] - $campaign->meta['current']}}"/>
        <input type="text" class="descricao" placeholder="Descrição" name="Description" id="Description"/> 
        
        <p class="text2">
          Antes de doar, entenda como funciona o nosso sistema clique<a
            href="/info"
            class="aqui"
            >aqui</a
          >
        </p>
    
        <button class="botao">Prometer doação</button>
    </form>

    <img src="{{asset('assets/donation_doodle2.svg')}}" class="img" />

</body>
</html>