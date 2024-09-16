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
        <input type="text" maxlength="50" name="Title" id="Title" required>

        <label for="Description">Descrição</label>
        <input type="text" maxlength="1000" name="Description" id="Description" required>

        <h1>Onde e quando será a sua campanha?</h1>

        <label for="State">Estado:</label>

        <select id="State" name="State" required>
            <option value="Ceará">Ceará</option>
            <option value="Rio Grande do Norte">Rio Grande do Norte</option>
        </select>


        <label for="City">Cidade:</label>
        <select name="City" id="City" required>
            <option value="Pereiro">Pereiro</option>
            <option value="São Miguel">São Miguel</option>
        </select>

        <label for="Street">Rua:</label>
        <input type="text" name="Street" id="Street" required>

        <label for="Number">Número:</label>
        <input type="text" name="Number" id="Number" required>

        <label for="CEP">CEP:</label>
        <input type="text" name="CEP" id="CEP" required>

        <label for="Data">Data:</label>
        <input type="datetime-local" name="Data" id="Data" required>

        <h1>Sua Campanha possui alguma meta de arrecadação de alimentos?</h1>
        <p>Se sim, informe:</p>
        <input type="number" name="meta" id="meta" placeholder="meta (kg)" max="500">

        <button type="submit">Enviar</button>
    </form>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
    <script>
        $(document).ready(function() {
            $('#CEP').mask('00000-000');
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#City').change(function() {
                if ($(this).val() == "São Miguel") {
                    $('#State').val('Rio Grande do Norte');
                }
                else if ($(this).val() == "Pereiro") {
                    $('#State').val('Ceará');

                }
            })

            $('#State').change(function() {
                if ($(this).val() == "Rio Grande do Norte") {
                    $('#City').val('São Miguel');
                }
                else if ($(this).val() == "Ceará") {
                    $('#City').val('Pereiro');

                }
            })
        })
    </script>
</body>
</html>