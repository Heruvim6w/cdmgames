@include('layouts.header', ['title'=> $pageTitle ?? 'Документ'])
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
                $doc = isset($modelClass) ? $modelClass::latest()->first() : null;
            @endphp
            @if($doc && $doc->file)
                <iframe src="{{ asset('storage/' . $doc->file) }}" allowfullscreen></iframe>
            @else
                <div class="alert alert-warning">{{ $emptyText ?? 'PDF файл не загружен.' }}</div>
            @endif
        </div>
    </div>
</section>
@include('layouts.footer')
</body>
</html>
