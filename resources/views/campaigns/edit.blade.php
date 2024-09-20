<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar campanha</title>
    <style>
        form {
            display: flex;
            flex-direction: column;
            width: fit-content;
        }
    </style>
</head>
<body>
    <h1>Atualize os dados da sua campanha</h1>
    <div class="container">
        <form action="/campaign/update/{{$campaign->id}}" method="post">
            @csrf 
            @method('PUT')
            <label for="Title">Titulo da Campanha</label>
            <input type="text" name="Title" id="Title" value="{{$campaign->Title}}">
            
            <label for="Description">Descrição</label>
            <input type="text" name="Description" id="Description" value="{{$campaign->Description}}">

            <button type="submit">Atualizar</button>
        </form>
    </div>
</body>
</html>