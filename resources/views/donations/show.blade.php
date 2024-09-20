<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Qr code</title>
</head>
<body>
    @vite('resources/js/app.js')
    <img src="data:image/png;base64, {{$donation->qr_code}}" alt="qr code">
    @if ($donation->Description)
        <p><strong>Descrição:</strong></p>
        <p>{{$donation->Description}}</p>
    @endif
    <form action="/donation/{{$donation->id}}" method="POST">
        @csrf 
        @method('DELETE')
        <button type="submit">Cancelar Doação</button>
    </form>

    <script>
        window.onload=function() {
            const donationId = "{{$donation->id}}";
            Echo.channel(`testChannel`)
            .listen('ConfirmDonation', (e) => {
                console.log(e);
                console.log('deu certo, nao acreditoooo');
            });
        }
    </script>
</body>
</html>