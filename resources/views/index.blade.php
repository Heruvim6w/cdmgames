@include('layouts.header_main')
<!--==============================
Palyer Area
============================== -->

{{-- Подключение Vue и компонента отзывов --}}
<div id="reviews-carousel-app">
    <reviews-carousel :reviews='@json($reviews)'></reviews-carousel>
</div>

<section class="vs-palyers-wrapper bg-dark position-relative space-top space-extra-bottom">
    <div class="container">
        <div class="title-area text-center text-xl-start">
            <h2 class="sec-title text-white">Продать свой аккаунт</h2>
            <div class="sec-shape">
                <div class="sec-shape_bar"></div>
                <div class="sec-shape_bar"></div>
                <div class="sec-shape_bar"></div>
            </div>
        </div>
        <div class="row justify-content-center">
            @foreach($games as $game)
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="palyer-card">
                        <a href="{{ $game->name === 'Dota 2' ? 'https://cdmdoto.com' : route('games.show', [$game->slug]) }}">
                            <div class="palyer-card_img">
                                <img src="{{ asset('storage/' . $game->poster) }}"
                                    alt="{{ $game->name }}" class="w-100" width="317.5" height="178.6">
                            </div>
                            <div class="palyer-card_content">
                                <span class="palyer-card_degi">Подробнее о:</span>
                                <h3 class="palyer-card_name text-inherit">{{ $game->name }}</h3>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @if($buyInfo)
        <div class="description w-75">
            {!! $buyInfo->content !!}
        </div>
    @endif
    <div class="count row w-75 numbers__grid">
        <div class="col text-center mb-5 mb-sm-0 numbers__item">
            <div class="number_count"
                 style="color:#333333; font-size: 34px;"
                 id="num1"
                 data-num="{{ $accounts +35755 }}"
                 data-duration="10"> 0</div>
            <span class="text-muted">Куплено аккаунтов</span>
        </div>
        <div class="col text-center mb-5 mb-sm-0 numbers__item">
            <div class="number_count"
                 style="color:#333333; font-size: 34px;"
                 id="num2"
                 data-num="{{ $allBalance +81321155 }}"
                 data-prefix="&#8381;">0</div>
            <span class="text-muted">Выплачено рублей</span>
        </div>
        <div class="col text-center numbers__item">
            <div class="number_count"
                 style="color:#333333; font-size: 34px;"
                 id="num3"
                 data-num="{{ $reviewsCount }}"
                 data-suffix="+"
                 data-duration="6">0</div>
            <span class="text-muted">Положительных отзывов</span>
        </div>
    </div>
</section>

<script src="https://unpkg.com/vue@3/dist/vue.global.prod.js"></script>
<script type="module">
import ReviewsCarousel from '/assets/js/components/ReviewsCarousel.js';
const { createApp } = Vue;
createApp({
    components: { ReviewsCarousel }
}).mount('#reviews-carousel-app');
</script>
<script src="{{ asset('assets/js/countUp.min.js') }}" defer></script>
<script src="{{ asset('assets/js/main_for_increment.js') }}" defer></script>
<script>
</script>
@include('layouts.footer')
</body>

</html>
