<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Convite para Campanha</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 20px;">
    <table align="center" width="100%" cellpadding="0" cellspacing="0" style="max-width: 600px; background-color: #ffffff; border-radius: 8px; padding: 30px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
        <tr>
            <td align="center" style="padding-bottom: 20px;">
                <h1 style="color: #333;">Olá {{ $user->name }}!</h1>
            </td>
        </tr>
        <tr>
            <td style="color: #555; font-size: 16px; line-height: 1.6;">
                <p>Você foi convidado por <strong>{{ $inviter }}</strong> para participar da campanha <strong>{{ $campaign->Title }}</strong>.</p>

                <p>Para aceitar o convite, clique no botão abaixo:</p>
                <p style="text-align: center;">
                    <a href="{{ route('campaign.accept', ['token' => $token]) }}"
                       style="display: inline-block; padding: 12px 24px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 6px; font-weight: bold;">
                        Aceitar Convite
                    </a>
                </p>

                <p>Ou se preferir, você pode recusar o convite clicando no botão abaixo:</p>
                <p style="text-align: center;">
                    <a href="{{ route('campaign.decline', ['token' => $token]) }}"
                       style="display: inline-block; padding: 12px 24px; background-color: #f44336; color: white; text-decoration: none; border-radius: 6px; font-weight: bold;">
                        Recusar Convite
                    </a>
                </p>

                <p style="margin-top: 30px;">Obrigado por usar o <strong>Doe.it</strong>! 💚</p>
            </td>
        </tr>
    </table>
</body>
</html>