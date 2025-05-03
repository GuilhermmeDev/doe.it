<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="icon" href="{{ asset('assets/logo1.svg') }}" type="image/x-icon"/>
    @include('layouts.head')
    <link rel="stylesheet" href="{{asset('css/cpf.css')}}">
    <title>Cadastre seu cpf</title>
</head>
<body>
    <main class="cadastro-container">
        <header class="header-logo">Doe.It</header>
        
        <section class="cadastro-section">
            <h1 class="cadastro-title">CPF</h1>
            <p class="cadastro-subtitle">Insira seu CPF para o cadastro</p>
            
            <form class="cadastro-form" method="POST" action="/cpf">
                @csrf 
                @METHOD('PATCH')
                <div class="input-container">
                    <label for="cpf" class="form-label">CPF</label>
                    <input type="text" id="cpf" name="cpf" class="input-field" placeholder="Insira seu CPF" required>
                </div>

                <button type="submit" class="submit-button">Cadastrar</button>
            </form>

            <div class="separator">
                <hr class="line left-line">
                <span class="separator-text">ou</span>
                <hr class="line right-line">
            </div>

            <footer class="signup-prompt">
                <span>Para continuar é necessario seu CPF</span>
            </footer>
        </section>
    </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-mask-plugin@1.14.16/dist/jquery.mask.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#cpf').mask('000.000.000-00');
        });
    </script>
</body>
</html>