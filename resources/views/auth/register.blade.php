<!DOCTYPE html>
<html lang="pt-br">
<head>
    @include('layouts.head')
    <link rel="stylesheet" href="{{asset('css/register.css')}}">
</head>
<body>
    <main class="cadastro-container">
        <header class="header-logo">Doe.It</header>
        
        <section class="cadastro-section">
            <h1 class="cadastro-title">Cadastro</h1>
            <p class="cadastro-subtitle">Se cadastre no <span class="signup-link">Doe.it</span> aqui</p>
            
            <form class="cadastro-form" method="POST" action="{{route('register')}}">
                @csrf
                <div class="input-container">
                    <label for="name" class="form-label">Nome*</label>
                    <input type="text" id="name" name="name" class="input-field" placeholder="Insira seu nome" required>
                    @error('name')
                        <p>{{$message}}</p>
                    @enderror
                </div>

                <div class="input-container">
                    <label for="email" class="form-label">E-mail*</label>
                    <input type="email" id="email" name="email" class="input-field" placeholder="Insira seu e-mail" required>
                    @error('email')
                        <p>{{$message}}</p>
                    @enderror
                </div>

                <div class="input-container-senha">
                    <input type="password" id="password" name="password" placeholder="Insira sua senha" required>
                    <span class="form-label-senha">Senha*</span>
                    @error('password')
                        <p>{{$message}}</p>
                    @enderror
                  </div>

                  <div class="input-container-senha">
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Insira sua senha" required>
                    <span class="form-label-senha">Confirme sua senha*</span>
                    @error('password_confirmation')
                        <p>{{$message}}</p>
                    @enderror
                  </div>

                <button type="submit" class="submit-button">Cadastre-se</button>
            </form>

            <div class="separator">
                <hr class="line left-line">
                <span class="separator-text">ou</span>
                <hr class="line right-line">
            </div>

            <footer class="signup-prompt">
                <span>Ja tem conta? </span>
                <a href="/login" class="signup-link">Entrar</a>
            </footer>
        </section>
    </main>
</body>
</html>

