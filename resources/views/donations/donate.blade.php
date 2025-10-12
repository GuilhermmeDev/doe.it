<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doação - {{$campaign->Title}}</title>
 <link rel="icon" href="{{ asset('assets/favicon.svg') }}" type="image/x-icon" />
    <script defer src="js/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class=" bg-white dark:bg-neutral-900 overflow-x-hidden">
    @include('layouts.secondary_navbar')

  <main class="bg-white dark:bg-neutral-900">
    <div class="max-w-screen-xl mx-auto px-4 md:px-8">
      <div class="max-w-lg mx-auto gap-12 justify-between lg:flex lg:max-w-none mb-4">
        <section class="max-w-lg space-y-3 bg-white dark:bg-neutral-800 rounded-lg p-6 mt-4">
          <h1 class="text-[#2AB036] text-3xl font-semibold sm:text-4xl">
            Doar para a campanha
          </h1>
          <p class="font-semibold text-xl text-gray-900 dark:text-gray-100">
            Meta: {{$campaign->meta['target']}}
          </p>
          <p class="font-semibold text-xl text-gray-900 dark:text-gray-100">
            Arrecadado: {{$campaign->meta['current']}}
          </p>
          <br>
          <img src="{{asset('assets/doodle_group.svg')}}" alt="">
          <div>
            <ul class="mt-6 flex flex-wrap gap-x-10 gap-y-6 items-center">
              <template x-for="(item, index) in contactMethods" :key="index">
                <li class="flex items-center gap-x-3">
                  <div class="flex-none text-gray-400 dark:text-gray-300" x-html="item.icon"></div>
                  <p class="text-gray-500 dark:text-gray-300" x-text="item.contact"></p>
                </li>
              </template>
            </ul>
          </div>
        </section>
        <section class="flex-1 mt-12 sm:max-w-lg lg:max-w-md bg-white dark:bg-neutral-800 rounded-lg p-6">
            <form method="POST" action="/donation/{{$campaign->id}}" class="space-y-8">
            @csrf
            <div class="mb-10 mt-8">
              <label class="font-medium text-gray-900 dark:text-gray-100"> {{$campaign->Type=='food' ? 'Quantos kg de comida você pretende doar?' : 'Quantas unidades de roupa você pretende doar?'}} </label>
              <input
                type="number"
                required
                class="w-full mt-2 px-3 py-2 text-gray-500 dark:text-gray-300 bg-transparent outline-none border border-gray-300 dark:border-neutral-600 focus:border-indigo-600 shadow-sm rounded-lg"
                name="Quantity" id="Quantity" min="1" max="{{$campaign->meta['target'] - $campaign->meta['current']}}"
              />
            </div>

            <div>
              <label class="font-medium text-gray-900 dark:text-gray-100">Descrição</label>
              <textarea
                name="Description"
                class="w-full mt-2 h-36 px-3 py-2 resize-none appearance-none bg-transparent outline-none border border-gray-300 dark:border-neutral-600 focus:border-indigo-600 shadow-sm rounded-lg text-gray-500 dark:text-gray-300"
              ></textarea>
            </div>
            <div class="text-sm text-center text-gray-500 dark:text-gray-300">
            </div>
            <div class="pb-5">
            <button
            type="submit"
              class="w-full px-4 py-2 text-white font-medium bg-[#5FCB69] hover:bg-[#357E3C] active:bg-indigo-600 rounded-lg duration-150"
            >
              Fazer Doação
            </button>
            </div>
          </form>
        </section>
      </div>
    </div>
  </main>

</body>
</html>
