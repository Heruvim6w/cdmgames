@include('layouts.header', ['title'=> 'Отзывы'])
<style>
    .team-card_time {
        font-size: 20px;
        margin-bottom: 8px;
        padding: 1em;
    }
    .avatar {
        border-radius: 50%;
    }

    svg.w-5.h-5 {
        width: 35px;
    }
</style>
<!--==============================
    Team Area
    ==============================-->
<section class="vs-team-wrapper bg-title space-top space-extra-bottom">
    <div class="container">
        <div class="title-area">
            <div class="row">
                <div class="col-12 col-sm-2">
                    <span class="sub-title">#CDMgames</span>
                    <h2 class="sec-title text-white text-uppercase">отзывы</h2>
                    <div class="sec-shape">
                        <div class="sec-shape_bar"></div>
                        <div class="sec-shape_bar"></div>
                        <div class="sec-shape_bar"></div>
                    </div>
                </div>
                <div class="col-12 col-sm-8 row rating_text">
                    <div class="team-card col-12 col-sm-5">
                        <div class="team-card_content mx-30 text-start text-white">
                            {!! $reviewsLeft->content ?? '' !!}
                        </div>
                    </div>
                    <div class="team-card col-12 col-sm-5 offset-md-1">
                        <div class="team-card_content mx-30 text-start text-white">
                            @if($reviewsRight->content)
                                {!! $reviewsRight->content !!}
                            @else
                                <p style= "font-size: 20px;">Рейтинг:
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star"></i>
                                    @endfor
                                </p>
                                <p style= "font-size: 20px;">На основе {{ $reviews->total() + 1898 }} отзывов</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section class="vs-team-wrapper bg-title space">
            <div class="container">
                <div class="row z-index-common">
                    @foreach($reviews as $review)
                        <div class="col-md-6 col-xl-4">
                            <div class="team-card">
                                <div class="team-card_shape"></div>
                                <div class="team-card_logo">
                                    @if($review->vk_user_avatar !== 'no_avatar')
                                        <img class="avatar" src="{{ $review->vk_user_avatar }}" alt="User avatar">
                                    @else
                                        <img class="avatar" src="{{ asset('assets/img/icon/no_avatar.webp') }}" alt="User avatar" style="width:100px; height:100px">
                                    @endif
                                </div>
                                <div class="team-card_content">
                                    <span class="team-card_label">{{ $review->vk_user_name }}</span>
                                    <div class="team-card_links">
                                        <a href="{{ $review->vk_user_id }}"><i class="fab fa-vk"></i></a>
                                    </div>
                                    <div class="team-card_time">{{ $review->comment }}</div>
                                    <div class="team-card_date">{{ $review->comment_date }}</div>
                                    <a href="https://vk.com/topic-176494199_40223406?post={{ $review->comment_id }}" class="vs-btn">Читать в ВК</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{ $reviews->links() }}
                </div>
            </div>
        </section>
    </div>
</section>
@include('layouts.footer')

</body>

</html>
