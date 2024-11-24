<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('layouts.head')
    <title>Confirmar Doação</title>
    <link rel="stylesheet" href="{{asset('css/confirm_qrcode.css')}}">
</head>
<body>
    <div class="container">
        <div class="left-section">
          <h2>Confirmar Doação</h2>
          <p>Usuário: <strong>{{$donation->user->name}}</strong></p>
          @if ($donation->Description)
            <p>Descrição da doação</p>
            <textarea placeholder="Detalhes da doação">{{$donation->Description}}</textarea>
          @endif
          <p class="quantity">Quantidade doada: <span>{{$donation->Quantity}}</span></p>
          <form action="/confirm/{{$donation->id}}" method="post">
            @csrf 
                <p class="confirmation-text">Você tem certeza que quer confirmar essa doação?</p>
                <button class="confirm-button" type="submit">Confirmar doação</button>
                <p class="info-text">Ao clicar em "Confirmar doação" você afirma que recebeu tal doação</p>
            </form>
        </div>
        <div class="right-section">
          <img src="{{asset('assets/donation_doodle.png')}}" alt="Ilustração de doação" />
        </div>
    </div>
</body>
</html>