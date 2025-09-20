<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $telegram
 * @property int $game_id
 * @property string $description
 * @property array $media
 */
class SellApplication extends Model
{
    protected $fillable = [
        'telegram',
        'game_id',
        'description',
        'media',
    ];

    protected $casts = [
        'media' => 'array',
    ];

    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }
}

