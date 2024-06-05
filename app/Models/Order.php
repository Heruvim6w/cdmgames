<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property User $user
 * @property GameItem $gameItem
 * @property int $status
 * @property float $price
 */
class Order extends Model
{
    public const NEW = 0;
    public const PAID = 1;
    public const COMPLETED = 2;
    public const CANCELLED = 3;
    public const ERROR = 4;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function gameItem(): BelongsTo
    {
        return $this->belongsTo(GameItem::class);
    }
}
