@include('layouts.header', [
    'title' => $gameForItem->title,
    'seo_description' => $gameForItem->seo_description,
    'seo_keywords' => $gameForItem->seo_keywords
    ])

<style>
    .fire {
        position: absolute;
        z-index: 1;
        left: 90%;
        top: 5%;
        font-size: 15pt;
        color: #f50;
    }
</style>
<section class="vs-palyers-wrapper position-relative bg-dark space-top space-extra-bottom pt-5">
    <div class="container">
        <div class="row justify-content-center">
            @foreach($gameItems as $gameItem)
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="palyer-card">
                        <a href="{{ route('store.show', [$gameItem->id]) }}">
                            <div class="palyer-card_img">
                                @if ($gameItem->quantity)
                                    <span class="fire" title="Ограниченное количество">
                                        <i class="far fa-duotone fa-fire"></i>
                                    </span>
                                @endif
                                <img src="{{ asset('storage/' . $gameItem->image) }}"
                                     alt="{{ $gameItem->title }}" class="w-100" width="317.5" height="178.6">
                            </div>
                            <div class="palyer-card_content">
                                <span class="palyer-card_degi">Смотреть товар</span>
                                <h3 class="palyer-card_name text-inherit">{{ $gameItem->title }}</h3>
                            </div>
                            <div class="text-center">
                                <span class="palyer-card_degi">{{ $gameItem->title }}</span>
                                <h3 class="palyer-card_name text-inherit">{{ $gameItem->price }} &#8381;</h3>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="vs-palyers-wrapper position-relative bg-dark space-top space-extra-bottom pt-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-11">
                <div class="row">
                    <div class="col-lg-12 col-xl-12">
                        <p class="text-white mt-n1">{!! $gameForItem->description !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('layouts.footer')
