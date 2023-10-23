<!doctype html>
<html class="no-js" lang="ru">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="yandex-verification" content="c3b91072b1365ccc" />
    <title>Продать аккаунт - Скупщик аккаунтов | cdmgames.com</title>
    <meta name="author" content="Mr_Imagined">
    <meta name="description" content="{{ $seo_description ??  'CDMgames - это команда профессионалов мирового уровня'}}">
    <meta name="keywords" content="{{ $seo_keywords ??  'CDMgames,аккаунт,продажа аккаунтов,игры,dota,dota2,Apex Legends,wow,world of warcraft,lol,league of legends,Hearthstone,Brawl Stars'}}"/>
    <meta name="robots" content="INDEX,FOLLOW">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicons - Place favicon.ico in the root directory -->
    <link rel="icon" sizes="57x57" href="{{ asset('assets/img/favicons/favicon.ico') }}">
    <meta property="og:title" content="{{ $title ?? 'cdmgames.com' }}">
    <meta property="og:description" content="{{ $seo_description ??  'CDMgames - это команда профессионалов мирового уровня'}}">
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
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Tektur:wght@400;500;600;700;800;900&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Tektur:wght@400;500;600;700;800;900&display=swap">
    </noscript>

    <!--==============================
	    All CSS File
	============================== -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" async>
    <!-- Fontawesome Icon -->
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.min.css') }}" async>
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.min.css') }}">
    <!-- Slick Slider -->
    <link rel="stylesheet" href="{{ asset('assets/css/slick.min.css') }}">
    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Yandex.Metrika counter -->
    <script type="text/javascript" >
        (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
            m[i].l=1*new Date();
            for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
            k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

        ym(93243874, "init", {
            clickmap:true,
            trackLinks:true,
            accurateTrackBounce:true,
            webvisor:true
        });
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/93243874" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->

</head>

<body>

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
                                        <a href="mailto:support@cdmgames.com" class="header-number"><i class="fal fa-at"></i>support@cdmgames.com</a>
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
                <div class="hero-clip-img hero_wide_img" data-bg-src="{{ asset('assets/img/breadcumb/test-1.webp') }}"></div>
                <div class="hero-clip-shape bg-theme2"></div>
                <div class="container" style="z-index: 6;">
                    <div class="row">
                        <div class="col-sm-8 col-xxl-6 offset-xl-1">
                            <div class="hero-clip-content">
                                <h1 class="hero-clip-title">Welcome to <span class="text-theme2">CDMGAMES</span> zone</h1>
                                <a href="{{ route('about') }}" class="vs-btn">О нас<i class="fal fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
