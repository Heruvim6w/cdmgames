<?php

namespace App\Http\Controllers\Dialogs;

use App\Http\Controllers\Controller;
use App\Http\Resources as Resources;
use App\Managers\DialogManager;
use App\Models\Dialog;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DialogController extends Controller
{
    /**
     * @var DialogManager
     */
    protected DialogManager $dialogManager;

    public function __construct(DialogManager $dialogManager)
    {
        $this->dialogManager = $dialogManager;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        /** @var User $user */
        $user = auth()->user();

        $sort = $request->only([
            'order_by',
            'order_direction',
        ]);

        $paginate = $request->only([
            'per_page',
        ]);

        $dialogs = $this->dialogManager->getAllDialogs($sort, $paginate)->sortBy('messages.created_at')->unique('id');

        return view('chats', ['dialogs' => new Resources\Dialogs\DialogCollection($dialogs), 'user' => $user]);
    }

    public function user(User $user)
    {
        /** @var User $user */
        $auth = auth()->user();

        $dialog = $this->dialogManager->getDialogWithUser($auth, $user);

        if ($auth->role === 2) {
            $dialog->read_by_admin = Carbon::now();
            $dialog->save();
        } else {
            $dialog->read_by_user = Carbon::now();
            $dialog->save();
        }

        $dialog = new Resources\Dialogs\FullDialogResource($dialog);

        $messages = collect();
        foreach ($dialog->messages as $message) {
            $message->file = json_decode($message->file);
            $messages->push($message);
        }

        return $messages;
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function getChatList(Request $request)
    {
        /** @var User $user */
        $user = auth()->user();

        $sort = $request->only([
            'order_by',
            'order_direction',
        ]);

        $paginate = $request->only([
            'per_page',
        ]);

        $dialogs = $this->dialogManager->getAllDialogs($sort, $paginate);

        return view('layouts.admin_chat_list', ['dialogs' => new Resources\Dialogs\DialogCollection($dialogs), 'user' => $user]);
    }
}