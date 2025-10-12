<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histórico de Doações</title>
 <link rel="icon" href="{{ asset('assets/favicon.svg') }}" type="image/x-icon" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white dark:bg-neutral-900 text-black dark:text-white min-h-screen overflow-x-hidden">
    @include('layouts.secondary_navbar')

    <main class="max-w-4xl mx-auto p-6">
        <h1 class="text-3xl font-bold mb-8 text-[#5FCB69] dark:text-[#5FCB69]">Histórico de Doações</h1>
        @if(count($historic) === 0)
            <div class="bg-[#f0f0f0] dark:bg-neutral-800 rounded-xl p-6 text-center text-lg text-gray-700 dark:text-gray-300">
                Você ainda não realizou nenhuma doação.
            </div>
        @else
            <section class="grid gap-6">
                @foreach($historic as $donation)
                    @php
                        $campaign = $donation->campaign;
                        $validator = $donation->validator_id ? $donation->validator->name : null;
                    @endphp
                    <article>
                        <a href="{{ $campaign ? url('/campaign/' . $campaign->id) : '#' }}" class="block rounded-xl p-5 bg-[#f0f0f0] dark:bg-neutral-800 shadow hover:bg-[#e0e0e0] dark:hover:bg-neutral-700 transition cursor-pointer flex flex-col sm:flex-row sm:items-center justify-between">
                            <div class="flex-1">
                                <div class="text-lg font-semibold text-[#5FCB69] dark:text-[#5FCB69] mb-1">
                                    {{ $campaign->Title ?? 'Campanha removida' }}
                                </div>
                                <div class="text-sm text-gray-700 dark:text-gray-300 mb-1">
                                    <span class="font-medium">Validador:</span>
                                    {{ $validator ? $validator : '-' }}
                                </div>
                                <div class="text-sm text-gray-700 dark:text-gray-300 mb-2">
                                    <span class="font-medium">Data:</span>
                                    {{ $donation->Confirmed_at ? $donation->Confirmed_at->format('d/m/Y H:i') : '-' }}
                                </div>
                            </div>
                            <div class="flex flex-col items-end">
                                <span class="text-base font-bold text-black dark:text-white">Quantidade:</span>
                                <span class="text-xl font-bold text-[#5FCB69] dark:text-[#5FCB69]">{{ $donation->Quantity }}</span>
                            </div>
                        </a>
                    </article>
                @endforeach
                </section>
        @endif
    </main>
</body>
</html>
