<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Message
 * @package App\Models
 * @property-read \App\Models\User $user
 */
class Message extends Model
{
    use HasFactory;

    public mixed $to_user;

    public function __construct(array $attributes = [])
    {
        $this->fillable = [
            "user_id",
            "text",
            "file",
            "to_user",
        ];

        parent::__construct($attributes);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class)
            ->withDefault([
                "id" => -1,
                "name" => "DELETED",
            ]);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dialog()
    {
        return $this->belongsTo(Dialog::class);
    }
}
