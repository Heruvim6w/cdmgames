<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>CDMgames - это команда профессионалов мирового уровня</title>
    <meta name="author" content="Angfuzsoft">
    <meta name="description" content="CDMgames - это команда профессионалов мирового уровня">
    <meta name="keywords" content="CDMgames - это команда профессионалов мирового уровня" />
    <meta name="robots" content="NOINDEX,NOFOLLOW">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicons - Place favicon.ico in the root directory -->
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('storage/assets/img/favicons/apple-icon-57x57.png') }}">
    <link rel="manifest" href="{{ asset('storage/assets/favicons/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('storage/assets/img/favicons/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">

    <!--==============================
	  Google Fonts
	============================== -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&family=Rajdhani:wght@300;400;500;600;700&display=swap" rel="stylesheet">


    <!--==============================
	    All CSS File
	============================== -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('storage/assets/css/bootstrap.min.css') }}">
    <!-- Fontawesome Icon -->
    <link rel="stylesheet" href="{{ asset('storage/assets/css/fontawesome.min.css') }}">
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="{{ asset('storage/assets/css/magnific-popup.min.css') }}">
    <!-- Slick Slider -->
    <link rel="stylesheet" href="{{ asset('storage/assets/css/slick.min.css') }}">
    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="{{ asset('storage/assets/css/style.css') }}">

</head>

<body>


@include('layouts.preloader')
@include('layouts.mobile_menu')
<!--==============================
    Header Area
==============================-->
<header class="vs-header header-layout1">
    <div class="sticky-wrapper">
        <div class="sticky-active">
            <!-- Main Menu Area -->
            <div class="header-inner">
                <div class="container">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto">
                            <div class="header-logo py-3 py-lg-0">
                                @include('layouts.logo')
                            </div>
                        </div>
                        <div class="col-auto offset-xxl-1">
                            @include('layouts.main_menu')
                        </div>
                        <div class="col-auto offset-xxl-1 d-none d-lg-block">
                            <div class="header-button ">
                                <ul>
                                    <li>
                                        <a href="mailto:support@cdmdoto.com" class="header-number"><i class="fal fa-at"></i>support@cdmdoto.com</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!--==============================
  Hero Area
==============================-->
<section class="vs-hero-wrapper position-relative bg-dark">
    <div class="hero-social d-none d-lg-block">
        <a href="https://vk.com/cdmgames"><span>vk</span>.com</a>
    </div>

    <div class="vs-carousel" id="heroSlide1" data-slide-show="1" data-md-slide-show="1" data-fade="true">
        <div class="slider">
            <div class="hero-clip-slider hero_wide" data-overlay="title" data-opacity="5">
                <div class="hero-clip-img hero_wide_img" data-bg-src="{{ asset('storage/assets/img/breadcumb/hero-5-1.jpg') }}"></div>
                <div class="hero-clip-shape bg-theme2"></div>
                <div class="container" style="z-index: 6;">
                    <div class="row">
                        <div class="col-sm-8 col-xxl-6 offset-xl-1">
                            <div class="hero-clip-content">
                                <h1 class="hero-clip-title" data-ani="slideindown" data-ani-delay="0.2s">Welcome to <span class="text-theme2">CDM</span> gaming zone</h1>
                                <a href="{{ route('about') }}" class="vs-btn" data-ani="slideinup" data-ani-delay="0.2s">Read More<i class="fal fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--==============================
Features Area
==============================-->
<section class="vs-features-wrap space-top space-extra-bottom">
    <div class="parallax " data-bg-class="bg-dark" data-parallax-image="{{ asset('storage/assets/img/shape/features-shape.png') }}"></div>
    <div class="container">
        <div class="title-area text-center text-xl-start">
            <span class="sub-title">#Добро пожаловать к лучшим</span>
            <h2 class="sec-title text-white">Мы знаем своё дело</h2>
            <h2 class="sec-title-style2">CDMgames!</h2>
            <div class="sec-shape">
                <div class="sec-shape_bar"></div>
                <div class="sec-shape_bar"></div>
                <div class="sec-shape_bar"></div>
            </div>
        </div>
        <div class="row justify-content-lg-around justify-content-xl-between gy-3 text-center text-xl-start">
{{--            <div class="col-sm-6 col-xl-3 col-xxl-auto">--}}
{{--                <div class="features-box mb-25">--}}
{{--                    <div class="features-box_icon">--}}
{{--                        <img src="{{ asset('storage/assets/img/icon/features-icon-1-1.png') }}" alt="Features Icon">--}}
{{--                    </div>--}}
{{--                    <span class="features-box_label text-theme2">Over watch</span>--}}
{{--                    <h3 class="features-box_title text-white">Live Streaming</h3>--}}
{{--                    <p class="features-box_text text-light-white">Praesent a ornare metus. Etiam luctus arcu a neque venenatis, quis hendrerit mi maximus. </p>--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="col-sm-6 col-xl-3 col-xxl-auto">
                <div class="features-box mb-25">
                    <div class="features-box_icon">
                        <img src="{{ asset('storage/assets/img/icon/features-icon-1-2.png') }}" alt="Features Icon">
                    </div>
                    <span class="features-box_label text-theme2">Количество</span>
                    <h3 class="features-box_title text-white">Много игр</h3>
                    <p class="features-box_text text-light-white">Список игр постоянно пополняется</p>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3 col-xxl-auto">
                <div class="features-box mb-25">
                    <div class="features-box_icon">
                        <img src="{{ asset('storage/assets/img/icon/features-icon-1-3.png') }}" alt="Features Icon">
                    </div>
                    <span class="features-box_label text-theme2">Качество</span>
                    <h3 class="features-box_title text-white">Команда профессионлов</h3>
                    <p class="features-box_text text-light-white">В нашей команде только проеренные и опытные геймеры</p>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3 col-xxl-auto">
                <div class="features-box mb-25">
                    <div class="features-box_icon">
                        <img src="{{ asset('storage/assets/img/icon/features-icon-1-4.png') }}" alt="Features Icon">
                    </div>
                    <span class="features-box_label text-theme2">Гарантии</span>
                    <h3 class="features-box_title text-white">Гарантия качества</h3>
                    <p class="features-box_text text-light-white">Мы отвечаем за свою работу</p>
                </div>
            </div>
        </div>
    </div>
</section>
