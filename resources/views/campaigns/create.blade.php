<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('layouts.head')
    <title>Criação de Campanha</title>
    <link rel="stylesheet" href="{{asset('css/create_campaign.css')}}">
</head>
<body>
    @include('layouts.navbar')

    <div class="frame">
        <div class="div">
          <div class="overlap-group">
            <p class="criando-sua-campanha">
              <span class="text-wrapper">Criando sua campanha<br/>no </span><span class="span">Doe.it</span>
            </p>
            
            <!-- Aqui começam as mensagens -->
            <p class="com-o-doe-it-voc">
              Com o
              <span class="text-wrapper-9">Doe.it,</span>
              você pode fazer a diferença! Crie campanhas solidárias de forma simples, gratuita e segura. Compartilhe
              sua causa e alcance pessoas em todo lugar.</span>
            </p>
            
            <!-- Aqui começa o formulário -->
            <form class="frame-wrapper" action="/campaign" method="POST" enctype="multipart/form-data">
                @csrf
              <div class="div-2">
                <div class="div-3">
                  <div class="div-4">
                    <label for="Title" class="text-wrapper-2">Título</label>
                    <input type="text" maxlength="50" name="Title" id="Title" required placeholder="Escreva o titulo da sua campanha:" class="div-wrapper-2">
                    @error('Title')
                        <div style="color: red;">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="div-5">
                    <label for="Description" class="text-wrapper-2">Descrição</label>
                    <input type="text" maxlength="1000" name="Description" id="Description" required class="div-wrapper-2" placeholder="Escreva a Descrição de sua campanha">
                    @error('Description')
                        <div style="color: red;">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="inputs">
                  <div class="frame-wrapper-2">
                    <div class="div-6">
                        <label for="State" class="text-wrapper-4">Estado:</label>
                        <select id="State" name="State" required class="div-wrapper-2">
                            <option value="Ceará">Ceará</option>
                            <option value="Rio Grande do Norte">Rio Grande do Norte</option>
                        </select>
                        @error('State')
                            <div style="color: red;">{{ $message }}</div>
                        @enderror
                    </div>
                  </div>
                  <div class="frame-wrapper-3">
                    <div class="div-6">
                        <label for="City" class="text-wrapper-4">Cidade:</label>
                        <select name="City" id="City" required class="div-wrapper-2">
                            <option value="Pereiro">Pereiro</option>
                            <option value="São Miguel">São Miguel</option>
                        </select>
                        @error('City')
                            <div style="color: red;">{{ $message }}</div>
                        @enderror
                    </div>
                  </div>
                  <div class="div-6">
                    <label for="Data" class="text-wrapper-4">Data:</label>
                    <input type="date" name="Data" id="Data" required placeholder="dd/mm/yyyy" class="div-wrapper-2">
                    @error('Data')
                        <div style="color: red;">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="div-6">

                    <label for="Hour" class="text-wrapper-4">Hora:</label>
                    <input type="time" name="Hour" id="Hour" required placeholder="00:00" class="div-wrapper-2">
                    @error('Hour')
                        <div style="color: red;">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="frame-wrapper-3">
                    <div class="div-6">
                        <label for="Street" class="text-wrapper-4">Rua:</label>
                        <input type="text" name="Street" id="Street" required placeholder="Digite a sua rua" class="div-wrapper-2">
                        @error('Street')
                            <div style="color: red;">{{ $message }}</div>
                        @enderror
                    </div>
                  </div>
                  <div class="frame-wrapper-2">
                    <div class="div-6">
                        <label for="CEP" class="text-wrapper-4">CEP:</label>
                        <input type="text" name="CEP" id="CEP" required placeholder="Digite o cep" class="div-wrapper-2">
                        @error('CEP')
                            <div style="color: red;">{{ $message }}</div>
                        @enderror
                    </div>
                  </div>
                  <div class="frame-wrapper-3">
                    <div class="div-7">
                        <label for="Number" class="text-wrapper-4">Número:</label>
                        <input type="number" name="Number" id="Number" required placeholder="Digite seu numero" class="div-wrapper-2">
                        @error('Number')
                            <div style="color: red;">{{ $message }}</div>
                        @enderror
                      <div class="frame-wrapper-2">
                        <div class="div-6">
                            <label for="Image" class="text-wrapper-4">Imagem da sua campanha:</label>
                            <input type="file" name="Image" id="Image" required class="div-wrapper-2" accept=".jpeg, .jpg, .png">
                            @error('Image')
                                <div style="color: red;">{{ $message }}</div>
                            @enderror
                        </div>
                      </div>                    
                    </div>
                  </div>
                </div>
                <div class="div-6">
                  <div class="frame-wrapper-4">
                    <div class="div-7">
                        <label class="text-wrapper-5" for="Meta">Meta:</label>
                        <input type="number" name="meta" id="meta" placeholder="Meta (kg)" max="500" class="div-wrapper-2">
                        @error('meta')
                            <div style="color: red;">{{ $message }}</div>
                        @enderror
                    </div>
                  </div>
                  <!-- Botão de Enviar -->
                  <button type="submit" class="submit-button">Continuar</button>
            </form>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
    <script>
        $(document).ready(function() {
            $('#CEP').mask('00000-000');
        });

        $(document).ready(function() {
            $('#City').change(function() {
                if ($(this).val() == "São Miguel") {
                    $('#State').val('Rio Grande do Norte');
                } else if ($(this).val() == "Pereiro") {
                    $('#State').val('Ceará');
                }
            });

            $('#State').change(function() {
                if ($(this).val() == "Rio Grande do Norte") {
                    $('#City').val('São Miguel');
                } else if ($(this).val() == "Ceará") {
                    $('#City').val('Pereiro');
                }
            });
        });
    </script>
</body>
</html>
