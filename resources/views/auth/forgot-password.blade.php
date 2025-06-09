<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <title>Esqueceu a Senha? - Doeit</title>
</head>
<body class="h-screen">
    @include('layouts.secondary_navbar')
    <section class="h-full flex flex-col justify-center items-center">
        <div class="max-w-3xl px-6 py-16 mx-auto text-center">
            <h1 class="text-3xl font-semibold">Perdeu a Senha?</h1>
            <p class="max-w-md mx-auto mt-5">Não se preocupe. Nós iremos te mandar um e-mail de recupação de senha.</p>

            <form class="flex flex-col mt-8 space-y-3 sm:space-y-0 sm:flex-row sm:justify-center sm:-mx-2" method="POST" action="{{route('password.email')}}">
                    @csrf
                <input id="email" type="email" name="email" class="px-4 py-2  border rounded-md sm:mx-2  focus:border-blue-400 focus:outline-none focus:ring focus:ring-opacity-40" placeholder="Digite seu email" required>
                @error('email')
                    @include('layouts.error_popup')
                @enderror
                <button class="px-4 py-2 text-sm font-medium tracking-wide capitalize text-white transition-colors duration-300 transform bg-[#2AB036] hover:bg-green-600 active:bg-green-700 rounded-md sm:mx-2 focus:outline-none ">
                    Recuperar Senha
                </button>
            </form>
        </div>
    </section>
</body>
</html>
