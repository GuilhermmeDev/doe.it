<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" >
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="{{asset('css/info/vars.css')}}" />
    <link rel="stylesheet" href="{{asset('css/info/info.css')}}" />
    @include('layouts.head')
    <title>Informações</title>
  </head>
  <body>
    @include('layouts.navbar')
      <div class="rectangle-79"></div>
      <div class="rectangle-78"></div>
      <div class="quadradoverde">
        <span>
          <span
            class="somos-os-desenvolvedores">
            <br/>
            Somos os desenvolvedores do site doe.it!
            <br/>
            Nossa missão é tornar o mundo um lugar mais generoso e próspero.
            Ajude essa causa; ajude o mundo.
            <br/>
            Como funciona o nosso sistema de doação?
            <br/>
            Diferente das grandes plataformas de doação que o meio de troca é o
            dinheiro, nosso site foca no que é vital para a vida, a comida.
            <br/>
            O sistema funciona da seguinte maneira:
            <br/>
            <br>
          </span>
          <ol
            class="lista">
            <li>
              Você faz uma &quot;promessa&quot; de doação na página da campanha, 
              ou seja, você diz ao donatário que vai doar o que disse;
            </li>
            <li>
              Após fazer isso no site, no dia da coleta e local informado pelo 
              donatário, você tem que ir para mostrar o qr code para o recebedor
              da doação confirmar sua ação.
            </li>
            <li>
              Atráves dessa leitura do qr code, tanto você que doou quanto a
              pessoa que  está recebendo a doação possuem segurança que a
              transação ocorreu de verdade.
            </li>
          </ol>
        </span>
      </div>
    <div class="ol-usu-rio">Olá, usuário!</div>
    <div class="oadores blocos"><span class="highlight">D</span>oadores</div>
    <div class="op-rtunidades blocos">Op<span class="highlight">o</span>rtunidades</div>
    <div class="engajam-nto blocos">Engajam<span class="highlight">e.</span>nto</div>
    <div class="perm-ir blocos">Perm<span class="highlight">It</span>ir</div>
  </body>
</html>
