<?php

namespace App\Broadcasting;

use App\Models\User;

class ChatChannel
{

    /**
     * Authenticate the user's access to the channel.
     *
     * @return array|bool
     */
    public function join(): bool|array
    {
        return auth()->check();
    }
}
