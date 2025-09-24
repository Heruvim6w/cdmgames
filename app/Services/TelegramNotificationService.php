<?php

namespace App\Services;

use App\Models\SellApplication;
use Illuminate\Support\Facades\Http;

class TelegramNotificationService
{
    public function sendSellApplication(SellApplication $application): void
    {
        $botUrl = config('services.telegram_bot_url');
        $gameId = $application->game_id ?? null;
        $gameName = $application->game ? str_replace('Продать аккаунт ', '', $application->game->name) : 'Не указано';
        $text = "Заявка #{$application->id}\nTelegram: {$application->telegram}\nИгра: {$gameName}\nID игры: {$gameId}\nОписание: {$application->description}";
        if (!empty($application->media)) {
            $text .= "\nФайлы:\n" . implode("\n", array_map(fn($p) => asset('storage/'.$p), $application->media));
        }
        if ($botUrl) {
            Http::post($botUrl . '/new_application', [
                'text' => $text,
                'parse_mode' => 'HTML',
            ]);
        }
    }
}

