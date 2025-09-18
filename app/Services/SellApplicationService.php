<?php

namespace App\Services;

use App\Models\SellApplication;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SellApplicationService
{
    /**
     * Обработка и сохранение заявки
     * @throws \Exception
     */
    public function handle(Request $request): Builder|Model
    {
        // Проверка общего размера файлов
        $totalSize = 0;
        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $file) {
                $totalSize += $file->getSize();
            }
            if ($totalSize > 70 * 1024 * 1024) {
                throw new \RuntimeException('Суммарный размер файлов не должен превышать 70Мб');
            }
        }

        // Сохраняем файлы
        $mediaPaths = [];
        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $file) {
                $filename = Str::random() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('sell_requests', $filename, 'public');
                $mediaPaths[] = $path;
            }
        }

        // Сохраняем заявку в БД
        return SellApplication::query()->create([
            'telegram' => $request->telegram,
            'game_id' => $request->game,
            'description' => $request->description,
            'media' => $mediaPaths,
        ]);
    }
}

