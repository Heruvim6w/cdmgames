@include('layouts.header', ['title' => $game->name,'seo_description' => $game->seo_description, 'seo_keywords' => $game->seo_keywords])
<style>
    table {
        margin: auto;
    }
    th {
        color: #fff;
    }
</style>
<!--==============================
  Palyer Area
  ============================== -->
<section class="vs-palyers-wrapper position-relative bg-dark space-top space-extra-bottom pt-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-11">
                <div class="row">
                    <div class="col-lg-12 col-xl-12">
                        <p class="text-white mt-n1">{!! $game->description !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('layouts.footer')
