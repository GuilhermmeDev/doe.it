<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Qr code</title>
</head>
<body>
    <img src="data:image/png;base64, {{$donation->qr_code}}" alt="qr code">
    @if ($donation->Description)
        <p><strong>Descrição:</strong></p>
        <p>{{$donation->Description}}</p>
    @endif
</body>
</html>