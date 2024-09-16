<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$campaign->Title}}</title>
</head>
<body>
    <p>Antes de doar, entenda como funciona o nosso sistema <a href="/info">aqui</a></p>
    <h1>Doar para a campanha {{$campaign->Title}}</h1>
    @if ($campaign->meta)
        <p>A meta dessa campanha é {{$campaign->meta['target']}} kg e ela já arrecadou {{$campaign->meta['current']}} kg de comida</p>
        <p>Ajude-os a alcançar!</p>
    @endif
    <form action="/donation/{{$campaign->id}}" method="POST">
        @csrf
        <label for="Quantity">Quantos kg de comida você pretende doar?</label>
        <input type="number" name="Quantity" id="Quantity" placeholder="alimentos (kg)">

        <label for="Description">Descrição</label>
        <textarea name="Description" id="Description" cols="30" rows="5" placeholder="Mande uma mensagem de apoio (opcional)"></textarea>

        <button type="submit">Prometer doação</button>
    </form>
</body>
</html>