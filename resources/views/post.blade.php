@include('layouts.header', ['title'=> 'Статьи'])

<!--==============================
    Team Area
    ==============================-->
<section class="vs-team-wrapper bg-title space-top space-extra-bottom">
    <div class="container">
        <div class="title-area">
            <div class="row">
                <div class="col">
                    <span class="sub-title">#CDMgames</span>
                    <h2 class="sec-title text-white text-uppercase">статьи</h2>
                    <div class="sec-shape">
                        <div class="sec-shape_bar"></div>
                        <div class="sec-shape_bar"></div>
                        <div class="sec-shape_bar"></div>
                    </div>
                </div>
                <div class="col text-end">
                    @livewire('search')
                </div>
            </div>
        </div>
        <div class="row" data-slide-show="3" data-arrows="true">
            @foreach($posts as $post)
                <div class="col-md-6 col-xl-4">
                    <div class="team-card pt-0 post">
                        <div class="team-card_shape"></div>
                        <div class="team-card_logo" style="background-image: url('{{ $post->image ? asset('storage/' . $post->image) : asset('assets/img/logo.png') }}')"></div>
                        <div class="team-card_content">
                            <div class="row pb-3">
                                <div class="col">{{ $post->created_at->format('d.m.y, H:i') }}</div>
                                <div class="col">
                                    <i class="fas fa-regular fa-eye"></i>
                                    {{ $post->view_count }}
                                </div>
                            </div>
                            <div class="team-card_time px-3 pb-3">{{ $post->title }}</div>
                            <div class="team-card_date px-3">
                                <?php
                                    $description = strip_tags($post->description);
                                ?>
                                {{ Str::limit($description, 200, ' ...') }}
                            </div>
                            <a href="{{ route('posts.show', [$post->slug]) }}" class="vs-btn">Читать пост</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@include('layouts.footer')
@livewireScripts
</body>

</html>
