<?php

namespace App\Models;

use Couchbase\Scope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'poster',
        'banner',
        'seo_description',
        'seo_keywords',
        'is_active',
        'sell_hint',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function gemesSellTable()
    {
        return $this->hasMany(\App\Nova\GamesSellTable::class);
    }

    public function linkLayout()
    {
        return $this->hasOne(LinkLayout::class);
    }

    /**
     * Подсказка для формы заявки
     */
    public function getSellHintAttribute($value)
    {
        return $value;
    }
}
