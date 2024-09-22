<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
</head>
<body>
    <div class="search_container">
        <form action="/home" method="GET">
            <input type="text" name="q" id="q" placeholder="Procure uma campanha">
        </form>
    </div>

    @if (session('error'))
        {{session('error')}}<br>
    @endif

    <a href="/campaign">Criar campanha</a>
    @if ($search)
        <p>Procurando campanha: {{$search}}</p>
    @else
        <h1>Aqui será a home page</h1>
    @endif

    @if (count($campaigns) === 0)
        <p>Campanha não encontrada</p>
    @endif

    @foreach ($campaigns as $camp)
        <a href="/campaign/{{$camp->id}}">{{$camp->Title}}</a>
    @endforeach

    @if (session('Sucess'))
        <p style="background-color: green; color: white; padding: 8px; border-radius: 16px; ">{{session('Sucess')}}</p>
    @endif
</body>
</html>