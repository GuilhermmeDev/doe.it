<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <!-- Bloco verde -->
        <div class="container-green">
            <div class="icon">
                <img class="maoo" src="{{asset('assets/mao.svg')}}" alt="Ícone de doação">
            </div>
            <p id="carousel-text" class="quote">
                “No <span class="highlight">Doeit</span>, cada doação é um ato de amor que pode transformar vidas.”
            </p>
            <p class="subtext">Junte-se a nós e faça a diferença!</p>
        
            <!-- Indicadores -->
            <div class="carousel-indicators"></div>
        </div>
        
        <script src="{{asset('js/login.js')}}"></script>
        

        <!-- Bloco de login -->
        <div class="container-white">
            <img class="logo" src="{{asset('assets/logo.svg')}}" alt="Doeit"> <!-- Substitua pela sua logo -->
            <h2>Bem Vindo de volta!</h2>
            <form action="/login" method="POST">
                @csrf
                <label for="email">E-mail</label>
                <input type="email" id="email" placeholder="Insira seu e-mail">
                @error('email')
                 <p>{{$message}}</p>
                @enderror
                <label for="password">Senha</label>
                <div class="password-container">
                    <input type="password" id="password" placeholder="Insira sua senha">
                    <span class="toggle-password"></span>
                </div>
                @error('password')
                 <p>{{$message}}</p>
                @enderror

                <a href="/forgot-password" class="forgot-password">Esqueceu sua senha?</a>

                <button type="submit" class="btn">Entrar</button>

                <p class="signup-text">Ainda não tem uma conta? <a href="#">Cadastre-se</a></p>

                <a class="google-login" href="{{url('/login/google')}}">
                    <img class="googlee" src="{{asset('assets/google_icon.svg')}}" alt="Google">
                </a>
            </form>
        
        </div>
    </div>
</body>
</html>
