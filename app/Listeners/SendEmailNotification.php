<?php

namespace App\Listeners;

use App\Events\Messages\Sent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param Sent $event
     * @return void
     */
    public function handle(Sent $event)
    {
        if ($event->from->role === 2) {
            $user = $event->dialog->users->where('id', '!=', 1)->first();
        } else {
            $user = $event->from;
        }

        $url = env('APP_URL').'/chat/'.$event->from->id;
        Mail::send('emails.admin_inbox', ['url' => $url], function($message) use ($user){
            $message->from(env('MAIL_USERNAME'), env('APP_NAME'));
            $message->to($user->email, $user->name)->subject('Новое сообщение на сайте');
        });
    }
}
