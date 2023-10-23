<?php

namespace App\Events\Messages;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

use App\Models\User;
use App\Models\Dialog;
use App\Models\Message;

class Received
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var User - кто отправляет сообщение
     */
    public User $from;

    /**
     * @var User - кто отправляет сообщение
     */
    public User $to;

    /**
     * @var Dialog - куда отправляется сообщение
     */
    public Dialog $dialog;

    /**
     * @var Message - сообщение
     */
    public Message $message;

    /**
     * Create a new event instance.
     *
     * @param User $from
     * @param User $to
     * @param Dialog $dialog
     * @param Message $message
     *
     * @return void
     */
    public function __construct(User $from, User $to, Dialog $dialog, Message $message)
    {
        $this->from = $from;
        $this->to = $to;
        $this->dialog = $dialog;
        $this->message = $message;
    }
}
