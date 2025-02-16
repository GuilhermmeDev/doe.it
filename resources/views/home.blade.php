<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
    <title>Home</title>
    @include('layouts.head')
</head>
<body>
    @include('layouts.navbar')
    @if (session('error'))
        {{session('error')}}<br>
    @endif

    @if (session('Success'))
        <p style="background-color: green; color: white; padding: 8px; border-radius: 16px; ">{{session('Success')}}</p>
    @endif


    @if ($search)
        <p>Procurando campanha: {{$search}}</p>
    @endif

    @if (count($campaigns) === 0)
        <p>Nenhuma campanha disponível</p>
    @endif
    <div class="container-slide">
        <h1 class="titulo_section">Campanhas</h1>

        <div #swiperRef="" class="swiper mySwiper">
            <div class="swiper-wrapper">

                @foreach($campaigns as $camp)
                    <div class="swiper-slide slide">
                        <a href="/campaign/{{$camp->id}}" class="ancor_book">
                            <div class="container_book">
                                <div class="container_img_book">
                                    <img src="img/campaigns/{{$camp->Image}}" class="img_book">
                                </div>
                                <div class="info_book">
                                    <p class="author_book">{{$camp->Title}}</p>
                                    <div class="title_star">
                                        <h6 class="title_book">{{$camp->Description}}</h6>
                                            <div class="progress-container">
                                                <span class="progress-text">{{$progress = round(100 * ($progress = $camp->meta['current'] / $camp->meta['target']), 1)}}%</span>
                                                <div class="progress-bar-container">
                                                    <div class="progress-bar" style="width: {{$progress}}%;"></div>
                                                </div>
                                            </div>
                                            <button class="saibamais">Saiba mais</button>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
                
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="{{asset('js/home.js')}}"></script>
</body>
</html>