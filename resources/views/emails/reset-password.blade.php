<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinição de Senha</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px;">
    <div style="max-width: 600px; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
        <h2 style="color: #333;">Olá, {{$user->name}}!</h2>
        <p>Recebemos um pedido para redefinir sua senha. Clique no botão abaixo para escolher uma nova senha:</p>
        
        <p style="text-align: center;">
            <a href={{$url}} 
               style="background-color: #4CAF50; color: white; padding: 12px 20px; text-decoration: none; border-radius: 5px; display: inline-block;">
               Redefinir Senha
            </a>
        </p>
        
        <p>Se você não solicitou essa alteração, ignore este e-mail. Sua senha permanecerá a mesma.</p>
        <p style="font-size: 12px; color: #888;">Este e-mail foi gerado automaticamente, por favor, não responda.</p>
    </div>
</body>
</html>
