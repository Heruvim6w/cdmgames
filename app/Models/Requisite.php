<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Requisite
 * @package App\Models
 * @property int $id
 * @property int $withdrawal_method_id
 * @property string $value
 */
class Requisite extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'withdrawal_method_id',
        'user_id',
        'value',
        'confirm',
        'hash',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function withdrawalMethod(): BelongsTo
    {
        return $this->belongsTo(WithdrawalMethod::class);
    }
}
