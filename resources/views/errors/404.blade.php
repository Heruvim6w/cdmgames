<!doctype html>
<html class="no-js" lang="ru">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Страница не найдена 404</title>
    <meta name="author" content="Mr_Imagined">
    <meta name="description" content="CDMgames - это команда профессионалов мирового уровня">
    <meta name="keywords"
          content="CDMgames,аккаунт,продажа аккаунтов,игры,dota,dota2,Apex Legends,wow,world of warcraft,lol,league of legends,Hearthstone,Brawl Stars"/>

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicons - Place favicon.ico in the root directory -->
    <link rel="icon" sizes="57x57" href="{{ asset('assets/img/favicons/favicon.ico') }}">
    <meta property="og:title" content="cdmgames.com">
    <meta property="og:description"
          content="CDMgames - это команда профессионалов мирового уровня">
    <meta property="og:image" content="{{ asset('assets/img/logo.webp') }}">
    <meta property="og:url" content="{{ Request::url() }}">
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <link rel="manifest" href="{{ asset('assets/img/favicons/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('assets/img/favicons/favicon.ico') }}">
    <meta name="theme-color" content="#ffffff">

    <!--==============================
    Google Fonts
    ============================== -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Tektur:wght@400;500;600;700;800;900&display=swap"
          as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet"
              href="https://fonts.googleapis.com/css2?family=Tektur:wght@400;500;600;700;800;900&display=swap">
    </noscript>

    <!--==============================
        All CSS File
    ============================== -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" async>
    <!-- Fontawesome Icon -->
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.min.css') }}" async>
    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
</head>

<body>
<style>
    body {
        background-color: #20090f;
    }

    .hero-clip-content {
        margin: 0 auto;
    }

    .vs-btn {
        margin: 0 auto;
        display: block;
        width: fit-content;
    }
</style>
<section>
    <div class="vs-carousel" id="heroSlide1" data-slide-show="1" data-md-slide-show="1" data-fade="true">
        <div class="slider">
            <div class="hero-clip-slider hero_wide" data-overlay="title" data-opacity="5">
                <div class="hero-clip-img hero_wide_img"
                     style="background-image:url({{ asset('assets/img/breadcumb/test-1.webp') }}">
                </div>
                <div class="container" style="z-index: 6;">
                    <div class="hero-clip-content">
                        <h1 class="hero-clip-title">Страница <br><span class="text-theme2">404</span> не
                            найдена</h1>
                        <a href="{{ route('home') }}" class="vs-btn">На главную</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>
