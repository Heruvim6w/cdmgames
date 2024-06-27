@include('layouts.header', [
    'title' => $gameItem->title,
    'seo_description' => $gameItem->gameForItem->seo_description,
    'seo_keywords' => $gameItem->gameForItem->seo_keywords
    ])

<style>
    .text-marked {
        color: #f00;
    }
</style>
<section class="vs-team-wrapper bg-title space">
    <div class="container">
        <div class="row z-index-common">
            <div class="col-md-6 col-lg-4 col-xl-3">
                <div class="palyer-card">
                    <div class="palyer-card_img">
                        @if ($gameItem->quantity)
                            <span class="fire" title="Ограниченное количество">
                                <i class="far fa-duotone fa-fire"></i>
                            </span>
                        @endif
                        <img src="{{
                                    $gameItem->image ?
                                    asset('storage/'.$gameItem->image) :
                                    asset('assets/img/logo.png')
                                }}"
                             alt="{{ $gameItem->title }}" class="w-100">
                        <div>
                                <span class="look_div">
                                    <button
                                        class="vs-btn profile_btn"
                                        data-bs-toggle="modal"
                                        data-bs-target="#buy_item"
                                    >
                                         Купить {{ $gameItem->title }}
                                    </button>
                                </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9 col-xl-7">
                <div class="row">
                    <div class="team-card">
                        <div class="team-card_content ml-30 text-start d-none d-lg-block">
                            <div class="team-card_label mb-4">{{ $gameItem->title }}</div>
                            <div class="team-card_label mb-4">
                                Цена: <span class="text-marked">{{ $gameItem->price }}</span>  &#8381;
                            </div>
                            @if ($gameItem->quantity)
                                <div class="team-card_label mb-4">
                                    Осталось: <span class="text-marked">{{ $gameItem->quantity }}</span> шт.
                                </div>
                            @endif
                            <div class="team-card_label mb-4">{!! $gameItem->description ?? '' !!}</div>
                        </div>

                        <div class="team-card_content text-start d-sm-block d-md-none">
                            <div class="team-card_label mb-4">{{ $gameItem->title }}</div>
                            <div class="team-card_label mb-4">
                                Цена: <span class="text-marked">{{ $gameItem->price }}</span>  &#8381;
                            </div>
                            @if ($gameItem->quantity)
                                <div class="team-card_label mb-4">
                                    Осталось: <span class="text-marked">{{ $gameItem->quantity }}</span> шт.</div>
                            @endif
                            <div class="team-card_label mb-4">{!! $gameItem->description ?? '' !!}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('layouts.buy_item')
@include('layouts.footer')
