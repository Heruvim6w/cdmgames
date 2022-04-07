@include('layouts.header')
<style>
    .team-card_time {
        font-size: 20px;
        margin-bottom: 8px;
        padding: 1em;
    }
    .avatar {
        border-radius: 50%;
    }
</style>
<!--==============================
    Team Area
    ==============================-->
<section class="vs-team-wrapper bg-title space-top space-extra-bottom">
    <div class="container">
        <div class="title-area">
            <span class="sub-title">#CDMgames</span>
            <h2 class="sec-title text-white text-uppercase">отзывы</h2>
            <div class="sec-shape">
                <div class="sec-shape_bar"></div>
                <div class="sec-shape_bar"></div>
                <div class="sec-shape_bar"></div>
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
                            <img class="avatar" src="{{ $review->vk_user_avatar ?? asset('assets/img/logo.png') }}" alt="User avatar">
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
        </div>
    </div>
</section>
@include('layouts.footer')
</body>

</html>
