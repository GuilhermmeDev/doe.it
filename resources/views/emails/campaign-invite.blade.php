<body>
    <h1>Olá {{ $user->name }}!</h1>
    <p>Você foi convidado por {{ $inviter }} para participar da campanha {{ $campaign->Title }}
    <p>
    <p>Para aceitar o convite, clique no botão abaixo:</p>
    <a href="{{ route('campaign.accept', ['token' => $token]) }}">Aceitar</a>
    <p>Para recusar o convite, clique no botão abaixo:</p>
    <a href="{{ route('campaign.decline', ['token' => $token]) }}">Recusar</a>
</body>