<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>CDMgamesjhbjhbhjb - это команда профессионалов мирового уровня</title>
    <meta name="author" content="Angfuzsoft">
    <meta name="description" content="CDMgames - это команда профессионалов мирового уровня">
    <meta name="keywords" content="CDMgames - это команда профессионалов мирового уровня"/>
    <meta name="robots" content="NOINDEX,NOFOLLOW">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicons - Place favicon.ico in the root directory -->
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('assets/img/favicons/apple-icon-57x57.png') }}">
    <link rel="manifest" href="{{ asset('assets/img/favicons/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('ssets/img/favicons/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">

    <!--==============================
	  Google Fonts
	============================== -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&family=Rajdhani:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">


    <!--==============================
	    All CSS File
	============================== -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('/assets/css/bootstrap.min.css') }}">
    <!-- Fontawesome Icon -->
    <link rel="stylesheet" href="{{ asset('/assets/css/fontawesome.min.css') }}">
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="{{ asset('/assets/css/magnific-popup.min.css') }}">
    <!-- Slick Slider -->
    <link rel="stylesheet" href="{{ asset('/assets/css/slick.min.css') }}">
    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="{{ asset('/assets/css/style.css') }}">

</head>

<body>


@include('layouts.preloader')
@include('layouts.mobile_menu')
<!--==============================
    Header Area
==============================-->
<header class="vs-header header-layout2">
    <div class="header-top d-none d-lg-block">
        <div class="container">
            <div class="row justify-content-center justify-content-lg-between align-items-center">
                <div class="col-auto">
                    <div class="header-links text-white">
                        <ul>
                            <li>
                                <p class="header-text">Приветствуем в нашей команде <span class="fw-semibold"><span
                                            class="text-theme2 text-uppercase">CDMgames</span></span></p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="header-links text-white">
                        <ul>
                            <li>
                                <a href="mailto:support@cdmdoto.com" class="header-number"><i class="fal fa-at"></i>support@cdmdoto.com</a>
                            </li>
                            <li>
                                <div class="multi-social">
                                    <a href="https://vk.com/cdmgames"><i class="fab fa-vk"></i></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="sticky-wrapper">
        <div class="sticky-active">
            <div class="header-menu-area">
                <div class="container">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto">
                            <div class="header-logo">
                                @include('layouts.logo')
                            </div>
                        </div>
                        <div class="col-auto">
                            @include('layouts.main_menu')
                        </div>
                        <div class="col-auto d-none d-lg-block">
                            <div class="d-flex flex-wrap align-items-center">
                                @include('layouts.vk_chat')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!--==============================
Breadcumb
============================== -->
<div class="breadcumb-wrapper " data-overlay="title" data-opacity="5">
    <div class="parallax" data-bg-class="bg-title"
         data-parallax-image="{{ asset('assets/img/breadcumb/hero-5-1.jpg') }}"></div>
    <div class="container z-index-common" style="z-index: 6;">
        <div class="breadcumb-content text-center">
            <div class="breadcumb-menu-wrap">
                <ul class="breadcumb-menu">
                    <li><a href="/">Главная</a>
                </ul>
            </div>
            @switch(Route::currentRouteName())
                @case('games.show')
                    <h1 class="breadcumb-title">{{ $game->name }}</h1>
                @break
                @case('about')
                    <h1 class="breadcumb-title">О нас</h1>
                @break
                @case('posts.index')
                    <h1 class="breadcumb-title">Статьи</h1>
                @break
                @case('posts.show')
                    <h1 class="breadcumb-title">{{ $post->title }}</h1>
                @break
                @case('reviews')
                    <h1 class="breadcumb-title">Отзывы</h1>
                @break
                @default
                    <h1 class="breadcumb-title">Игры</h1>
            @endswitch
        </div>
    </div>
</div>
