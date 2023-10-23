@include('layouts.header_main')
<!--==============================
Palyer Area
============================== -->
<section class="vs-palyers-wrapper bg-dark position-relative space-top space-extra-bottom">
{{--    <div class="text-shape-2">CDMgames</div>--}}
    <div class="container">
        <div class="title-area text-center text-xl-start">
            <span class="sub-title">#Все текущие игры</span>
            <h2 class="sec-title text-white">Выбор за тобой</h2>
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
                 data-num="{{ $accounts +4575 }}"
                 data-duration="10"> 0</div>
            <span class="text-muted">Куплено аккаунтов</span>
        </div>
        <div class="col text-center mb-5 mb-sm-0 numbers__item">
            <div class="number_count"
                 style="color:#333333; font-size: 34px;"
                 id="num2"
                 data-num="{{ $allBalance +3666000 }}"
                 data-prefix="&#8381;">0</div>
            <span class="text-muted">Выплачено рублей</span>
        </div>
        <div class="col text-center numbers__item">
            <div class="number_count"
                 style="color:#333333; font-size: 34px;"
                 id="num3"
                 data-num="{{ $reviews }}"
                 data-suffix="+"
                 data-duration="6">0</div>
            <span class="text-muted">Положительных отзывов</span>
        </div>
    </div>
</section>

<script src="{{ asset('assets/js/countUp.min.js') }}" defer></script>
<script src="{{ asset('assets/js/main_for_increment.js') }}" defer></script>
<script>
</script>
@include('layouts.footer')
</body>

</html>
