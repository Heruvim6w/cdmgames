<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}

