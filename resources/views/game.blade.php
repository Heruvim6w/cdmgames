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

@include('layouts.footer')
