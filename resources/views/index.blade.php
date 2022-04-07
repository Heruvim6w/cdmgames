@include('layouts.header_main')
<!--==============================
Palyer Area
============================== -->
<section class="vs-palyers-wrapper bg-dark position-relative space-top space-extra-bottom">
    <div class="text-shape-2">CDMgames</div>
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
                        <a href="{{ route('games.show', [$game->id]) }}">
                            <div class="palyer-card_img">
                                <img src="{{ asset('storage/' . $game->poster) }}"
                                                                   alt="{{ $game->name }}" class="w-100">
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
</section>
@include('layouts.footer')
</body>

</html>
