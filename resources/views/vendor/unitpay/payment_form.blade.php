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
    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">

    <!-- Favicons - Place favicon.ico in the root directory -->
    <link rel="icon" sizes="57x57" href="{{ asset('assets/img/favicons/favicon.ico') }}">
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
<style>
    .well {
        padding-top: 15em;
    }
    /*form {*/
    /*    width: 50%;*/
    /*    text-align: center;*/
    /*}*/
    form.unitpay-form .btn_order {
        background-color: #FFF;
        border: solid #CCC 1px;
        width: 100%;
        text-align: center;
        padding-left: 20px;
        margin-right: 20px;
        height: 10rem;
        font-size: 21pt;
    }
    form.unitpay-form .btn_order img {
        margin-right: 10px;
    }
    .form-group {
        margin-bottom: 3rem;
    }
    form.unitpay-form .btn_order:hover {
        background-color: #F8F8F8;
    }
</style>

<div class="well">

    @if (config('unitpay.payment_forms')['cards'])
        <div class="form-group ">
            <form action="https://unitpay.ru/pay/{{ $payment_fields['PUB_KEY'] }}/card" method="POST" class="form unitpay-form">
                <input type="hidden" name="sum" value="{{ $payment_fields['PAYMENT_AMOUNT'] }}">
                <input type="hidden" name="account" value="{{ $payment_fields['PAYMENT_NO'] }}">
                <input type="hidden" name="desc" value="{{ $payment_fields['ITEM_NAME'] }}">
                <input type="hidden" name="currency" value="{{ $payment_fields['CURRENCY'] }}">
                <input type="hidden" name="locale" value="{{ $payment_fields['LOCALE'] }}">
                <input type="hidden" name="signature" value="{{ $payment_fields['SIGN'] }}">
                <input type="hidden" name="hideOtherMethods" value="{{ config('unitpay.hideOtherMethods','false') }}">
                <button type="submit" class="btn btn_order look vs-btn sell_btn">Картой российского банка</button>
            </form>
        </div>
    @endif

    @if (config('unitpay.payment_forms')['yandex'])
        <div class="form-group pull-left">
            <form action="https://unitpay.ru/pay/{{ $payment_fields['PUB_KEY'] }}/yandex" method="POST" class="form unitpay-form">
                <input type="hidden" name="sum" value="{{ $payment_fields['PAYMENT_AMOUNT'] }}">
                <input type="hidden" name="account" value="{{ $payment_fields['PAYMENT_NO'] }}">
                <input type="hidden" name="desc" value="{{ $payment_fields['ITEM_NAME'] }}">
                <input type="hidden" name="currency" value="{{ $payment_fields['CURRENCY'] }}">
                <input type="hidden" name="locale" value="{{ $payment_fields['LOCALE'] }}">
                <input type="hidden" name="signature" value="{{ $payment_fields['SIGN'] }}">
                <input type="hidden" name="hideOtherMethods" value="{{ config('unitpay.hideOtherMethods','false') }}">
                <button type="submit" class="btn btn_order btn_small look vs-btn sell_btn">Yandex</button>
            </form>
        </div>
    @endif
</div>
</body>
</html>
