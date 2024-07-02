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

    .discount {
        color: var(--theme-color2);
        position: absolute;
        left: -.7rem;
        z-index: 1;
        font-family: var(--title-font);
        font-weight: bolder;
        font-size: 21pt;
        text-shadow:
            1px 1px 0 #4d1a1a,
            2px 2px 0 #6c2020,
            3px 3px 0 #9f1616,
            4px 4px 0 #d00000,
            5px 5px 0 #fb0000,
            20px 20px 30px rgba(0, 0, 0, 0.5);
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
                                @if ($gameItem->is_discount && $gameItem->discount)
                                    <span class="discount" title="{{$gameItem->discount_description}}">
                                        {{$gameItem->discount}}%
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
                                @if ($gameItem->is_discount && $gameItem->discount)
                                    <h5 class="palyer-card_name text-muted text-decoration-line-through">
                                        {{ $gameItem->getUndiscountedPrice() }} &#8381;
                                    </h5>
                                @endif
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
