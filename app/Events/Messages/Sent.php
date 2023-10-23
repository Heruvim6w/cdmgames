<?php

namespace App\Events\Messages;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

use App\Models\User;
use App\Models\Dialog;
use App\Models\Message;

class Sent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var User - кто отправляет сообщение
     */
    public User $from;

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
     * @param Dialog $dialog
     * @param Message $message
     *
     * @return void
     */
    public function __construct(User $from, Dialog $dialog, Message $message)
    {
        $this->from = $from;
        $this->dialog = $dialog;
        $this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|PrivateChannel|array
     */
    public function broadcastOn(): Channel|PrivateChannel|array
    {
        if ($this->from === auth()->user() || $this->message->to_user === auth()->user()->id) {
            return new PrivateChannel('chat');
        }
    }
}
