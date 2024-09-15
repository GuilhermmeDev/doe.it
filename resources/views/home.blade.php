<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
</head>
<body>
    <a href="/campaign">Criar campanha</a>
    <h1>Aqui será a home page</h1>
    <a href="#">Aqui terá a campanha</a>

    @if (session('Sucess'))
        <p style="background-color: green; color: white; padding: 8px; border-radius: 16px; ">{{session('Sucess')}}</p>
    @endif
</body>
</html>