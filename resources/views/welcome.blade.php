<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('layouts.head')
    <link rel="stylesheet" href="{{asset('css/landing_page.css')}}">
    <title>Doe.It - Sistema de Doação</title>
</head>
<body>
        <h1 class="logo">Doe.it</h1>
        <div class="escritas">
            <h2 class="subtitulo"><p class="subsub">Doe.it oficial</p>
                Doe.it: just doe it <br>
                Começa aqui</h2>
            <p class="info"><b>de ajuda com alimentação?</b> <br> no <span class="no"><b>Doe.it</b> </span>, conectamos você a 
                quem pode <br> ajudar. Nossa missão é 
                <b>garantir</b> que ninguém <br> fique sem o essencial. Com alguns 
                cliques, <br> você pode receber <b>doações</b> de alimentos ou <br> 
                contribuir para quem precisa.</p>
        </div>

        <button class="doar" onclick="window.location.href='/register'">Quero doar</button>
        <button class="criar" onclick="window.location.href='/register'">Criar campanha</button>
        <img src="{{asset('assets/img.svg')}}" class="img">
        
    <div class="formulario tdd" action="/register">
        <div class="campos">
            <div class="form-group">
            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" placeholder="Escreva o título da sua campanha:" readonly/>
            </div>
        
            <div class="form-group">
            <label for="descricao">Descrição:</label>
            <input type="text" id="descricao" name="descricao" placeholder="Descreva sua campanha:" readonly></input>
            </div>
        
            <div class="form-group">
            <label for="estado">Estado:</label>
            <input type="text" id="estado" name="estado" placeholder="Escolha o estado" readonly/>
            </div>
        
            <div class="form-group">
            <label for="cidade">Cidade:</label>
            <input type="text" id="cidade" name="cidade" placeholder="Escolha a cidade" readonly/>
            </div>
        
            <div class="form-group">
            <label for="data">Data:</label>
            <input type="date" id="data" name="data" readonly/>
            </div>
        
            <div class="form-group">
            <label for="rua">Rua:</label>
            <input type="text" id="rua" name="rua" placeholder="Digite sua rua" readonly/>
            </div>
        
            <div class="form-group">
            <label for="cep">CEP:</label>
            <input type="text" id="cep" name="cep" placeholder="Digite o CEP" readonly/>
            </div>
        
            <div class="form-group">
            <label for="numero">Número:</label>
            <input type="text" id="numero" name="numero" placeholder="Digite o número" readonly/>
            </div>
        
            <div class="form-group">
            <label for="meta">Meta:</label>
            <input type="number" id="meta" name="meta" placeholder="Meta (kg)" readonly/>
            </div>
            <button onclick="window.location.href='/register'" class="continuar">Continuar</button>
        </div>
    </div>

    <div class="secao tdd"><p class="campanha tdd">Como criar a sua <br> campanha online no <br>
        Doe.It</p><p class="add tdd">
            Preencha o formulário <br>
            A criação da sua vaquinha começa no formulário desta página. <br>
            <br>
            Complete as informações <br>
            Descreva a sua vaquinha - essa é a parte onde você contará a sua história. <br>
            <br>
            Compartilhe <br>
            Divulgue em suas redes, todos os dias, e peça que seus amigos <br> e familiares também compartilhem em suas redes e grupos.
        </p>
    <img src="{{asset('assets/certo.svg')}}" alt="" class="certo">
    <img src="{{asset('assets/certo.svg')}}" alt="" class="certo1">
    <img src="{{asset('assets/certo.svg')}}" alt="" class="certo2">
    </div>



    <p class="conclusao">3 motivos para escolher o Doe.It</p>
    <div class="blocos">
    <div class="bloco"><img src="{{asset('assets/doação.svg')}}" class="imgdoacao">

    <p class="textodobloco">Você recebe mais <br> doações</p>
    <p class="infobloco">Somos a maior, mais <br> conhecida e 
        confiável plataforma de vaquinhas <br> online e isso reflete 
        em um maior volume de doadores <br> e doações para a sua campanha.</p></div>

    <div class="bloco2"><img src="{{asset('assets/cadernetac.svg')}}" class="imgcaderneta">
    <p class="textodobloco2">Nossa plataforma é a mais <br> completa</p>
    <p class="infobloco2">No Doe.it você pode utilizar funcionalidades como <br> 
        criação de equipes para <br> ajudar na divulgação da sua 
        campanha, além de poder postar novidades e agradecer 
        individualmente.</p></div>

    <div class="bloco3"><img src="{{asset('assets/shield.svg')}}" class="imgseguranca">
    <p class="textodobloco3">Prezamos pela segurança <br> e transparência</p>
    <p class="infobloco3">As senhas são criptografadas <br> e dados 100% seguros. 
        Aqui <br> você terá um painel de <br> controle com todas as <br> informações 
        atualizadas da <br> sua vaquinha e como o fluxo <br> de doações.</p></div>

    </div>
</body>
</html>