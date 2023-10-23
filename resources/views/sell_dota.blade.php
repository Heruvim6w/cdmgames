@include('layouts.header')

<style>
    .container{
        background-color: #1C1C1C;
    }
</style>

<section>
    <div class="container mb-30">
        <div class="title-area">
            <span class="sub-title">#CDMgames</span>
            <h2 class="sec-title text-white text-uppercase">Оплата за рейтинг</h2>
            <div class="sec-shape">
                <div class="sec-shape_bar"></div>
                <div class="sec-shape_bar"></div>
                <div class="sec-shape_bar"></div>
            </div>
        </div>
        <div class="d-flex align-items-center justify-content-center">
            <div class="content">
                {!! $data->content !!}
            </div>
        </div>
    </div>
</section>

@include('layouts.footer')

</body>

</html>
