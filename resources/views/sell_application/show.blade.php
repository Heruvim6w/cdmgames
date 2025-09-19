@extends('layouts.app')
<style>
    main.py-4 {
        padding-top: unset !important;
    }

    .navbar.navbar-expand-md.navbar-light.bg-white.shadow-sm {
        display: none;
    }
</style>
@section('content')
    @include('layouts.header')

    <section class="vs-palyers-wrapper bg-dark position-relative space-top space-extra-bottom">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Заявка №{{ $application->id }}</h4>
                        </div>
                        <div class="card-body">
                            <p><strong>Telegram:</strong> {{ $application->telegram }}</p>
                            <p><strong>Игра:</strong> {{ $application->game->name ?? '-' }}</p>
                            <p><strong>Описание:</strong> {{ $application->description }}</p>
                            <p><strong>Файлы:</strong>
                                @if($application->media && count($application->media))
                                    <ul>
                                        @foreach($application->media as $file)
                                            <li><a href="{{ asset('storage/' . $file) }}" target="_blank">{{ basename($file) }}</a></li>
                                        @endforeach
                                    </ul>
                                @else
                                    <span>Нет файлов</span>
                                @endif
                            </p>
                            <p>
                                <img
                                    src="{{ asset('assets/img/application_flow.webp') }}"
                                    alt="application_flow"
                                    class="application_flow"
                                >
                            </p>
                            <hr>
                            <div class="d-flex align-items-center gap-3 justify-content-center">
                                <a href="{{ config('services.telegram_bot_link') }}" target="_blank" class="btn btn-success">
                                    Перейти в бота
                                </a>
                                <div>
                                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ urlencode(config('services.telegram_bot_link')) }}" alt="QR-код Telegram бота">
                                    <div class="small text-muted text-center">Telegram-бот</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('layouts.footer')
@endsection
