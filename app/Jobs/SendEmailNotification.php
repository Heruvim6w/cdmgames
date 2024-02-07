<?php

namespace App\Jobs;

use App\Http\Controllers\VkBotController;
use App\Models\Message;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var User
     */
    protected $toUser;

    /**
     * @var User
     */
    protected $fromUser;

    /**
     * @var Message
     */
    protected $message;

    /**
     * Create a new job instance.
     *
     * @param User $toUser
     * @param User $fromUser
     * @param Message $message
     */
    public function __construct(User $toUser, User $fromUser, Message $message)
    {
        $this->toUser = $toUser;
        $this->fromUser = $fromUser;
        $this->message = $message->text;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user = $this->toUser;
        $from = $this->fromUser;
        $message = !empty($this->message) ? $this->message : 'Нет текста. Возможно, картинка в сообщении...';
        if ($user->role === 2) {
            $vkBot = new VkBotController();
            $messageToNotifyVk ='Эй! ' . $from->name . ' написал на сайте! Сообщение: ' . $message;

            $vkBot->sendMessageFromBot(config('vk.notifyVkLink'), $messageToNotifyVk);
        }
        $url = env('APP_URL').'/chat/'.$this->fromUser->id;
//        Mail::send('emails.admin_inbox', ['url' => $url], function($message) use ($user){
//            $message->from(config('mail.mailers.smtp.username'), config('app.name'));
//            $message->to($user->email, $user->name)->subject('Новое сообщение на сайте');
//        });
    }
}
