<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @include('layouts.head')
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
</head>
<body>
    <main class="login-container">
        <header class="header-logo">Doe.It</header>
        
        <section class="login-section">
            <h1 class="login-title">Entrar</h1>
            <p class="login-subtitle">Você pode entrar com seu e-mail</p>
            
            <form class="login-form" method="POST" action="{{route('login')}}">
                @csrf
                <div class="input-container">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" id="email" name="email" class="input-field" placeholder="Insira seu e-mail" required>
                    @error('email')
                        <p>{{$message}}</p>
                    @enderror
                </div>

                <div class="input-container-senha">
                    <input type="password" id="password" name="password" placeholder="Insira sua senha" required>
                    <span class="form-label-senha">Senha</span>
                    <img id="eyeIcon" src="{{asset('assets/oculto.svg')}}" alt="Mostrar senha" class="eye-icon">
                    @error('password')
                        <p>{{$message}}</p>
                    @enderror
                  </div>

                <button type="submit" class="submit-button">Entrar</button>
            </form>

            <div class="separator">
                <hr class="line left-line">
                <span class="separator-text">ou</span>
                <hr class="line right-line">
            </div>

            <footer class="signup-prompt">
                <span>Não tem uma conta? </span>
                <a href="/register" class="signup-link">Cadastre-se</a>
            </footer>
        </section>
    </main>
</body>
</html>

<script>
    document.getElementById('eyeIcon').addEventListener('click', function () {
        const passwordField = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');

    if (passwordField.type === 'password') {
        passwordField.type = 'text'; // Torna o campo visível
        eyeIcon.src = '{{asset("assets/visivel.svg")}}'; // Altera para o ícone de "visível"
    } else {
        passwordField.type = 'password'; // Torna o campo oculto
        eyeIcon.src = '{{asset("assets/oculto.svg")}}'; // Altera para o ícone de "oculto"
    }
    });
</script>
