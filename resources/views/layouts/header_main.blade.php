<!doctype html>
<html class="no-js" lang="ru">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="yandex-verification" content="c3b91072b1365ccc"/>
    <title>Продать аккаунт - Скупщик аккаунтов | cdmgames.com</title>
    <meta name="author" content="Mr_Imagined">
    <meta name="description"
          content="{{ $seo_description ??  'CDMgames - это команда профессионалов мирового уровня'}}">
    <meta name="keywords"
          content="{{ $seo_keywords ??  'CDMgames,аккаунт,продажа аккаунтов,игры,dota,dota2,Apex Legends,wow,world of warcraft,lol,league of legends,Hearthstone,Brawl Stars'}}"/>
    <meta name="robots" content="INDEX,FOLLOW">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicons - Place favicon.ico in the root directory -->
    <link rel="icon" sizes="57x57" href="{{ asset('assets/img/favicons/favicon.ico') }}">
    <meta property="og:title" content="{{ $title ?? 'cdmgames.com' }}">
    <meta property="og:description"
          content="{{ $seo_description ??  'CDMgames - это команда профессионалов мирового уровня'}}">
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
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.min.css') }}">
    <!-- Slick Slider -->
    <link rel="stylesheet" href="{{ asset('assets/css/slick.min.css') }}">
    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Yandex.Metrika counter -->
    <script type="text/javascript">
        (function (m, e, t, r, i, k, a) {
            m[i] = m[i] || function () {
                (m[i].a = m[i].a || []).push(arguments
            }
        };
        m[i].l = 1 * new Date();
        for (var j = 0; j < document.scripts.length; j++) {
            if (document.scripts[j].src === r) {
                return;
            }
        }
        k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(k, a)
        })
        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

        ym(93243874, "init", {
            clickmap: true,
            trackLinks: true,
            accurateTrackBounce: true,
            webvisor: true
        });
    </script>
    <noscript>
        <div><img src="https://mc.yandex.ru/watch/93243874" style="position:absolute; left:-9999px;" alt=""/></div>
    </noscript>
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
                                        <a href="https://t.me/cdmgames_bot" class="header-number" target="_blank">
                                            <i class="fab fa-telegram"></i>
                                            Наш телеграм-бот
                                        </a>
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
        <a href="https://vk.ru/cdmgames"><span>vk</span>.com</a>
        <a href="https://t.me/cdmgames_bot"><span>tg</span> бот</a>
    </div>

    <div class="vs-carousel" id="heroSlide1" data-slide-show="1" data-md-slide-show="1" data-fade="true">
        <div class="slider">
            <div class="hero-clip-slider hero_wide" data-overlay="title" data-opacity="5">
                <div class="hero-clip-img hero_wide_img"
                     data-bg-src="{{ asset('assets/img/breadcumb/test-1.webp') }}"></div>
                <div class="hero-clip-shape bg-theme2"></div>
                <div class="container" style="z-index: 6;">
                    <div class="row">
                        <div class="col-8 col-sm-10 col-xxl-6 offset-xl-1">
                            <div class="hero-clip-content">
                                <h1 class="hero-clip-title">Welcome to <span class="text-theme2">CDMGAMES</span> zone
                                </h1>
                                @if($errors->any())
                                    <div class="header_main_error">
                                        <ul>
                                            @foreach($errors->all() as $error)
                                                <li class="error">{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <a href="{{ route('about') }}" class="vs-btn mt-1 mt-lg-0">О нас<i
                                        class="fal fa-long-arrow-right"></i></a>
                                <button class="vs-btn mt-1 mt-lg-0" id="openSellModalMain">Оставить заявку на продажу
                                </button>
                                <a href="{{ route('profile.chat', 1) }}" target="_blank">
                                    <button class="vs-btn mt-1 mt-lg-0">Написать сообщение</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('components.sell_request_form', [
    'modalId' => 'sellModalMain',
    'labelId' => 'sellModalLabelMain',
    'formId' => 'sellFormMain',
    'telegramId' => 'telegram_main',
    'gameId' => 'game_main',
    'descriptionId' => 'description_main',
    'mediaId' => 'media_main',
    'mediaErrorId' => 'mediaErrorMain',
    'openBtnId' => 'openSellModalMain',
    'games' => $games
])

<!-- Спиннер загрузки -->
<div id="sellFormMainSpinner">
    <div></div>
</div>

<script>
    $(document).ready(function () {
        $('#openSellModalMain').on('click', function () {
            $('#sellModalMain').modal('show');
        });

        // Валидация Telegram
        $('#telegram_main').on('input', function () {
            const val = $(this).val();
            const re = /^@[a-zA-Z0-9_]{5,32}$/;
            if (!re.test(val)) {
                $(this)[0].setCustomValidity('Некорректный username');
            } else {
                $(this)[0].setCustomValidity('');
            }
        });

        // Валидация файлов
        $('#media_main').on('change', function () {
            let totalSize = 0;
            let valid = true;
            let errorMsg = '';
            const allowedTypes = ['image/jpeg', 'image/png', 'image/webp', 'application/pdf', 'video/mp4', 'image/jpg'];
            $.each(this.files, function (i, file) {
                if (file.size > 10 * 1024 * 1024) {
                    valid = false;
                    errorMsg = 'Файл ' + file.name + ' превышает 10Мб.';
                    return false;
                }
                if (!allowedTypes.includes(file.type)) {
                    valid = false;
                    errorMsg = 'Недопустимый тип файла: ' + file.name;
                    return false;
                }
                totalSize += file.size;
            });
            if (totalSize > 10 * 1024 * 1024) {
                valid = false;
                errorMsg = 'Суммарный размер файлов превышает 10Мб.';
            }
            if (!valid) {
                $('#media_main')[0].setCustomValidity(errorMsg);
                $('#mediaErrorMain').text(errorMsg).show();
            } else {
                $('#media_main')[0].setCustomValidity('');
                $('#mediaErrorMain').hide();
            }
        });
    });
</script>
