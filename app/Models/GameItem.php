<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

/**
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $image
 * @property float $price
 * @property int $discount
 * @property string $discount_description
 * @property bool $is_discount
 * @property int $quantity
 * @property GameForItem $gameForItem
 */
class GameItem extends Model implements Sortable
{
    use SortableTrait;

    public array $sortable = [
        'order_column_name' => 'sort_order',
        'sort_when_creating' => true,
        'nova_order_by' => 'ASC',
    ];

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

    public function getUndiscountedPrice(): float|int
    {
        return $this->price / (1 - $this->discount / 100);
    }

}
