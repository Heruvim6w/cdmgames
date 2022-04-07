<!--==============================
        Footer Area
==============================-->
<footer class="footer-wrapper footer-layout1 bg-dark">
    <!-- Newsletter Area -->
    <div class="container z-index-step1">
        <div class="footer-newsletter text-center text-lg-start">
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-auto">
                    <h2 class="text-white text-uppercase mb-4 mb-lg-0">Пиши нам</h2>
                </div>
                <div class="col-lg-auto">
                    @include('layouts.vk_chat')
                </div>
            </div>
        </div>
    </div>
    <div class="widget-area z-index-common">
        <div class="parallax" data-bg-class="bg-title"
             data-parallax-image="{{ asset('storage/assets/img/bg/footer-bg-1-11.jpg') }}"></div>
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-md-3 col-xl-auto">
                    <div class="widget footer-widget">
                        <div class="vs-widget-about">
                            <div class="footer-logo">
                                @include('layouts.logo')
                            </div>
                            <p class="footer-about-text">
                                CDMgames – это команда профессионалов мирового уровня. Нашим приоритетным направлением
                                является буст рейтинга, продажа аккаунтов по игре Dota 2.
                                Мы стремимся удовлетворить потребности каждого клиента и основываем свою работу на трех
                                основных принципах: доверие, комфорт и безопасность.
                            </p>
                            <div class="multi-social">
                                <a href="https://vk.com/cdmgames"><i class="fab fa-vk"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-xl-auto">
                    <div class="widget widget_nav_menu  footer-widget">
                        <h3 class="widget_title">Игры</h3>
                        <div class="menu-all-pages-container">
                            <ul class="menu">
                                @if(!isset($games))
                                    @php
                                        $games = \App\Models\Game::all();
                                    @endphp
                                @endif
                                @foreach($games as $game)
                                    <li><a href="{{ route('games.show', [$game->id]) }}">{{ $game->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-xl-auto">
                    <div class="widget widget_nav_menu  footer-widget">
                        <h3 class="widget_title">Контакты</h3>
                        <div class="menu-all-pages-container">
                            <ul class="menu">
                                <li><a class="text-white" href="mailto:support@cdmdoto.com">support@cdmdoto.com</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-xl-auto">
                    <div class="widget footer-widget">
                        <style>
                            @media screen and (max-width: 600px) {
                                #vkmobile {
                                    visibility: hidden;
                                    display: none;
                                }
                            }

                            @media screen and (max-width: 480px) {
                                .vkmobile {
                                    width: 100%;
                                    overflow: hidden;
                                }
                            }

                            .colortext {
                                background-color: #ffe;
                                /* Цвет фона */
                                color: #930;
                                /* Цвет текста */
                            }
                        </style>
                        <div class="vkmobile">
                            <script type="text/javascript" src="https://vk.com/js/api/openapi.js?168"></script>
                            <div id="vk_groups"></div>
                            <script type="text/javascript">
                                VK.Widgets.Group("vk_groups", {
                                    mode: 3,
                                    width: "450",
                                    color1: 'F5F9FD',
                                    color3: '005ABF'
                                }, 176494199);
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-wrap text-center">
        <div class="container">
            <p>&copy; Copyright 2022{{ date('Y') }} <a class="text-theme2" href="https://cdmgames.com">CDM</a>.
                <a class="text-white" href="mailto:support@cdmdoto.com">ИП УРАЗМЕТОВ АЛЬБЕРТ РИМОВИЧ | ИНН:
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
<script src="{{ asset('storage/assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
<!-- Slick Slider -->
<script src="{{ asset('storage/assets/js/slick.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('storage/assets/js/bootstrap.min.js') }}"></script>
<!-- Smooth Scroll -->
<script src="{{ asset('storage/assets/js/SmoothScroll.min.js') }}"></script>
<!-- Parallax -->
<script src="{{ asset('storage/assets/js/universal-parallax.min.js') }}"></script>
<!-- Magnific Popup -->
<script src="{{ asset('storage/assets/js/jquery.magnific-popup.min.js') }}"></script>
<!-- Isotope Filter -->
<script src="{{ asset('storage/assets/js/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('storage/assets/js/isotope.pkgd.min.js') }}"></script>
<!-- Custom Carousel -->
<script src="{{ asset('storage/assets/js/vscustom-carousel.min.js') }}"></script>
<!-- Form Js -->
<script src="{{ asset('storage/assets/js/ajax-mail.js') }}"></script>
<!-- Main Js File -->
<script src="{{ asset('storage/assets/js/main.js') }}"></script>
