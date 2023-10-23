@include('layouts.header')
<script>
    import UpdateLinkLayout from "../js/components/UpdateLinkLayout";
    export default {
        components: {UpdateLinkLayout}
    }
</script>
<style>
    .breadcumb-wrapper {
        display: none;
    }
</style>
<section class="vs-palyers-wrapper bg-dark position-relative space-extra-bottom">
    <div class="container">
        <div class="new_layout">
            <div class="scroll-btn show plus_btn" data-bs-toggle="modal" data-bs-target="#new_layout">
                <i class="far fa-plus"></i>
            </div>
        </div>
        <div class="row justify-content-center gx-5">
            @foreach($layouts as $layout)
                <div class="layout_link col-md-6 col-lg-4 col-xl-3 m-3 bg-mock-dark" data-bs-toggle="modal" data-bs-target="#layout_{{ $layout->id }}">
                    <h3 class="palyer-card_name text-inherit text-center">{{ $layout->title }}</h3>
                    <div>{{ Str::limit(strip_tags($layout->content), 200, '...') }}</div>
                </div>
            @endforeach
                <div id="app">
                    <update-link-layout :layouts="{{ $layouts }}"></update-link-layout>
                </div>
                <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
                <script type="module" src="{{ asset('js/app.js') }}"></script>
        </div>
    </div>
</section>
@include('layouts.footer')
</body>

</html>
