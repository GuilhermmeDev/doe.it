<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Criação de Campanha</title>
</head>
<body>
    <form action="/campaign" method="POST">
        @csrf
        <h1>Sobre sua campanha:</h1>
        <label for="Title">Titulo</label>
        <input type="text" maxlength="50" name="Title" id="Title">

        <label for="Description">Descrição</label>
        <input type="text" maxlength="1000" name="Description" id="Description">

        <h1>Onde e quando será a sua campanha?</h1>

        <label for="State">Estado:</label>
        <input type="text" name="State" id="State">

        <label for="City">Cidade:</label>
        <input type="text" name="City" id="City">

        <label for="Street">Rua:</label>
        <input type="text" name="Street" id="Street">

        <label for="Number">Número:</label>
        <input type="number" name="Number" id="Number">

        <label for="CEP">CEP:</label>
        <input type="number" name="CEP" id="CEP">

        <label for="Data">Data:</label>
        <input type="datetime-local" name="Data" id="Data">

        <button type="submit">Enviar</button>
    </form>

    <button id="act">Clique</button>

    <script>
        const button = document.querySelector('#act');
        button.addEventListener('click', (e) => {
            const input = document.querySelector('#Data');
            console.log(input.value)
        })
    </script>
</body>
</html>