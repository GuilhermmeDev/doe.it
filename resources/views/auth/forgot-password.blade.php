<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir Senha - DoeIt</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap">
    <link rel="shortcut icon" type="imagex/png" href="doeit.svg">
    <style>
        html, body{
            overflow: hidden;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            overflow-y: none;
            overflow-x: none;
            background-color: #ddd;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .fundo-branco {
          
            background-color: #ffffff;
            width: 80%;
            height: 90%;
            margin-top: 70px;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .formulario {
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .logo img {
            margin-top: 15px;
            margin-bottom: 10px;
            width: 138px;
            height: 50px;
        }

        h2 {
            font-size: 24px;
            margin-bottom: 40px;
            color: #333333;
            font-weight: 500;
            margin-top: 50px;
        }

        .e-mail {
            display: block;
            font-size: 14px;
            text-align: left;
            margin-bottom: 5px;
            color: #555;
        }

        input {
            width: 100%;
            height: 52px;
            padding: 0.8rem;
            font-size: 14px;
            border-radius: 8px;
            background-color: #ECECEC;
            color: #4E4E54;
            border: none;
            margin-top: 8px;
        }

        p {
            font-size: 12px;
            color: #1E1E1E;
            margin-bottom: 20px;
            margin-top: 16px;
            font-weight: 200;
        }

        button {
            background-color: #5FCB69;
            color: #FFFFFF;
            border: none;
            width: 25%;
            height: 40px;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 35px;
        }

        button:hover {
            background-color: #45a049;
        }

        @media (max-width: 600px) {
            .fundo-branco {
                width: 95%;
                padding: 20px;
            }

            .formulario {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="fundo-branco">
        <div class="formulario">
            <div class="logo">
                <img src="{{asset('assets/logo.svg')}}" alt="doeit logo">
            </div>
            <h2>Redefinir senha</h2>
            <div class="e-mail">
                <label for="email">E-mail</label>
            </div>
            <form action="{{route('password.email')}}" method="post">
                @csrf
                <input type="email" id="email" name="email" value="{{old('email')}}" placeholder="Insira seu e-mail" required>
                @error('email')
                    <p>{{$message}}</p>
                @enderror
                <p>Se você não nos forneceu um endereço de e-mail real ao criar sua conta, não poderemos lhe enviar um e-mail de recuperação.</p>
                <button type="submit">Enviar</button>
            </form>
        </div>
    </div>
</body>
</html>