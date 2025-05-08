<script type="text/javascript">
        var gk_isXlsx = false;
        var gk_xlsxFileLookup = {};
        var gk_fileData = {};
        function filledCell(cell) {
          return cell !== '' && cell != null;
        }
        function loadFileData(filename) {
        if (gk_isXlsx && gk_xlsxFileLookup[filename]) {
            try {
                var workbook = XLSX.read(gk_fileData[filename], { type: 'base64' });
                var firstSheetName = workbook.SheetNames[0];
                var worksheet = workbook.Sheets[firstSheetName];

                // Convert sheet to JSON to filter blank rows
                var jsonData = XLSX.utils.sheet_to_json(worksheet, { header: 1, blankrows: false, defval: '' });
                // Filter out blank rows (rows where all cells are empty, null, or undefined)
                var filteredData = jsonData.filter(row => row.some(filledCell));

                // Heuristic to find the header row by ignoring rows with fewer filled cells than the next row
                var headerRowIndex = filteredData.findIndex((row, index) =>
                  row.filter(filledCell).length >= filteredData[index + 1]?.filter(filledCell).length
                );
                // Fallback
                if (headerRowIndex === -1 || headerRowIndex > 25) {
                  headerRowIndex = 0;
                }

                // Convert filtered JSON back to CSV
                var csv = XLSX.utils.aoa_to_sheet(filteredData.slice(headerRowIndex)); // Create a new sheet from filtered array of arrays
                csv = XLSX.utils.sheet_to_csv(csv, { header: 1 });
                return csv;
            } catch (e) {
                console.error(e);
                return "";
            }
        }
        return gk_fileData[filename] || "";
        }
        </script><!DOCTYPE html>
