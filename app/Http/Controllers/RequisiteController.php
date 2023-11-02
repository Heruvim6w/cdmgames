<?php

namespace App\Http\Controllers;

use App\Models\Requisite;
use App\Models\User;
use App\Models\WithdrawalMethod;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Log;

class RequisiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        /**
         * @var User $user
         */
        $user = auth()->user();

        /** @var WithdrawalMethod $withdrawalMethods */
        $withdrawalMethods = WithdrawalMethod::all();

        return view('requisites', compact('user', 'withdrawalMethods'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        /**
         * @var User $user
         */
        $user = auth()->user();

        $value = str_replace(array(" ", "-"), '', $request->get('value'));
        $hash = md5(md5($value));
        $hash = sha1(uniqid($hash, true));

        $url = route('requisite_confirm', $hash);

        try {
            $requisite = new Requisite([
                'withdrawal_method_id' => $request->get('withdrawal_method'),
                'user_id' => $user->id,
                'value' => $value,
                'hash' => $hash,
            ]);
            $requisite->save();

            $this->sendConfirm($user, $url);

            return redirect()->back();
        } catch (Exception $e) {
            Log::error('Ошибка добавления реквизитов у пользователя с ID ' . $user->id . ': ' . $e->getMessage());

            return redirect()->back();
        }
    }

    public function sendConfirm(User $user, string $url): void
    {
        Mail::send('emails.requisite_confirm', ['url' => $url], function($message) use ($user){
            $message->from(config('mail.mailers.smtp.username'), config('app.name'));
            $message->to($user->email, $user->name)->subject('Подтверждение метода вывода');
        });
    }

    public function confirm($hash): Application|View|Factory
    {
        $requisite = Requisite::query()->where('hash', $hash)->first();
        $requisite->update([
            'confirm' => 1
        ]);

        return view('profile', ['message' => config('notify.confirm.withdrawal')]);
    }
}
