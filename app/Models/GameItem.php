<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $image
 * @property float $price
 * @property int $quantity
 * @property GameForItem $gameForItem
 */
class GameItem extends Model
{
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function gameForItem(): BelongsTo
    {
        return $this->belongsTo(GameForItem::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
