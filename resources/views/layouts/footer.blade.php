<!--==============================
        Footer Area
==============================-->
<footer class="footer-wrapper footer-layout1 bg-dark" style="margin-top: -6em;">
    <!-- Newsletter Area -->
    <div class="container z-index-step1">
        <div class="footer-newsletter text-center">
            <div class="row align-items-center d-flex justify-content-center">
                <div class="col-lg-auto">
                    <p class="text-white text-uppercase mb-4 mb-lg-0 widget_title_p">Зарабатывайте в любимых играх!</p>
                </div>
                <div class="col-md-3 col-xl-12">
                    <span class="look_div">
                        @if((Auth::user()) && (Auth::user()->role === 2))
                            <a href="{{ route('dialogs.index') }}" target="blank">
                                <button class="look vs-btn">Чаты</button>
                            </a>
                        @else
                            <a href="{{ route('profile.chat', 1) }}" target="blank">
                                <button class="look vs-btn sell_btn">Продать аккаунт</button>
                            </a>
                        @endif
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="widget-area z-index-common"
         style="background-image: url('{{ asset('assets/img/bg/footer-1.webp') }}');
        background-repeat: no-repeat;
        background-position: center center;
        background-size: cover;
        height: auto;">
        <div class="container">
            <div class="row justify-content-between" style="padding-top: 15px;">
                <div class="col-md-4 col-xl-auto">
                    <div class="widget footer-widget">
                        <div class="vs-widget-about">
                            <div class="footer-logo">
                                <p class="widget_title">CDMGames</p>
                            </div>
                            <p class="footer-about-text" style="font-size: 14px; text-align: justify;">
                                CDMGames - это большой сервис скупки аккаунтов по видеоиграм.
                                Ценность предоставляет любой аккаунт, на который Вы потратили время: с доступом к
                                соревновательному режиму, к рейтинговым играм, с рангом, медалью или достижением, с
                                дорогими и дешевыми скинами, игровой валютой и т.д.
                                Мы займемся Вашим аккаунтом и поможем заработать на каждой игре. Совмести приятное с
                                полезным, Игрок!
                            </p>
                            <p><a href="{{ route('agreement') }}">Пользовательское соглашение</a></p>
                            <p><a href="{{ route('refund_politics') }}">Политика возвратов</a></p>
                            <p><a href="{{ route('price_list') }}">Товары и цены</a></p>
                            <div class="multi-social">
                                <a href="https://vk.com/cdmgames"><i class="fab fa-vk"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-xl-auto">
                    <div class="widget widget_nav_menu  footer-widget">
                        <p class="widget_title">Контакты</p>
                        <div class="menu-all-pages-container">
                            <ul class="menu">
                                <li><a class="text-white" href="https://vk.com/cdmgames">Официальное сообщество
                                        ВКонтакте</a></li>
                                <li><a class="text-white" href="https://discordapp.com/users/484332927216254977">Discord
                                        Илья: CDMGames</a></li>
                                <li><a class="text-white" href="https://discordapp.com/users/261928281748668419">Discord
                                        Альберт: cdmgamesalbert</a></li>
                                <li><a class="text-white" href="https://vk.com/reconnection95">Илья</a></li>
                                <li><a class="text-white" href="https://vk.com/id70682727">Альберт</a></li>
                                <li><a class="text-white" href="https://cdmgames.com/about">Операторы Cdmgames</a></li>
                                <li><a class="text-white" href="https://cdmgames.com/reviews">Отзывы</a></li>
                                <li><a class="text-white" href="https://cdmgames.com/posts">Статьи</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-xl-auto">
                    <div class="widget footer-widget">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-wrap text-center">
        <div class="container">
            <p>&copy; Copyright 2019-{{ date('Y') }} <a class="text-theme2" href="https://cdmgames.com">CDMGAMES</a> |
                <a class="text-white" href="https://cdmgames.com/about">ИП УРАЗМЕТОВ АЛЬБЕРТ РИМОВИЧ | ИНН:
                    025508256727</a></p>
        </div>
    </div>
</footer>


<!--********************************
        Code End  Here
******************************** -->


<!-- Scroll To Top -->
<a href="#" class="scrollToTop scroll-btn"><i class="far fa-arrow-up"></i></a>


<!--==============================
    All Js File
============================== -->
<!-- Jquery -->
<script src="{{ asset('assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
<!-- Slick Slider -->
<script src="{{ asset('assets/js/slick.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<!-- Parallax -->
<script src="{{ asset('assets/js/universal-parallax.min.js') }}"></script>
<!-- Magnific Popup -->
<script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
<!-- Isotope Filter -->
<script src="{{ asset('assets/js/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/js/isotope.pkgd.min.js') }}" defer></script>
<!-- Custom Carousel -->
<script src="{{ asset('assets/js/vscustom-carousel.min.js') }}"></script>
<!-- Form Js -->
<script src="{{ asset('assets/js/ajax-mail.js') }}" defer></script>
<!-- Main Js File -->
<script src="{{ asset('assets/js/main.js') }}"></script>
