<link rel="stylesheet" href="{{asset('css/navbar.css')}}">
<nav class="navbar">
    <a class="logo" href="/home">Doe.It</a>
    <div class="nav-links">
        @if (request()->path() == 'home')
            <div class="search-container">
            <span class="search-icon"></span>
                <form action="/home" method="GET">
                    <input type="text" placeholder="Pesquisar" name="q" id="q" class="search-input">
                </form>
            </div>
        @endif
      <a href="/info" class="link">Sobre</a>
      <a class="campaign-button" href="/campaign">Criar Campanha</a>
    </div>
</nav>