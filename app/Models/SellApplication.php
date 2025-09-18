<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

