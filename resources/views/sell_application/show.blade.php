@extends('layouts.app')

@section('content')
<div class="container py-5">
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
            <hr>
            <div class="d-flex align-items-center gap-3">
                <a href="{{ config('services.telegram_bot_link') }}" target="_blank" class="btn btn-success">
                    Перейти в бота
                </a>
                <div>
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ urlencode(config('services.telegram_bot_link')) }}" alt="QR-код Telegram бота">
                    <div class="small text-muted">QR-код для перехода в Telegram-бота</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

