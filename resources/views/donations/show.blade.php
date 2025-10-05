<!DOCTYPE html>
<html lang="pt-BR" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code - {{$donation->campaign->Title}}</title>
    <link rel="icon" href="{{ asset('assets/logo1.svg') }}" type="image/x-icon"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white dark:bg-[#1E1E21] text-[#1E1E21] dark:text-[#E0E0E0] flex flex-col items-center min-h-screen">
    
    @include('layouts.secondary_navbar')

    <main class="container mx-auto max-w-full flex flex-col md:flex-row gap-8 p-6 items-center md:items-start justify-center">
        
        <section class="flex-1 text-left max-w-lg md:max-w-2xl w-full">
            <h1 class="text-2xl font-bold text-[#2AB036] mb-3">Campanha: {{$donation->campaign->Title}}</h1>
            
            <p class="text-lg font-semibold text-[#1E1E21] dark:text-[#E0E0E0] mb-1">ID {{$donation->id}}</p>
            
            <p class="font-semibold mb-2">Descrição</p>
            
            <textarea class="w-full min-h-[120px] p-3 rounded-md border border-[#73737F] bg-white dark:bg-[#1E1E21] dark:border-[#73737F] text-md resize-none mb-4" readonly>{{$donation->Description ? $donation->Description : 'Sem descrição informada'}}
            </textarea>

            <form action="/donation/{{$donation->id}}" method="post" class="mt-2 text-center md:text-left">
                @csrf
                @method('DELETE')
                <button 
                    class="w-full max-w-xs px-4 py-2 rounded-md bg-[#2AB036] text-white font-medium transition hover:bg-[#228c2b]" 
                    type="submit">
                    Cancelar doação
                </button>
            </form>
        </section>

        <!-- QR CODE -->
        <section class="flex-1 flex flex-col items-center justify-center w-full md:w-auto max-w-xs space-y-4">
            <div class="flex items-center justify-center w-[250px] h-[250px] bg-[#2AB036] rounded-xl shadow-md">
                <img src="data:image/png;base64, {{$donation->qr_code}}" alt="QR CODE" class="max-h-[80%] max-w-[80%]" id="qrImage">
            </div>
            <button id="downloadBtn" class="mt-2 px-4 py-2 bg-[#ff5800] text-white rounded-md">Baixar QR Code</button>
        </section>
    </main>

    <script>
        document.getElementById('downloadBtn').addEventListener('click', function () {
            const img = document.getElementById('qrImage');
            const canvas = document.createElement('canvas');
            const size = 300;
            canvas.width = size;
            canvas.height = size;
            const ctx = canvas.getContext('2d');

            ctx.fillStyle = '#ffffff';
            ctx.fillRect(0, 0, size, size);

            ctx.drawImage(img, 20, 20, size-40, size-40);

            const link = document.createElement('a');
            link.download = 'qrcode.png';
            link.href = canvas.toDataURL('image/png');
            link.click();
        });
    </script>
    <script>
        window.onload=function() {
            Echo.private(`donation.{{$donation->id}}`)
            .listen('ConfirmDonation', (e) => {
                console.log("Donation confirmed");
                window.location.reload(true);
            });
        }
    </script>
</body>
</html>
