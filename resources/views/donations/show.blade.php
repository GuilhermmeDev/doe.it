<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Qr code</title>
    @include('layouts.head')
    <link rel="stylesheet" href="{{asset('css/qrcode.css')}}">
</head>
<body>
    @vite('resources/js/app.js')
    @include('layouts.navbar')

    <main class="container">
        <section class="campaign-info">
            <h1>QR Code da Doação</h1>
            <p>ID: {{$donation->id}}</p>
            {{$donation->created_at}}
            {{$donation->Status}}
            <p>Descrição</p>
            @if ($donation->Description)
                <textarea class="description-box" readonly >{{$donation->Description}}</textarea>
            @endif
            <form action="/donation/{{$donation->id}}" method="post">
                @csrf
                @method('DELETE')

                <button class="cancel-button" type="submit">Cancelar Doação</button>
            </form>
        </section>

        <div class="qr-placeholder">
            <img src="data:image/png;base64, {{$donation->qr_code}}" alt="QR CODE">
        </div>
    </main>

    <script>
        window.onload=function() {
            Echo.private(`donation.{{$donation->id}}`)
            .listen('ConfirmDonation', (e) => {
                console.log("Donation confirmed");
                window.location.reload(true);
            });
        }
    </script>
</body>
</html>
