<!doctype html>
<html class="no-js" lang="ru">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>
        @isset($title)
        {{$title}} |
        @endisset
        cdmgames.com
    </title>
    <meta name="author" content="Mr_Imagined">
    <meta name="description" content="{{ $seo_description ??  'CDMgames - это команда профессионалов мирового уровня'}}">
    <meta name="keywords" content="{{ $seo_keywords ??  'CDMgames,аккаунт,продажа аккаунтов,игры,dota,dota2,Apex Legends,wow,world of warcraft,lol,league of legends,Hearthstone,Brawl Stars'}}"/>
    <meta name="robots" content="INDEX,FOLLOW">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">

    <!-- Favicons - Place favicon.ico in the root directory -->
    <link rel="icon" sizes="57x57" href="{{ asset('assets/img/favicons/favicon.ico') }}">
    <meta property="og:title" content="{{ $title ?? 'cdmgames.com' }}">
    <meta property="og:description" content="{{ $seo_description ??  'CDMgames - это команда профессионалов мирового уровня'}}">
    <meta property="og:image" content="{{ asset('assets/img/logo.webp') }}">
    <meta property="og:url" content="{{ Request::url() }}">
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <link rel="manifest" href="{{ asset('assets/img/favicons/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('ssets/img/favicons/favicon.ico') }}">
    <meta name="theme-color" content="#ffffff">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--==============================
	  Google Fonts
	============================== -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&family=Rajdhani:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Tektur:200,200i,300,300i,400,400i,600,600i,800,800i,900,900i" rel="stylesheet">


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
    <link rel="stylesheet" href="{{ asset('/assets/css/custom.css') }}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Yandex.Metrika counter -->
    <script type="text/javascript" >
        (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments}};
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

@php
    switch(Route::currentRouteName()) {
        case 'games.show':
            $subTitle = $game->name;
            break;
        case 'about':
            $subTitle = 'О нас';
            break;
        case('posts.index'):
            $subTitle = 'Статьи';
            break;
        case('posts.show'):
            $subTitle = $post->title;
            break;
        case('reviews'):
            $subTitle = 'Отзывы';
            break;
        case('profile'):
            $subTitle = auth()->user()->name;
            break;
        case('store.index'):
            $subTitle = $gameForItem->title;
            break;
        case('store.show'):
            $subTitle = $gameItem->gameForItem->title ;
            break;
        case('games.show'):
            $subTitle = 'Игры';
            break;
        case('sell.application.show'):
            $sellApplication = true;
            $subTitle = 'Ваша заявка';
            break;
        default:
            $subTitle = 'Игры';
    }
@endphp

<!--==============================
    Header Area
==============================-->
<header class="vs-header header-layout2">
    <div class="header-top d-none d-lg-block">
        <div class="container">
            <div class="row align-items-center flex-nowrap flex-lg-nowrap flex-md-wrap flex-wrap justify-content-center justify-content-lg-between" style="min-height: 70px;">
                <div class="col-auto px-2 flex-shrink-1 d-flex align-items-center">
                    <div class="header-links text-white">
                        <ul class="mb-0">
                            <li>
                                <p class="header-text mb-0">Приветствуем в нашей команде <span class="fw-semibold">
                                        <span class="text-theme2 text-uppercase">CDMgames</span></span></p>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-auto px-2 flex-shrink-1 d-flex align-items-center">
                    <div class="header-links text-white">
                        <div class="multi-social">
                            <ul class="mb-0">
                                <li class="header_social_links">
                                    <a href="https://t.me/cdmgamesofficial" class="header-number" target="_blank">
                                        <i class="fab fa-telegram"></i>
                                    </a>
                                    <a href="https://vk.ru/cdmgames" target="_blank">
                                        <i class="fab fa-vk"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="sticky-wrapper">
        <div class="sticky-active">
            <div class="header-menu-area">
                <div class="container">
                    <div class="row align-items-center justify-content-between main_menu">
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
                                @include('layouts.vk_chat', ['sellApplication' => $sellApplication ?? null])
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
@if(!isset($sellApplication))
    <div
        class="breadcumb-wrapper header-breadcrumb"
        data-overlay="title"
        data-opacity="5"
        style="background-image: url('{{
            isset($game) && $game->banner ? asset('storage/' . $game->banner) : (
                isset($gameForItem) && $gameForItem->banner ? asset('storage/' . $gameForItem->banner) :
                    (
                        isset($gameItem) && $gameItem->gameForItem->banner ?
                            asset('storage/' . $gameItem->gameForItem->banner) :
                            asset('assets/img/breadcumb/test-1.webp'
                        )
                    )
                )
            }}');
            background-repeat: no-repeat;
            background-position: center center;
            background-size: cover;
            height: auto;
            {{ isset($game) ? 'padding-top: 100px; padding-bottom: 100px;' : '' }}
            ">
            <div class="container z-index-common" style="z-index: 6;">
                <div class="breadcumb-content text-center">
                    <div class="breadcumb-menu-wrap">
                        <ul class="breadcumb-menu">
                            <li><a href="/">Главная</a>
                        </ul>
                    </div>

                    <h1 class="breadcumb-title">{{ $subTitle }}</h1>

                    <div class="col-md-3 col-xl-12 mt-3">
                        <span class="look_div">
                            <button class="look vs-btn top-btn sell_btn fs-3 md-fs-1 me-md-3" id="openSellModal">Оставить заявку на продажу</button>
                            <a href="{{ route('profile.chat', 1) }}" target="_blank">
                                <button class="look vs-btn top-btn sell_btn fs-3 md-fs-1 me-md-3">Написать сообщение</button>
                            </a>
                        </span>
                    </div>
                </div>
            </div>
    </div>
@endif

@if($errors->any())
    <div class="col-md-5 text-center">
        <ul>
            @foreach($errors->all() as $error)
                <li class="error">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@include('components.sell_request_form', [
    'modalId' => 'sellModal',
    'labelId' => 'sellModalLabel',
    'formId' => 'sellForm',
    'telegramId' => 'telegram',
    'gameId' => 'game',
    'descriptionId' => 'description',
    'mediaId' => 'media',
    'mediaErrorId' => 'mediaError',
    'openBtnId' => 'openSellModal',
    'games' => $games
])

<!-- Спиннер загрузки -->
<div id="sellFormMainSpinner">
    <div></div>
</div>

<script>
// Открытие модального окна
$(document).ready(function() {
  $('#openSellModal').on('click', function() {
    $('#sellModal').modal('show');
  });

  // Валидация Telegram
  $('#telegram').on('input', function() {
    const val = $(this).val();
    const re = /^@[a-zA-Z0-9_]{5,32}$/;
    if (!re.test(val)) {
      $(this)[0].setCustomValidity('Некорректный username');
    } else {
      $(this)[0].setCustomValidity('');
    }
  });

  // Валидация файлов
  $('#media').on('change', function() {
    let totalSize = 0;
    let valid = true;
    let errorMsg = '';
    const allowedTypes = ['image/jpeg','image/png','image/webp','application/pdf','video/mp4','image/jpg'];
    $.each(this.files, function(i, file) {
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
      $('#media')[0].setCustomValidity(errorMsg);
      $('#mediaError').text(errorMsg).show();
    } else {
      $('#media')[0].setCustomValidity('');
      $('#mediaError').hide();
    }
  });
});
</script>
