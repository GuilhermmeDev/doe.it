<link rel="stylesheet" href="{{asset('css/navbar.css')}}">
<nav class="navbar">
    <a class="logo" href="/home">Doe.It</a>
    <div class="nav-links">
        @if (request()->path() == 'home')
            <div class="search-container">
            <span class="search-icon"></span>
            <input type="text" placeholder="Pesquisar" class="search-input">
            </div>
        @endif
      <a href="/info" class="link">Sobre</a>
      <a class="campaign-button" href="/campaign">Criar Campanha</a>
    </div>
</nav>