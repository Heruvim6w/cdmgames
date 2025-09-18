<?php

namespace App\Services;

use App\Models\SellApplication;
use Illuminate\Support\Facades\Http;

class TelegramNotificationService
{
    public function sendSellApplication(SellApplication $application): void
    {
        $botUrl = 'https://rude-seals-cover.loca.lt';//config('services.telegram_bot_url');
        //$chatId = config('services.telegram_chat_id');
        $gameName = $application->game ? str_replace('Продать аккаунт ', '', $application->game->name) : 'Не указано';
        $text = "Заявка #{$application->id}\nTelegram: {$application->telegram}\nИгра: {$gameName}\nОписание: {$application->description}";
        if (!empty($application->media)) {
            $text .= "\nФайлы:\n" . implode("\n", array_map(fn($p) => asset('storage/'.$p), $application->media));
        }
        if ($botUrl) {
            Http::post($botUrl . '/new_application', [
                //'chat_id' => $chatId,
                'text' => $text,
                'parse_mode' => 'HTML',
            ]);
        }
    }
}

