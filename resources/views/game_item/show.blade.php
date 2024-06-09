@include('layouts.header', [
    'title' => $gameItem->title,
    'seo_description' => $gameItem->gameForItem->seo_description,
    'seo_keywords' => $gameItem->gameForItem->seo_keywords
    ])

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
                            <form
                                enctype="multipart/form-data"
                                name="order_store"
                                action="{{ route('orders.store') }}"
                                method="post">
                                @csrf
                                <input type="hidden" name="game_item" value="{{ $gameItem->id }}">
                                <input type="hidden" name="price" value="{{ $gameItem->price }}">
                                <button
                                    name="order_store"
                                    id="order_store"
                                    type="submit"
                                    class="btn vs-btn"
                                    style="width: 100%;">
                                    Купить {{ $gameItem->title }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9 col-xl-7">
                <div class="row">
                    <div class="team-card">
                        <div class="team-card_content ml-30 text-start d-none d-lg-block">
                            <div class="team-card_label mb-4">{{ $gameItem->title }}</div>
                            <div class="team-card_label mb-4">{{ $gameItem->price }}  &#8381;</div>
                            @if ($gameItem->quantity)
                                <div class="team-card_label mb-4">
                                    Осталось: {{ $gameItem->quantity }} шт.
                                </div>
                            @endif
                            <div class="team-card_label mb-4">{!! $gameItem->description ?? '' !!}</div>
                        </div>

                        <div class="team-card_content text-start d-sm-block d-md-none">
                            <div class="team-card_label mb-4">{{ $gameItem->title }}</div>
                            <div class="team-card_label mb-4">{{ $gameItem->price }}  &#8381;</div>
                            @if ($gameItem->quantity)
                                <div class="team-card_label mb-4">Осталось: {{ $gameItem->quantity }} шт.</div>
                            @endif
                            <div class="team-card_label mb-4">{!! $gameItem->description ?? '' !!}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('layouts.footer')
