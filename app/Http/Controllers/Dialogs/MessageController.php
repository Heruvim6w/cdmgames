<?php

namespace App\Http\Controllers\Dialogs;

use App\Http\Resources as Resources;
use App\Http\Controllers\Controller;
use App\Http\Requests\Messages\Store;
use App\Jobs\SendEmailNotification;
use App\Models\Message;
use Carbon\Carbon;
use Composer\Util\Zip;
use Illuminate\Http\Response;
use App\Managers\MessagesManager;
use App\Models\User;
use App\Models\Dialog;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use File;
use JsonException;

class MessageController extends Controller
{
    /**
     * @var MessagesManager
     */
    protected MessagesManager $messagesManager;

    public function __construct(MessagesManager $messagesManager)
    {
        $this->messagesManager = $messagesManager;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Dialog $dialog
     * @return Response
     */
    public function index(Dialog $dialog): Response
    {
        $messages = $this->messagesManager->findFromDialog($dialog);

        return response()->jsonSuccess([
            'messages' => new Resources\Dialogs\MessageCollection($messages),
        ]);
    }

    /**
     * @throws JsonException
     */
    public function storeRoot(Store $request)
    {
        $data = $request->validated();
        $toUser = User::query()->find($data["to"]);

        /** @var User $fromuser */
        $fromUser = auth()->user();

        if ($fromUser->isBanned) {
            return response()->jsonFail([
                "errors" => "Ваш аккаунт заблокирован",
            ], Response::HTTP_FORBIDDEN);
        }

        if ($toUser->isBanned) {
            return response()->jsonFail([
                "errors" => "Пользователь заблокирован",
            ], Response::HTTP_FORBIDDEN);
        }

        if ($fromUser->id == $data["from"]) {
            if (isset($data['images'])) {
                $images = $data['images'];
                $imagesName = [];
                foreach ($images as $image) {
                    $imageName = Str::random(40) . '.' . $image->getClientOriginalExtension();
                    $image->move(
                        storage_path() . '/app/public/',
                        $imageName
                    );
                    $imagesName [] = $imageName;
                }

                $data['images'] = json_encode($imagesName, JSON_THROW_ON_ERROR);
            }

            [$dialog, $message] = $this->messagesManager->sendToUser(
                $fromUser,
                $toUser,
                $data
            );

            if ($fromUser->role === 2) {
                $dialog->read_by_admin = Carbon::now();
                $dialog->read_by_user = null;
            } else {
                $dialog->read_by_user = Carbon::now();
                $dialog->read_by_admin = null;
            }
            $dialog->save();

//        $this->notifyAbouteNewMessage($toUser);
            SendEmailNotification::dispatch($toUser, $fromUser, $message);

            $messages = $this->messagesManager->findUnreadFromDialog($dialog);

            return response()->jsonSuccess([
                "messages" => $messages,
            ], Response::HTTP_CREATED);
        }
        return response()->jsonFail([
            "errors" => "Ошибка доступа",
        ], Response::HTTP_FORBIDDEN);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Store $request
     * @param Dialog $dialog
     * @return Response
     */
    public function store(Store $request, Dialog $dialog): Response
    {
        $this->authorize("dialogs.messages.store", $dialog);

        $data = $request->validated();

        /** @var User $user */
        $fromUser = auth()->user();

        $canSend = $this->messagesManager->canSendToDialog(
            $fromUser,
            $dialog
        );

        if (! $canSend) {
            return response()->jsonFail([
                "Запрещено отправлять сообщения в данный диалог!"
            ], Response::HTTP_FORBIDDEN);
        }

        $this->messagesManager->sendToDialog(
            $fromUser,
            $dialog,
            $data
        );

        $messages = $this->messagesManager->findUnreadFromDialog($dialog);

        return response()->jsonSuccess([
            "messages" => $messages,
        ], Response::HTTP_CREATED);
    }

    public function notifyAbouteNewMessage(User $user): void
    {
        $url = env('APP_URL').'/chat/1';
        Mail::send('emails.admin_inbox', ['url' => $url], function($message) use ($user){
            $message->from(env('MAIL_USERNAME'), env('APP_NAME'));
            $message->to($user->email, $user->name)->subject('Новое сообщение на сайте');
        });
    }

    /**
     * @param $messageId
     * @return mixed
     * @throws JsonException
     */
    public function getZip($messageId) {
        $zipPathAndName = now().'.zip';
        $message = Message::query()->findOrFail($messageId);
        $files = json_decode($message->file, false, 512, JSON_THROW_ON_ERROR);
        $filePaths = [];
        foreach ($files as $file) {
            if (Storage::disk('public')->exists($file)) {
                $filePaths[] = Storage::disk('public')->path($file);
            }
        }
        return Zip::create($zipPathAndName, $filePaths);
    }
}
