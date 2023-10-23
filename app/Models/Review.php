<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int         $id
 * @property string      $vk_user_id
 * @property int         $comment_id
 * @property string      $comment
 * @property string      $vk_user_name
 * @property string      $vk_user_avatar
 * @property Carbon|null $comment_date
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $email_verified_at
 * @property Carbon|null $deleted_at
 * @property-read Collection|Dialog[] $dialogs
 *
 * @mixin \Eloquent
 */
class Review extends Model
{
    use HasFactory;
}