<html lang="pt-BR" class="h-full">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Criar Campanha</title>

    <!-- Tailwind via CDN (prod use: compile!) -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Fonte opcional -->
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap"
      rel="stylesheet"
    />
    <style>
      [x-cloak] {
        display: none;
      }
    </style>
  </head>
  <body class="h-full font-inter antialiased bg-gray-50">
    <!-- Container geral -->
    <div class="flex h-full items-center justify-center p-8">
      <div
        class="mx-auto flex w-full max-w-5xl overflow-hidden rounded-2xl bg-white shadow-lg"
      >
        <!-- Lado esquerdo (formulário) -->
        <div class="w-full px-10 py-12 md:w-1/2">
          <!-- Cabeçalho -->
          <div class="flex items-center justify-between">
            <svg viewBox="0 0 809 293" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-1/6">
                <g clip-path="url(#clip0_859_36)">
                <path d="M207.583 289.177H195.083L174.942 261.256C170.019 265.726 164.772 269.872 159.269 273.695C153.763 277.581 148 280.951 141.91 283.735C135.823 286.587 129.604 288.852 123.258 290.473C116.846 292.157 110.368 293 103.763 293C89.5142 293 76.0407 290.279 63.4758 284.903C50.8455 279.527 39.9014 272.077 30.4443 262.49C21.0527 252.965 13.6038 241.629 8.16316 228.544C2.72248 215.458 0.00213623 201.207 0.00213623 185.723C0.00213623 170.435 2.72248 156.184 8.16316 143.033C13.6038 129.882 21.0527 118.48 30.4443 108.893C39.9014 99.2403 50.8455 91.7274 63.4758 86.2857C76.0407 80.8441 89.5142 78.1233 103.763 78.1233C108.36 78.1233 113.026 78.5107 117.945 79.2885C122.802 80.0008 127.531 81.2971 132.131 82.9809C136.794 84.6646 141.132 86.9325 145.149 89.7188C149.228 92.5052 152.598 95.9383 155.384 99.9554V5.05419H207.586V289.179L207.583 289.177ZM155.381 185.723C155.381 178.663 154.019 171.797 151.299 165.124C148.578 158.517 144.887 152.62 140.224 147.503C135.561 142.386 130.054 138.238 123.773 135.195C117.555 132.087 110.884 130.531 103.76 130.531C96.7011 130.531 90.0298 131.762 83.746 134.289C77.5276 136.816 72.0869 140.508 67.4239 145.238C62.8264 149.967 59.1974 155.731 56.5425 162.597C53.8877 169.401 52.5261 177.173 52.5261 185.723C52.5261 193.235 53.8877 200.298 56.5425 206.971C59.1974 213.709 62.8264 219.603 67.4239 224.655C72.0869 229.706 77.5276 233.723 83.746 236.575C90.027 239.489 96.7011 240.98 103.76 240.98C110.884 240.98 117.555 239.424 123.773 236.316C130.057 233.207 135.561 229.125 140.224 224.008C144.887 218.891 148.578 212.996 151.299 206.324C154.019 199.717 155.381 192.851 155.381 185.723ZM408.088 185.723C408.088 200.945 405.367 215.068 399.927 228.153C394.486 241.239 387.103 252.575 377.711 262.099C368.385 271.686 357.373 279.202 344.808 284.706C332.243 290.214 318.707 292.997 304.262 292.997C290.013 292.997 276.54 290.211 263.975 284.706C251.345 279.199 240.401 271.686 230.944 262.099C221.552 252.578 214.103 241.242 208.662 228.153C203.222 215.068 200.501 200.945 200.501 185.723C200.501 170.304 203.222 155.99 208.662 142.839C214.103 129.688 221.552 118.352 230.944 108.765C240.401 99.2403 251.345 91.7274 263.975 86.2857C276.54 80.8441 290.013 78.1233 304.262 78.1233C318.704 78.1233 332.243 80.713 344.808 85.8327C357.373 90.9496 368.382 98.2061 377.711 107.665C387.103 117.058 394.486 128.394 399.927 141.611C405.367 154.825 408.088 169.532 408.088 185.725V185.723ZM355.886 185.723C355.886 177.366 354.524 169.851 351.804 163.05C349.083 156.312 345.392 150.483 340.729 145.625C336.066 140.702 330.559 137.01 324.278 134.42C318.06 131.827 311.389 130.534 304.265 130.534C297.206 130.534 290.535 131.83 284.251 134.42C278.033 137.01 272.592 140.702 267.929 145.625C263.331 150.483 259.702 156.315 257.047 163.05C254.393 169.853 253.031 177.366 253.031 185.723C253.031 193.56 254.393 200.882 257.047 207.555C259.702 214.293 263.331 220.122 267.929 225.045C272.592 229.968 278.033 233.854 284.251 236.706C290.532 239.558 297.206 240.982 304.265 240.982C311.389 240.982 318.06 239.621 324.278 236.965C330.562 234.31 336.066 230.618 340.729 225.76C345.392 220.965 349.083 215.136 351.804 208.335C354.524 201.469 355.886 193.953 355.886 185.728V185.723ZM482.232 239.424C484.24 240.074 486.248 240.527 488.319 240.655C490.328 240.848 492.336 240.98 494.341 240.98C499.394 240.98 504.317 240.267 508.98 238.905C513.643 237.481 518.047 235.472 522.128 232.883C526.273 230.29 529.965 227.116 533.138 223.424C536.377 219.666 539.032 215.521 541.04 210.985L578.994 249.139C574.2 255.943 568.631 262.097 562.412 267.538C556.128 272.98 549.329 277.578 542.074 281.402C534.819 285.159 527.176 288.074 519.146 290.017C511.116 291.96 502.824 292.997 494.338 292.997C480.09 292.997 466.616 290.342 454.052 285.028C441.421 279.718 430.412 272.268 421.02 262.809C411.563 253.285 404.18 242.014 398.739 228.928C393.298 215.843 390.578 201.461 390.578 185.72C390.578 169.654 393.298 155.013 398.739 141.734C404.18 128.454 411.563 117.118 421.02 107.725C430.412 98.397 441.421 91.0778 454.052 85.8926C466.616 80.7102 480.087 78.1204 494.338 78.1204C502.824 78.1204 511.113 79.1575 519.209 81.166C527.304 83.1746 535.012 86.0892 542.268 89.9126C549.523 93.6704 556.322 98.3343 562.669 103.839C569.015 109.346 574.587 115.5 579.378 122.366L482.226 239.424H482.232ZM508.786 132.602C506.39 131.696 503.992 131.178 501.662 130.919C499.329 130.659 496.871 130.531 494.344 130.531C487.285 130.531 480.614 131.827 474.33 134.417C468.112 137.007 462.671 140.699 458.008 145.494C453.411 150.286 449.782 156.118 447.127 162.853C444.472 169.657 443.11 177.235 443.11 185.72C443.11 187.663 443.241 189.802 443.435 192.198C443.629 194.594 443.888 197.056 444.344 199.518C444.797 201.979 445.315 204.31 445.962 206.643C446.608 208.911 447.451 210.919 448.423 212.666L508.789 132.6L508.786 132.602Z" fill="#2AB036"/>
                <path d="M651.699 34.5274C651.699 39.3195 650.794 43.7896 648.979 48.0005C647.102 52.1458 644.641 55.7726 641.467 58.8838C638.294 61.9921 634.603 64.4536 630.327 66.2685C626.117 68.146 621.582 69.0548 616.791 69.0548C611.999 69.0548 607.465 68.1488 603.254 66.2685C598.979 64.4565 595.287 61.9921 592.245 58.8838C589.137 55.7726 586.676 52.1458 584.796 48.0005C582.984 43.7896 582.076 39.3195 582.076 34.5274C582.076 29.798 582.981 25.3934 584.796 21.117C586.673 16.9062 589.137 13.2138 592.245 10.1055C595.29 6.99723 598.982 4.53566 603.254 2.72083C607.465 0.905999 611.999 7.62939e-06 616.791 7.62939e-06C621.582 7.62939e-06 626.117 0.905999 630.327 2.72083C634.603 4.53281 638.294 6.99723 641.467 10.1055C644.641 13.2167 647.102 16.909 648.979 21.117C650.794 25.3934 651.699 29.798 651.699 34.5274ZM642.761 292.997H590.621V89.7188H642.761V292.997ZM769.748 292.997C757.249 292.997 745.459 290.601 734.449 285.872C723.44 281.142 713.789 274.601 705.497 266.307C697.207 258.017 690.73 248.364 685.936 237.415C681.207 226.404 678.874 214.615 678.874 202.11V141.736H653.614V90.1063H678.874V8.87189H730.495V90.1063H808.995V141.736H730.495V202.11C730.495 207.552 731.467 212.603 733.475 217.398C735.546 222.127 738.332 226.273 741.83 229.771C745.393 233.336 749.538 236.185 754.394 238.259C759.189 240.333 764.304 241.367 769.745 241.367H808.995V292.997H769.745H769.748Z" fill="#FF5800"/>
                </g>
                <defs>
                <clipPath id="clip0_859_36">
                <rect width="809" height="293" fill="white"/>
                </clipPath>
                </defs>
                </svg>
          </div>

          <!-- Barra de etapas -->
          <nav class="mt-8 flex items-center space-x-2 text-sm font-medium">
            <span
              class="flex h-6 w-6 items-center justify-center rounded-full bg-[#2AB036] text-white"
              id="stepNumber1"
              >1</span
            >
            <span class="text-gray-700" id="stepText1"
              >Informações Iniciais</span
            >
            <span class="text-gray-400">›</span>
            <span
              class="flex h-6 w-6 items-center justify-center rounded-full border border-gray-300 text-gray-400"
              id="stepNumber2"
              >2</span
            >
            <span class="text-gray-400" id="stepText2">Localização</span>
            <span class="text-gray-400">›</span>
            <span
              class="flex h-6 w-6 items-center justify-center rounded-full border border-gray-300 text-gray-400"
              id="stepNumber3"
              >3</span
            >
            <span class="text-gray-400" id="stepText3">Tipo e Meta</span>
          </nav>

          <!-- Formulário -->
          <form
            class="mt-10 space-y-6"
            action="/campaign"
            method="POST"
            id="formEtapas"
            enctype="multipart/form-data"
          >
                        @csrf
            <div id="1">
              <div>
                <label
                  for="Title"
                  class="block text-sm font-medium text-gray-700"
                  >Título</label
                >
                <input
                  id="Title"
                  name="Title"
                  type="text"
                  placeholder="Titulo da Campanha"
                  class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2"
                  required
                />
                @error("Title")
                    @include('layouts.error_popup')
                @enderror
              </div>

              <div>
                <label
                  for="Description"
                  class="block text-sm font-medium text-gray-700"
                  >Descrição</label
                >
                <textarea
                  name="Description"
                  id="Description"
                  class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2"
                  rows="3"
                  placeholder="Descrição da campanha"
                  required
                ></textarea>
                @error("Description")
                    @include('layouts.error_popup')
                @enderror

              </div>

              <div>
                <label
                  for="Data"
                  class="block text-sm font-medium text-gray-700"
                  >Data da Coleta</label
                >
                <input
                  id="Data"
                  name="Data"
                  type="date"
                  class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2"
                  required
                />
                @error("Data")
                    @include('layouts.error_popup')
                @enderror

              </div>

              <div>
                <label
                  for="Hour"
                  class="block text-sm font-medium text-gray-700"
                  >Hora</label
                >
                <input
                  id="Hour"
                  name="Hour"
                  type="time"
                  placeholder="00:00"
                  required
                  class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2"
                />
                @error("Hour")
                    @include('layouts.error_popup')
                @enderror

              </div>
              <button
                type="button"
                onclick="proximaEtapa(1)"
                class="mt-4 w-full rounded-md bg-[#2AB036] py-3 text-center text-sm font-semibold text-white transition hover:bg-[#575761] focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
              >
                Continuar
              </button>
            </div>

            <div id="2" class="hidden">
              <div>
                <label for="City" class="block text-sm font-medium text-gray-700"
                  >Cidade</label
                >
                <select
                  id="City"
                  name="City"
                  class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2 bg-white"
                  required
                >
                  <option value="São Miguel">São Miguel</option>
                  <option value="Pereiro">Pereiro</option>
                </select>
                @error("City")
                    @include('layouts.error_popup')
                @enderror

              </div>

              <div>
                <label
                  for="State"
                  class="block text-sm font-medium text-gray-700 mt-2"
                  >Estado</label
                >
                <input
                  id="State"
                  name="State"
                  required
                  type="text"
                  class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2"
                />
                @error("State")
                    @include('layouts.error_popup')
                @enderror

              </div>

              <div>
                <label
                  for="Street"
                  class="block text-sm font-medium text-gray-700 mt-2"
                  >Rua</label
                >
                <input
                  id="Street"
                  name="Street"
                  required
                  type="text"
                  class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2"
                />
                @error("Street")
                    @include('layouts.error_popup')
                @enderror

              </div>

                <div>
                <label
                  for="CEP"
                  class="block text-sm font-medium text-gray-700 mt-2"
                  >CEP</label
                >
                <input
                  id="CEP"
                  name="CEP"
                  required
                  type="text"
                  class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2"
                />
                @error("CEP")
                    @include('layouts.error_popup')
                @enderror

              </div>

            <div>
                <label
                  for="Number"
                  class="block text-sm font-medium text-gray-700 mt-2"
                  >Num. do Resinto</label
                >
                <input
                  id="Number"
                  name="Number"
                  required
                  type="text"
                  class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2"
                />
                @error("Number")
                    @include('layouts.error_popup')
                @enderror

              </div>

              <div
                class="flex flex-row gap-6 justify-between items-center mt-4 px-4"
              >
                <button type="button" onclick="voltarEtapa(2)" class="text-gray-400">
                  Voltar
                </button>
                <button
                  type="button"
                  onclick="proximaEtapa(2)"
                  class="mt-4 w-full rounded-md bg-[#2AB036] py-3 text-center text-sm font-semibold text-white transition hover:bg-[#575761] focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                  Continuar
                </button>
              </div>
            </div>
            <div id="3" class="hidden">
                  <div>
                    <label
                      for="Meta"
                      class="block text-sm font-medium text-gray-700 mt-2"
                      >Meta</label
                    >
                    <input
                      id="Meta"
                      name="meta"
                      required
                      type="number"
                    min="1"
                    max="500"
                      placeholder="Ex: 100 kg"
                      class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2"
                    />
                @error("meta")
                    @include('layouts.error_popup')
                @enderror
                <div>
                  <label for="image" class="block text-sm text-gray-500">Image</label>
                  <input type="file" class="block w-full px-3 py-2 mt-2 text-sm text-gray-600 bg-white border border-gray-200 rounded-lg file:bg-gray-200 file:text-gray-700 file:text-sm file:px-4 file:py-1 file:border-none file:rounded-full placeholder-gray-400/70 focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40" accept=".jpeg, .jpg, .png" name="Image">
                </div>
                  </div>
                <div>
            </div>
              <div
                class="flex flex-row gap-6 justify-between items-center mt-4 px-4"
              >
                <button type="button" onclick="voltarEtapa(3)" class="text-gray-400">
                  Voltar
                </button>
                <button
                  type="submit"
                  onclick="submitForm()"
                  class="w-full rounded-md bg-[#2AB036] py-3 text-center text-sm font-semibold text-white transition hover:bg-[#575761]"
                >
                  Finalizar
                </button>
              </div>
            </div>
          </form>

          <!-- Links de rodapé -->
          <p class="mt-10 text-center text-xs text-gray-400">
            <a href="#" class="hover:underline">Termos de serviço</a> •
            <a href="#" class="hover:underline">Política de privacidade</a>
          </p>
        </div>

        <!-- Lado direito (ilustração) – oculto em telas menores -->
        <div class="hidden bg-[#2AB036] md:block md:w-1/2">
          <div class="flex h-full items-center justify-center">
            <svg width="335" height="290" viewBox="0 0 335 290" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M173.014 131.95V127.95H172.943L172.872 127.953L173.014 131.95ZM144.319 174.649C143.037 172.85 140.54 172.43 138.74 173.712C136.941 174.993 136.521 177.491 137.803 179.29L144.319 174.649ZM233.303 140.902V136.902H232.92L232.543 136.975L233.303 140.902ZM278.682 170.96L275.19 172.911L278.682 170.96ZM102.672 208.106L98.6724 208.105L98.672 210.808L101.18 211.817L102.672 208.106ZM102.687 110.026L103.281 106.07L98.6877 105.38L98.687 110.025L102.687 110.026ZM92.5608 108.048L96.5547 107.827L96.5486 107.717L96.5365 107.607L92.5608 108.048ZM92.6283 109.268H96.6283V109.157L96.6222 109.047L92.6283 109.268ZM179.509 41.5521L182.406 38.7942L182.405 38.7923L179.509 41.5521ZM183.059 45.2814L180.162 48.0393L183.057 51.0806L185.954 48.0414L183.059 45.2814ZM186.614 41.5521L189.51 44.3121L189.51 44.312L186.614 41.5521ZM222.141 78.8218L225.036 81.5816L225.036 81.5816L222.141 78.8218ZM183.062 119.819L180.167 122.579L183.062 125.616L185.958 122.579L183.062 119.819ZM143.984 78.8218L146.879 76.0619L146.879 76.0619L143.984 78.8218ZM143.984 41.5521L146.879 44.312L146.879 44.312L143.984 41.5521ZM202.601 99.3202L199.706 96.5603V96.5604L202.601 99.3202ZM133.588 128.167C136.629 130.682 140.79 132.273 144.896 133.337C149.083 134.422 153.629 135.062 157.766 135.441C161.919 135.822 165.751 135.948 168.54 135.98C169.937 135.996 171.08 135.988 171.878 135.976C172.277 135.97 172.59 135.963 172.807 135.958C172.916 135.955 173 135.952 173.059 135.951C173.088 135.95 173.111 135.949 173.127 135.948C173.135 135.948 173.142 135.948 173.147 135.948C173.149 135.948 173.151 135.948 173.153 135.948C173.154 135.948 173.155 135.948 173.155 135.947C173.156 135.947 173.157 135.947 173.014 131.95C172.872 127.953 172.872 127.952 172.873 127.952C172.873 127.952 172.873 127.952 172.873 127.952C172.873 127.952 172.872 127.952 172.871 127.953C172.87 127.953 172.866 127.953 172.861 127.953C172.851 127.953 172.835 127.954 172.812 127.954C172.766 127.956 172.696 127.958 172.601 127.96C172.412 127.965 172.128 127.972 171.759 127.977C171.022 127.988 169.95 127.995 168.631 127.98C165.988 127.95 162.378 127.83 158.497 127.474C154.6 127.117 150.519 126.53 146.903 125.593C143.206 124.635 140.386 123.407 138.686 122.002L133.588 128.167ZM173.014 135.95C184.362 135.95 196.18 141.058 204.94 149.186C213.695 157.31 218.994 168.049 218.152 179.082L226.129 179.691C227.202 165.619 220.424 152.64 210.381 143.322C200.342 134.007 186.639 127.95 173.014 127.95V135.95ZM218.152 179.082C217.999 181.093 217.184 182.535 215.769 183.705C214.238 184.971 211.866 186.017 208.575 186.701C201.971 188.074 192.928 187.743 183.395 186.348C173.941 184.964 164.37 182.589 156.883 180.13C153.135 178.899 149.982 177.67 147.663 176.568C146.5 176.015 145.613 175.525 144.989 175.117C144.285 174.657 144.201 174.483 144.319 174.649L137.803 179.29C138.565 180.361 139.663 181.193 140.611 181.813C141.638 182.485 142.871 183.148 144.229 183.793C146.95 185.087 150.441 186.434 154.386 187.73C162.285 190.325 172.303 192.809 182.236 194.263C192.089 195.706 202.23 196.192 210.203 194.534C214.2 193.703 217.964 192.271 220.868 189.87C223.887 187.372 225.804 183.956 226.129 179.691L218.152 179.082ZM208.073 149.861L234.064 144.829L232.543 136.975L206.552 142.007L208.073 149.861ZM233.303 144.902C251.452 144.902 265.315 155.243 275.19 172.911L282.174 169.008C271.35 149.642 255.192 136.902 233.303 136.902V144.902ZM275.19 172.911C277.727 177.45 278.602 181.333 278.411 184.66C278.222 187.968 276.96 191.063 274.651 194.018C269.907 200.09 260.947 205.294 249.252 209.478C226.021 217.79 194.456 221.233 173.014 221.233V229.233C195 229.233 227.557 225.737 251.947 217.011C264.063 212.676 274.788 206.836 280.955 198.944C284.101 194.918 286.101 190.301 286.398 185.118C286.694 179.954 285.281 174.568 282.174 169.008L275.19 172.911ZM173.014 221.233C159.77 221.233 142.665 217.108 128.599 212.842C121.625 210.726 115.503 208.609 111.125 207.021C108.938 206.228 107.189 205.568 105.992 205.108C105.393 204.878 104.932 204.697 104.622 204.576C104.468 204.515 104.351 204.469 104.274 204.438C104.236 204.423 104.207 204.411 104.189 204.404C104.18 204.4 104.173 204.398 104.169 204.396C104.167 204.395 104.166 204.395 104.165 204.394C104.165 204.394 104.165 204.394 104.164 204.394C104.164 204.394 104.165 204.394 102.672 208.106C101.18 211.817 101.181 211.817 101.181 211.817C101.182 211.817 101.183 211.818 101.184 211.818C101.186 211.819 101.188 211.82 101.191 211.821C101.197 211.824 101.206 211.827 101.218 211.832C101.241 211.841 101.274 211.854 101.317 211.871C101.403 211.905 101.529 211.955 101.693 212.02C102.021 212.149 102.502 212.337 103.122 212.575C104.362 213.052 106.158 213.73 108.398 214.542C112.874 216.166 119.135 218.331 126.277 220.497C140.446 224.795 158.512 229.233 173.014 229.233V221.233ZM106.672 208.106L106.687 110.026L98.687 110.025L98.6724 208.105L106.672 208.106ZM102.093 113.981C113.855 115.749 124.639 120.766 133.588 128.167L138.686 122.002C128.671 113.719 116.55 108.064 103.281 106.07L102.093 113.981ZM82.5801 102.736C85.5215 102.736 88.2094 105.095 88.5851 108.488L96.5365 107.607C95.7512 100.515 89.945 94.7355 82.5801 94.7355V102.736ZM88.5669 108.269L88.6344 109.489L96.6222 109.047L96.5547 107.827L88.5669 108.269ZM88.6283 109.268V204.15H96.6283V109.268H88.6283ZM88.6283 204.15C88.6283 207.946 85.7421 210.692 82.5801 210.692V218.692C90.5172 218.692 96.6283 211.999 96.6283 204.15H88.6283ZM82.5801 210.692H62.4837V218.692H82.5801V210.692ZM62.4837 210.692C59.3219 210.692 56.4355 207.946 56.4355 204.15H48.4355C48.4355 211.999 54.5468 218.692 62.4837 218.692V210.692ZM56.4355 204.15V109.277H48.4355V204.15H56.4355ZM56.4355 109.277C56.4355 105.481 59.322 102.736 62.4837 102.736V94.7355C54.5467 94.7355 48.4355 101.429 48.4355 109.277H56.4355ZM62.4837 102.736H82.5801V94.7355H62.4837V102.736ZM176.612 44.3101L180.162 48.0393L185.956 42.5234L182.406 38.7942L176.612 44.3101ZM185.954 48.0414L189.51 44.3121L183.719 38.7921L180.164 42.5214L185.954 48.0414ZM189.51 44.312C197.744 35.6738 211.011 35.6738 219.245 44.312L225.036 38.7923C213.65 26.847 195.105 26.847 183.719 38.7923L189.51 44.312ZM219.245 44.312C227.583 53.0586 227.583 67.3153 219.245 76.0619L225.036 81.5816C236.319 69.7447 236.319 50.6291 225.036 38.7923L219.245 44.312ZM185.958 117.059L146.879 76.0619L141.088 81.5816L180.167 122.579L185.958 117.059ZM146.879 76.0619C138.542 67.3153 138.542 53.0586 146.879 44.312L141.089 38.7922C129.805 50.6291 129.805 69.7448 141.089 81.5817L146.879 76.0619ZM146.879 44.312C155.113 35.6738 168.38 35.6738 176.614 44.312L182.405 38.7923C171.018 26.847 152.475 26.847 141.088 38.7923L146.879 44.312ZM219.245 76.0619L199.706 96.5603L205.497 102.08L225.036 81.5816L219.245 76.0619ZM199.706 96.5604L180.167 117.059L185.958 122.579L205.497 102.08L199.706 96.5604Z" fill="white"/>
                </svg>
          </div>
        </div>
      </div>
    </div>

    <script>
      let currentStep = 1;

      function proximaEtapa(step) {
        if (step === 1) {
          document.getElementById("1").classList.add("hidden");
          document.getElementById("2").classList.remove("hidden");

          document.getElementById("stepText1").classList.remove("text-gray-700");
          document.getElementById("stepText1").classList.add("text-gray-400");

          document.getElementById("stepNumber1").classList.remove("bg-[#2AB036]");
          document.getElementById("stepNumber1").classList.add("border", "border-gray-300", "text-gray-400");

          document.getElementById("stepText2").classList.remove("text-gray-400");
          document.getElementById("stepText2").classList.add("text-gray-700");

          document.getElementById("stepNumber2").classList.remove("border", "border-gray-300", "text-gray-400");
          document.getElementById("stepNumber2").classList.add("text-white", "bg-[#2AB036]");

          currentStep = 2;
        } else if (step === 2) {
          document.getElementById("2").classList.add("hidden");
          document.getElementById("3").classList.remove("hidden");

          document.getElementById("stepText2").classList.remove("text-gray-700");
          document.getElementById("stepText2").classList.add("text-gray-400");

          document.getElementById("stepNumber2").classList.remove("bg-[#2AB036]");
          document.getElementById("stepNumber2").classList.add("border", "border-gray-300", "text-gray-400");

          document.getElementById("stepText3").classList.remove("text-gray-400");
          document.getElementById("stepText3").classList.add("text-gray-700");

          document.getElementById("stepNumber3").classList.remove("border", "border-gray-300", "text-gray-400");
          document.getElementById("stepNumber3").classList.add("text-white", "bg-[#2AB036]");

          currentStep = 3;
        }
      }

      function voltarEtapa(step) {
        if (step === 2) {
          document.getElementById("2").classList.add("hidden");
          document.getElementById("1").classList.remove("hidden");

          document.getElementById("stepText2").classList.remove("text-gray-700");
          document.getElementById("stepText2").classList.add("text-gray-400");

          document.getElementById("stepNumber2").classList.remove("text-white", "bg-[#2AB036]");
          document.getElementById("stepNumber2").classList.add("border", "border-gray-300", "text-gray-400");

          document.getElementById("stepText1").classList.remove("text-gray-400");
          document.getElementById("stepText1").classList.add("text-gray-700");

          document.getElementById("stepNumber1").classList.remove("border", "border-gray-300", "text-gray-400");
          document.getElementById("stepNumber1").classList.add("text-white", "bg-[#2AB036]");

          currentStep = 1;
        } else if (step === 3) {
          document.getElementById("3").classList.add("hidden");
          document.getElementById("2").classList.remove("hidden");

          document.getElementById("stepText3").classList.remove("text-gray-700");
          document.getElementById("stepText3").classList.add("text-gray-400");

          document.getElementById("stepNumber3").classList.remove("text-white", "bg-[#2AB036]");
          document.getElementById("stepNumber3").classList.add("border", "border-gray-300", "text-gray-400");

          document.getElementById("stepText2").classList.remove("text-gray-400");
          document.getElementById("stepText2").classList.add("text-gray-700");

          document.getElementById("stepNumber2").classList.remove("border", "border-gray-300", "text-gray-400");
          document.getElementById("stepNumber2").classList.add("text-white", "bg-[#2AB036]");

          currentStep = 2;
        }
      }

      document.getElementById("formEtapas").addEventListener("submit", (e) => {
        e.preventDefault();
      });

      function submitForm() {
        document.getElementById("formEtapas").submit();
      }
    </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
    <script>
        $(document).ready(function() {
            $('#CEP').mask('00000-000');
        });

        $(document).ready(function() {
            $('#City').change(function() {
                if ($(this).val() == "São Miguel") {
                    $('#State').val('Rio Grande do Norte');
                } else if ($(this).val() == "Pereiro") {
                    $('#State').val('Ceará');
                }
            });

            $('#State').change(function() {
                if ($(this).val() == "Rio Grande do Norte") {
                    $('#City').val('São Miguel');
                } else if ($(this).val() == "Ceará") {
                    $('#City').val('Pereiro');
                }
            });
        });
    </script>
  </body>
</html>
