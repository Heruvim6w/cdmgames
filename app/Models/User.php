<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class User
 * @package App\Models
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $email
 * @property string|null $avatar
 * @property string|null $vk_link
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $email_verified_at
 * @property Carbon|null $deleted_at
 * @property int $role
 * @property bool $is_banned
 * @property-read Collection|Dialog[] $dialogs
 *
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    public const REGISTERED_AT     = "registered_at";
    public const UPDATED_AT        = "updated_at";
    public const EMAIL_VERIFIED_AT = "email_verified_at";
    public const ADMIN             = 2;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'vk_link',
        'balance',
        'withdrawal',
        'is_banned',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * @var array
     */
    protected $dates = [
        self::REGISTERED_AT,
        self::UPDATED_AT,
        self::EMAIL_VERIFIED_AT,
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function boot() {
        parent::boot();

        static::deleting(function ($user) {
            $user->withdrawalApplications()->delete();
            $dialogId = $user->dialogs()->first()->id;
            $user->dialogs()->delete();
            Message::where('dialog_id', $dialogId)->delete();
            DB::table('dialog_user')->where('dialog_id', $dialogId)->delete();        });
    }

    /**
     * @return BelongsToMany
     */
    public function dialogs(): BelongsToMany
    {
        return $this->belongsToMany(Dialog::class);
    }

    /**
     * @return HasMany
     */
    public function withdrawalApplications(): HasMany
    {
        return $this->hasMany(WithdrawalApplication::class);
    }

    /**
     * @return HasMany
     */
    public function requisites(): HasMany
    {
        return $this->hasMany(Requisite::class);
    }

    /**
     * @return HasMany
     */
    public function accounts(): HasMany
    {
        return $this->hasMany(Account::class);
    }

    /**
     * @return HasMany
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
