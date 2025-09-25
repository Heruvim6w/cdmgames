<?php

namespace App\Services;

use App\Models\SellApplication;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use RuntimeException;

class SellApplicationService
{
    /**
     * Обработка и сохранение заявки
     *
     * @param Request $request The HTTP request containing data for the sell application.
     * @return SellApplication The created sell application model instance.
     * @throws RuntimeException If the combined size of media files exceeds 70 MB.
     */
    public function handle(Request $request): SellApplication
    {
        // Проверка общего размера файлов
        if ($request->hasFile('media')) {
            $this->checkSize($request->file('media'));
        }

        // Сохраняем файлы
        $mediaPaths = [];
        if ($request->hasFile('media')) {
            $mediaPaths = $this->setMediaPaths($request->file('media'));
        }

        // Сохраняем заявку в БД
        /** @var SellApplication $application */
        $application = SellApplication::query()->create([
            'telegram' => $request->telegram,
            'game_id' => $request->game,
            'description' => $request->description,
            'media' => $mediaPaths,
        ]);

        return $application;
    }

    /**
     * @param UploadedFile[] $files
     *
     * @throws RuntimeException If the total file size exceeds the allowed limit.
     */
    private function checkSize(array $files): void
    {
        $totalSize = 0;

        foreach ($files as $file) {
            $totalSize += $file->getSize();
        }
        if ($totalSize > 20 * 1024 * 1024) {
            throw new RuntimeException('Суммарный размер файлов не должен превышать 20Мб');
        }
    }

    /**
     * @param UploadedFile[] $files
     *
     * @return string[] List of stored file paths.
     */
    private function setMediaPaths(array $files): array
    {
        $mediaPaths = [];

        foreach ($files as $file) {
            $filename = Str::random() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('sell_requests', $filename, 'public');
            $mediaPaths[] = $path;
        }

        return $mediaPaths;
    }
}

