@include('layouts.header', ['title'=> 'Пользовательское соглашение'])
<style>
    body {
        background-color: var(--title-color) !important;
    }
    .offer-pdf-viewer {
        margin: 30px 0;
        text-align: center;
    }
    .offer-pdf-viewer iframe {
        width: 100%;
        min-height: 800px;
        border: 1px solid #ccc;
        border-radius: 8px;
    }
</style>
<section>
    <div class="container">
        <div class="offer-pdf-viewer">
            @php
                $offerDoc = \App\Models\OfferDocument::latest()->first();
            @endphp
            @if($offerDoc && $offerDoc->file)
                <iframe src="{{ asset('storage/' . $offerDoc->file) }}" allowfullscreen></iframe>Obsolete
            @else
                <div class="alert alert-warning">PDF файл оферты не загружен.</div>
            @endif
        </div>
    </div>
</section>
@include('layouts.footer')
</body>
</html>
