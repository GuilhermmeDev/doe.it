<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/fonts.css') }}">
    <title>Verificação de E-mail</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #E0E0E0; padding: 20px;">
    <div style="max-width: 600px; background: #FFFFFF; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); text-align: center;">

        <!-- Logo -->
        <img src="{{ asset('assets/logo1.svg') }}" alt="DoeIt" style="width: 120px; margin-bottom: 20px;">

        <h2 style="color: #1E1E21;">Olá, {{$user->name}}!</h2>
        <p style="color: #73737F; font-size: 16px; line-height: 1.5;">
            Bem-vindo(a)! Para ativar sua conta, confirme seu endereço de e-mail clicando no botão abaixo:
        </p>
        
        <p style="text-align: center; margin: 25px 0;">
            <a href="{{$url}}" 
               style="background-color: #2AB036; color: #E0E0E0; padding: 14px 25px; text-decoration: none; border-radius: 6px; display: inline-block; font-weight: bold; font-size: 16px;">
               Verificar E-mail
            </a>
        </p>
        
        <p style="color: #73737F; font-size: 14px;">
            Se você não criou uma conta, ignore esta mensagem.
        </p>
        <p style="font-size: 12px; color: #73737F;">
            Este e-mail foi enviado automaticamente, por favor, não responda.
        </p>

        <!-- Rodapé com detalhe laranja -->
        <div style="margin-top: 20px; height: 4px; background-color: #FF5800; border-radius: 2px;"></div>
    </div>
</body>
</html>