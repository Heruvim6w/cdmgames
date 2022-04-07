@include('layouts.header')

<!--==============================
  Palyer Area
  ============================== -->
<section class="vs-palyers-wrapper position-relative bg-dark space-top space-extra-bottom">
    <div class="text-shape-2">{{ $game->name }}</div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-11">
                <div class="row">
                    <div class="col-xl-11 mb-30 mb-lg-5">
                        <div class="player-img">
                            <img src="{{ asset('storage/' . $game->poster) }}" alt="{{ $game->name }}" class="w-100">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-xl-5 mb-10 mb-lg-0">
                        <div class="player-info-area">
                            <span class="sub-title text-theme mb-2 pb-1">#Об игре</span>
                            <h2 class="h3 text-white">{{ $game->name }}</h2>
                            <div class="row">
                                <div class="col-xl-9">
                                    <table class="info-table">
                                        <tbody>
                                        <tr>
                                            <th>Дата выпуска:</th>
                                            <td>2021</td>
                                        </tr>
                                        <tr>
                                            <th>Рейтинг*:</th>
                                            <td>90/100</td>
                                        </tr>
                                        <tr>
                                            <th>Рейтинг от "Игромания":</th>
                                            <td>9/10</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <p class="text-muted">*На основе данных от <a href="https://www.metacritic.com/">Metacritic</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-7">
                        <p class="text-white mt-n1">{!! $game->description !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--==============================
Video Area
==============================-->
{{--<section class="vs-video-wrapper space-top space-extra-bottom">--}}
{{--    <div class="parallax" data-bg-class="bg-title" data-parallax-image="assets/img/bg/video-bg-2-1.png"></div>--}}
{{--    <div class="container">--}}
{{--        <div class="title-area text-center">--}}
{{--            <span class="sub-title">#Welcome to the Best</span>--}}
{{--            <h2 class="sec-title text-white">Checkout Live</h2>--}}
{{--            <h2 class="sec-title-style2">Streaming</h2>--}}
{{--            <div class="sec-shape">--}}
{{--                <div class="sec-shape_bar"></div>--}}
{{--                <div class="sec-shape_bar"></div>--}}
{{--                <div class="sec-shape_bar"></div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="row justify-content-center">--}}
{{--            <div class="col-xl-8">--}}
{{--                <div class="vs-carousel" data-slide-show="1" data-md-slide-show="1" id="slideLink1" data-asnavfor="#slideLink2">--}}
{{--                    <div class="slide">--}}
{{--                        <div class="video-big mb-10" data-overlay="title" data-opacity="7">--}}
{{--                            <div class="video-big_img">--}}
{{--                                <img src="{{ asset('storage/' . $game->poster) }}" alt="Video Image" class="w-100">--}}
{{--                            </div>--}}
{{--                            <div class="video-big_content">--}}
{{--                                <a href="https://www.youtube.com/watch?v=_sI_Ps7JSEk" class="popup-video play-btn style3"><i class="fas fa-play"></i></a>--}}
{{--                                <h3 class="video-big_title h4"><a href="#" class="text-inherit">Watch Dogs</a></h3>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="slide">--}}
{{--                        <div class="video-big mb-10" data-overlay="title" data-opacity="7">--}}
{{--                            <div class="video-big_img">--}}
{{--                                <img src="assets/img/video/video-big-2.jpg" alt="Video Image" class="w-100">--}}
{{--                            </div>--}}
{{--                            <div class="video-big_content">--}}
{{--                                <a href="https://www.youtube.com/watch?v=_sI_Ps7JSEk" class="popup-video play-btn style3"><i class="fas fa-play"></i></a>--}}
{{--                                <h3 class="video-big_title h4"><a href="#" class="text-inherit">Plants Of War</a></h3>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="slide">--}}
{{--                        <div class="video-big mb-10" data-overlay="title" data-opacity="7">--}}
{{--                            <div class="video-big_img">--}}
{{--                                <img src="assets/img/video/video-big-3.jpg" alt="Video Image" class="w-100">--}}
{{--                            </div>--}}
{{--                            <div class="video-big_content">--}}
{{--                                <a href="https://www.youtube.com/watch?v=_sI_Ps7JSEk" class="popup-video play-btn style3"><i class="fas fa-play"></i></a>--}}
{{--                                <h3 class="video-big_title h4"><a href="#" class="text-inherit">Tommek Battle</a></h3>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="slide">--}}
{{--                        <div class="video-big mb-10" data-overlay="title" data-opacity="7">--}}
{{--                            <div class="video-big_img">--}}
{{--                                <img src="assets/img/video/video-big-4.jpg" alt="Video Image" class="w-100">--}}
{{--                            </div>--}}
{{--                            <div class="video-big_content">--}}
{{--                                <a href="https://www.youtube.com/watch?v=_sI_Ps7JSEk" class="popup-video play-btn style3"><i class="fas fa-play"></i></a>--}}
{{--                                <h3 class="video-big_title h4"><a href="#" class="text-inherit">Storna Play</a></h3>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="slide">--}}
{{--                        <div class="video-big mb-10" data-overlay="title" data-opacity="7">--}}
{{--                            <div class="video-big_img">--}}
{{--                                <img src="assets/img/video/video-big-5.jpg" alt="Video Image" class="w-100">--}}
{{--                            </div>--}}
{{--                            <div class="video-big_content">--}}
{{--                                <a href="https://www.youtube.com/watch?v=_sI_Ps7JSEk" class="popup-video play-btn style3"><i class="fas fa-play"></i></a>--}}
{{--                                <h3 class="video-big_title h4"><a href="#" class="text-inherit">Joyen War</a></h3>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="row vs-carousel video-media_slider" data-slide-show="4" data-md-slide-show="3" data-xs-slide-show="2" data-arrows="true" id="slideLink2" data-asnavfor="#slideLink1" data-focuson-select="true" data-center-mode="true">--}}
{{--                    <div class="col-xl-3">--}}
{{--                        <div class="video-media">--}}
{{--                            <div class="video-media_img">--}}
{{--                                <img src="assets/img/video/video-thumb-1-1.jpg" alt="Video Thumb">--}}
{{--                            </div>--}}
{{--                            <div class="video-media_content">--}}
{{--                                <h3 class="video-media_title h4 text-white">Watch Dogs</h3>--}}
{{--                                <p class="video-media_text text-light-white">Praesent a ornare metus. </p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-xl-3">--}}
{{--                        <div class="video-media">--}}
{{--                            <div class="video-media_img">--}}
{{--                                <img src="assets/img/video/video-thumb-1-2.jpg" alt="Video Thumb">--}}
{{--                            </div>--}}
{{--                            <div class="video-media_content">--}}
{{--                                <h3 class="video-media_title h4 text-white">Plants Of War</h3>--}}
{{--                                <p class="video-media_text text-light-white">Praesent a ornare metus. </p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-xl-3">--}}
{{--                        <div class="video-media">--}}
{{--                            <div class="video-media_img">--}}
{{--                                <img src="assets/img/video/video-thumb-1-3.jpg" alt="Video Thumb">--}}
{{--                            </div>--}}
{{--                            <div class="video-media_content">--}}
{{--                                <h3 class="video-media_title h4 text-white">Tommek Battle</h3>--}}
{{--                                <p class="video-media_text text-light-white">Praesent a ornare metus. </p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-xl-3">--}}
{{--                        <div class="video-media">--}}
{{--                            <div class="video-media_img">--}}
{{--                                <img src="assets/img/video/video-thumb-1-4.jpg" alt="Video Thumb">--}}
{{--                            </div>--}}
{{--                            <div class="video-media_content">--}}
{{--                                <h3 class="video-media_title h4 text-white">Storna Play</h3>--}}
{{--                                <p class="video-media_text text-light-white">Praesent a ornare metus. </p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-xl-3">--}}
{{--                        <div class="video-media">--}}
{{--                            <div class="video-media_img">--}}
{{--                                <img src="assets/img/video/video-thumb-1-5.jpg" alt="Video Thumb">--}}
{{--                            </div>--}}
{{--                            <div class="video-media_content">--}}
{{--                                <h3 class="video-media_title h4 text-white">Joyen War</h3>--}}
{{--                                <p class="video-media_text text-light-white">Praesent a ornare metus. </p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</section>--}}

@include('layouts.footer')
