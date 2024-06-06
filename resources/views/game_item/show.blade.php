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
                        <img src="{{
                                    $gameItem->image ?
                                    asset('storage/'.$gameItem->image) :
                                    asset('assets/img/logo.png')
                                }}"
                             alt="{{ $gameItem->title }}" class="w-100">
                        <div>
                            <span class="look_div">
                                <a href="{{ route('profile.update', 1) }}">
                                    <button
                                        class="vs-btn profile_vk_btn"
                                        style="width: 100%;"
                                    >
                                        Купить {{ $gameItem->title }}
                                    </button>
                                </a>
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
                            <div class="team-card_label mb-4">{{ $gameItem->price }}  &#8381;</div>
                            <div class="team-card_label mb-4">{!! $gameItem->description ?? '' !!}</div>
                        </div>

                        <div class="team-card_content text-start d-sm-block d-md-none">
                            <div class="team-card_label mb-4">{{ $gameItem->title }}</div>
                            <div class="team-card_label mb-4">{{ $gameItem->price }}  &#8381;</div>
                            <div class="team-card_label mb-4">{!! $gameItem->description ?? '' !!}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('layouts.footer')
