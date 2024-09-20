<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Confirmar Doação</title>
</head>
<body>
    <div class="infos">
        @if($donation->Description)
            <p>Descrição da doação:</p>
            <p><strong>{{$donation->Description}}</strong></p>
        @endif
        <p>Quantidade doada: <strong>{{$donation->Quantity}}</strong></p>
    </div>

    <form action="/confirm/{{$donation->id}}" method="post">
        @csrf 
        <h3>Você tem certeza que quer confirmar essa doação?</h3>
        <p>Ao clicar em "Confirmar Doação" você confirma que recebeu tal doação.</p>
        <h5>Essa ação não pode ser desfeita.</h5>
        <button type="submit">Confirmar Doação</button>
    </form>
</body>
</html>