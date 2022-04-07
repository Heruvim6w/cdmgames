@include('layouts.header')
<!--==============================
    Team Area
    ==============================-->
<section class="vs-team-wrapper bg-title space-top space-extra-bottom">
    <div class="container">
        <div class="title-area">
            <span class="sub-title">#CDMgames</span>
            <h2 class="sec-title text-white text-uppercase">статьи</h2>
            <div class="sec-shape">
                <div class="sec-shape_bar"></div>
                <div class="sec-shape_bar"></div>
                <div class="sec-shape_bar"></div>
            </div>
        </div>
        <div class="row team-card_slider vs-carousel" data-slide-show="3" data-arrows="true">
            @foreach($posts as $post)
                <div class="col-md-6 col-xl-4">
                    <div class="team-card">
                        <div class="team-card_shape"></div>
                        <div class="team-card_logo">
                            <img src="{{ $post->image ?? asset('storage/assets/img/logo.png') }}" alt="Post image">
                        </div>
                        <div class="team-card_content">
                            <span class="team-card_label">CDMgames</span>
                            <div class="team-card_links">
                                <a href="https://vk.com/cdmgames"><i class="fab fa-vk"></i></a>
                            </div>
                            <div class="team-card_time">{{ $post->title }}</div>
                            <div class="team-card_date">{{ $post->published_at }}</div>
                            <a href="{{ route('posts.show', [$post->id]) }}" class="vs-btn">Читать пост</a>
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
