<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Dialog
 * @package App
 *
 * @property int $id
 * @property int $user_id - создатель диалога
 *
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property-read \App\Models\User[]|\Illuminate\Database\Eloquent\Collection $users
 * @property-read \App\Models\Message[]|\Illuminate\Database\Eloquent\Collection $messages
 */
class Dialog extends Model
{

    public function __construct(array $attributes = [])
    {
        $this->fillable = [
            "user_id",
            "read_by_admin",
            "read_by_user",
        ];

        parent::__construct($attributes);
    }

    protected static function boot() {
        parent::boot();

        static::deleting(function ($dialog) {
            $dialog->messages()->delete();
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this
            ->belongsToMany(User::class)
            ->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this
            ->hasMany(Message::class)
            ->with("user");
    }
}
