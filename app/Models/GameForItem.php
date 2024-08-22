<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $title
 * @property string $image
 * @property Collection|GameItem[] $gameItems
 */
class GameForItem extends Model
{
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function gameItems(): HasMany
    {
        return $this->hasMany(GameItem::class);
    }
}
