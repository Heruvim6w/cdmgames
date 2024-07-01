<?php declare(strict_types = 1);


namespace App\Managers;

use App\Models\Dialog;
use App\Models\Message;
use App\Models\User;
use App\Events\Messages\Sent;
use App\Events\Messages\Received;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Events\Dispatcher as EventsDispatcher;

class MessagesManager
{
    /**
     * @var DialogManager
     */
    protected DialogManager $dialogManager;

    /**
     * @var EventsDispatcher
     */
    protected EventsDispatcher $eventsDispatcher;

    public function __construct(DialogManager $dialogManager, EventsDispatcher $eventsDispatcher)
    {
        $this->dialogManager = $dialogManager;
        $this->eventsDispatcher = $eventsDispatcher;
    }

    /**
     * @param Dialog $dialog
     * @return LengthAwarePaginator
     */
    public function findFromDialog(Dialog $dialog): LengthAwarePaginator
    {
        return $dialog->messages()->latest()->paginate(25);
    }

    /**
     * @ToDo
     *
     * @param Dialog $dialog
     * @return LengthAwarePaginator
     */
    public function findUnreadFromDialog(Dialog $dialog): LengthAwarePaginator
    {
        return $dialog->messages()->latest()->paginate(25);
    }

    /**
     * @param User $from
     * @param Dialog $dialog
     * @param User $to
     * @param array|null $data
     * @return array
     */
    public function sendToDialog(
        User $from,
        Dialog $dialog,
        User $to,
        array $data = null
    ): array {
        /** @var Message $message */
        $message = $dialog->messages()->create([
            "user_id" => $from->id,
            "text" => $data["text"] ? $this->makeClickable($data["text"]) : '',
            "file" => $data["images"] ?? null,
            "to_user" => $to->id,
        ]);

        broadcast(new Sent($from, $dialog, $message));

        foreach ($dialog->users->diff(collect([$from])) as $to) {
            $this->eventsDispatcher->dispatch(new Received(
                $from,
                $to,
                $dialog,
                $message
            ));
        }

        return [$dialog, $message];
    }

    /**
     * @param User $from
     * @param User $to
     * @param array $data
     * @return array
     */
    public function sendToUser(
        User $from,
        User $to,
        array $data
    ): array {
        return $this->sendToDialog(
            $from,
            $this->dialogManager->findOrCreateDialogWithUsers(
                $from,
                $to
            ),
            $to,
            $data
        );
    }

    /**
     * @param User $from
     * @param Dialog $dialog
     * @return bool
     */
    public function canSendToDialog(
        User $from,
        Dialog $dialog
    ): bool {
        // если в диалоге 2 человека
        if ($dialog->users->count() == 2) {
            /** @var User $to */
            $to = $dialog->users->diff(collect([$from]))->first();

            // отправитель находится в черном списке получателя
            if ($to->blacklist->pluck("to_id")->search($from->id) !== false) {
                return false;
            }
        }

//        // отправка только с рейтингом N+
//        if ($from->rating < $this->settingsManager->get("rating_to_send_message")) {
//            return false;
//        }

        return true;
    }

    /**
     * @param User $from
     * @param User $to
     * @return bool
     */
    public function canSendToUser(
        User $from,
        User $to
    ): bool {
        // запрещена отправка самому себе
        if ($from->is($to)) {
            return false;
        }

        // отправитель находится в черном списке получателя
//        if ($to->blacklist->pluck("to_id")->search($from->id) !== false) {
//            return false;
//        }

//        // отправка только с рейтингом N+
//        if ($from->rating < $this->settingsManager->get("rating_to_send_message")) {
//            return false;
//        }

        return true;
    }

    /**
     * Make clickable links from URLs in text.
     * @param $text
     * @return string|string[]|null
     */
    private function makeClickable($text)
    {
        if (str_contains($text, 'http')) {
            $regex = '#\bhttps?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#';
        } else {
            $regex = '/([\w+]+\:\/\/)?([\w\d-]+\.)*[\w-]+[\.\:]\w+([\/\?\=\&\#\.]?[\w-]+)*\/?/';
        }

        return preg_replace_callback($regex, function ($matches) {
            if (str_contains($matches[0], 'http')) {
                $link = "<a href={$matches[0]} target='_blank'>{$matches[0]}</a>";
            } else {
                $link = "<a href=https://{$matches[0]} target='_blank'>{$matches[0]}</a>";
            }
            return $link;
        }, $text);
    }
}
