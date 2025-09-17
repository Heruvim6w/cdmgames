<?php

namespace App\Http\Controllers;

use App\Models\PageStaticContent;
use App\Models\User;
use App\Services\UserChangePasswordService;
use App\Services\SellApplicationService;
use App\Services\TelegramNotificationService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Game;
use App\Models\SellApplication;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\SellRequest;

class ProfileController extends Controller
{
    private UserChangePasswordService $userChangePasswordService;

    private SellApplicationService $sellApplicationService;

    private TelegramNotificationService $telegramNotificationService;

    public function __construct(
        UserChangePasswordService $userChangePasswordService,
        SellApplicationService $sellApplicationService,
        TelegramNotificationService $telegramNotificationService
    )
    {
        $this->userChangePasswordService = $userChangePasswordService;
        $this->sellApplicationService = $sellApplicationService;
        $this->telegramNotificationService = $telegramNotificationService;
    }

    public function show(): Factory|View|Application
    {
        /** @var User $user */
        $user = auth()->user();
        $profileVkInfo = PageStaticContent::query()->where('title', 'profile_vk_info')->first();
        $profileMoneyInfo = PageStaticContent::query()->where('title', 'profile_money_info')->first();

        return view('profile', compact('user', 'profileVkInfo', 'profileMoneyInfo'));
    }

    /**
     * @param Request $request
     * @return string
     */
    public function updatePass(Request $request)
    {
        $data = $request->validate([
            'password' => 'required',
            'new_password' => 'required|min:8',
            'confirm_new_password' => 'required|min:8',
        ]);
        $user = auth()->user();
        if (Hash::check($data['password'], $user->password)) {
            if ($data['password'] === $data['new_password']) {
                return collect(['errors' => ['new_password' => ['Новый пароль не может быть такой же как старый.']]])->toJson();
            }
            if ($data['new_password'] !== $data['confirm_new_password']) {
                return collect(['errors' => ['confirm_new_password' => ['Пароли не совпадают']]])->toJson();
            } else {
                $user->password = Hash::make($data['new_password']);
                $user->save();
                return collect(['errors' => ['confirm_new_password' => ['Пароль успешно изменен']], 'result' => 'reload'])->toJson();
            }
        }

        return collect(['errors' => ['password' => ['Старый пароль не подходит']]])->toJson();
    }

    public function updateTempPassword(Request $request): RedirectResponse
    {
        $this->userChangePasswordService->update($request);

        return redirect()->back()->with('success', 'Пароль успешно изменен!');
    }

    /**
     * Обработка заявки на продажу аккаунта
     */
    public function sellRequest(SellRequest $request): RedirectResponse
    {
        try {
            $application = $this->sellApplicationService->handle($request);
            $this->telegramNotificationService->sendSellApplication($application);
            return redirect()->route('sell.application.show', $application->id);
        } catch (\Throwable $e) {
            \Log::error('Ошибка при создании заявки на продажу: ' . $e->getMessage(), [
                'exception' => $e,
            ]);

            return back()->withErrors(['error' => 'Произошла ошибка при обработке заявки. Попробуйте позже.'])->withInput();
        }
    }

    /**
     * Страница заявки
     */
    public function showSellApplication($id): Factory|View|Application
    {
        $application = SellApplication::with('game')->findOrFail($id);
        $botUrl = config('services.telegram_bot_url');

        return view('sell_application.show', compact('application', 'botUrl'));
    }
}
