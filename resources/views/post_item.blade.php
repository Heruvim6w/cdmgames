@include('layouts.header', ['title' => $post->title, 'seo_description' => $post->seo_description, 'seo_keywords' => $post->seo_keywords])

<style>
    .header-breadcrumb {
        display: none;
    }

     table {
         margin: auto;
     }
</style>

<!--==============================
Breadcumb
============================== -->
<div class="breadcumb-wrapper"
     data-overlay="title"
     data-opacity="5"
     style="background-image: url('{{ $post->image ? asset('storage/' . $post->image) : asset('assets/img/logo.png') }}');
         background-repeat: no-repeat;
         background-position: center center;
         background-size: cover;
         height: auto;">
    {{--    <div class="parallax" data-bg-class="bg-title"--}}
    {{--         data-parallax-image="{{ $post->image ? asset('storage/' . $post->image) : asset('assets/img/logo.png') }}">--}}
    {{--    </div>--}}
    <div class="container z-index-common position-relative post_title" style="z-index: 6;">
        <div class="col-12 bottom-0 start-0">
            <h1 class="text-white">{!! $post->title !!}</h1>
        </div>
        <div class="row bottom-0 start-0">
            <div class="col">
                {{ $post->created_at->format('d.m.y, H:i') }}
                <i class="fas fa-regular fa-eye ml-15"></i>
                {{ $post->view_count }}
            </div>
        </div>
    </div>
</div>

<!--==============================
  Palyer Area
  ============================== -->
<section class="vs-palyers-wrapper position-relative bg-dark space-extra-bottom">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-11">
                <div class="row">
                    <div class="col-xl-11 mb-30 mb-lg-5">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-xl-12 mb-10 mb-lg-0">
                        <span class="text-white mt-n1">
                            {!! $post->description !!}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('layouts.footer')
