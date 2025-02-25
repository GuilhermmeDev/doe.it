<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de cadastro</title>
    <link rel="stylesheet" href="{{asset('css/register.css')}}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bona+Nova+SC:ital,wght@0,400;0,700;1,400&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Righteous&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>
<body>

    <form action="{{route('register')}}" method="POST" class="formulario">
        @csrf
        <div>
            <label class="nome" for="name">Nome</label>
            <input class="campos campos1" placeholder="Insira seu nome" type="text" id="name" name="name" required>
        </div>
        @error('name')
            <p>{{$message}}</p>
        @enderror
        
        <div>
            <label class="email" for="email">Email</label>
            <input class="campos campos2" placeholder="Insira seu e-mail" type="email" id="email" name="email" required>
        </div>
        @error('email')
            <p>{{$message}}</p>
        @enderror
        
        <div>
            <label class="password" for="password">Senha</label>
            <input class="campos campos3" placeholder="Insira sua senha" type="password" id="password" name="password" required>
            <img src="{{asset('assets/olho.svg')}}" alt="olho" class="olho" onclick="togglePassword('password')">
        </div>
        @error('password')
            <p>{{$message}}</p>
        @enderror
        
        <div>
            <label class="password_confirmation" for="password_confirmation">Confirmação de Senha:</label>
            <input class="campos campos4" placeholder="Confirme sua senha" type="password" id="password_confirmation" name="password_confirmation" required>
            <img src="{{asset('assets/olho.svg')}}" alt="olho" class="olho1" onclick="togglePassword('password_confirmation')">
        </div>
        @error('password_confirmation')
            <p>{{$message}}</p>
        @enderror
        
        
        <button class="button" type="submit">Cadastre-se</button>
    </form>



    <p class="junte-se">
        Junte-se a nós e faça a diferença!
    </p>
    <div class="verde">

        <div class="carrossel">
        <p class="frases" id="frase"></p>
        <div class="indicadores" id="indicadores"></div>
         </div>

</div>



    <div class="quadrado-branco"></div>
    
    <figure>
        <img class="img" src="{{asset('assets/mao.svg')}}" alt="erro">
    </figure>



    <img class="logo" src="{{asset('assets/logo.svg')}}">
    <p class="faça-parte"> Faça parte do <span class="subdoe"> Doeit </span> agora! </p>

    <p class="japossui">Já possuí uma conta? Faça <a class="login" href="/login">Login</a></p>



    <a href="{{url('/login/google')}}">
        <img class="logogoogle" src="{{asset('assets/google_icon.svg')}}" alt="google icon">
    </a>
    
    <script src="{{asset('js/register.js')}}"></script>
</body>
</html>