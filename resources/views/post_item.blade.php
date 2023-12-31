@include('layouts.header')

<!--==============================
  Palyer Area
  ============================== -->
<section class="vs-palyers-wrapper position-relative bg-dark space-top space-extra-bottom">
    <div class="text-shape-2">{{ $post->title }}</div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-11">
                <div class="row">
                    <div class="col-xl-11 mb-30 mb-lg-5">
                        <div class="player-img">
                            <img src="{{ $post->image ?? asset('assets/img/about/cdmdoto.jpg') }}" alt="CDMgames" class="w-100">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-xl-5 mb-10 mb-lg-0">
                        <div class="player-info-area">
                            <span class="sub-title text-theme mb-2 pb-1">#{!! $post->title !!}</span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-7">
                        <p class="text-white mt-n1">
                            {!! $post->description !!}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('layouts.footer')
