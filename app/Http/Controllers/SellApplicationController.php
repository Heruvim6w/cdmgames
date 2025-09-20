<?php

namespace App\Http\Controllers;

use App\Http\Requests\SellRequest;
use App\Models\SellApplication;
use App\Services\SellApplicationService;
use App\Services\TelegramNotificationService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class SellApplicationController extends Controller
{
    private SellApplicationService $sellApplicationService;

    private TelegramNotificationService $telegramNotificationService;

    public function __construct(
        SellApplicationService $sellApplicationService,
        TelegramNotificationService $telegramNotificationService
    )
    {
        $this->sellApplicationService = $sellApplicationService;
        $this->telegramNotificationService = $telegramNotificationService;
    }

    /**
     * Обработка заявки на продажу аккаунта
     */
    public function store(SellRequest $request): RedirectResponse
    {
        try {
            $application = $this->sellApplicationService->handle($request);

            $userApplications = session('user_applications', []);
            $userApplications[] = $application->id;
            session(['user_applications' => $userApplications]);

            $this->telegramNotificationService->sendSellApplication($application);

            return redirect()->route('sell.application.show', $application->id);
        } catch (\Throwable $e) {
            Log::error('Ошибка при создании заявки на продажу: ' . $e->getMessage(), [
                'exception' => $e,
            ]);

            return back()->withErrors(['error' => 'Произошла ошибка при обработке заявки. Попробуйте позже.'])->withInput();
        }
    }

    /**
     * Страница заявки
     */
    public function show(SellApplication $application): Factory|View|Application
    {
        $userApplications = session('user_applications', []);

        if (!in_array($application->id, $userApplications, true)) {
            abort(403, 'Доступ запрещен');
        }

        return view('sell_application.show', compact('application'));
    }
}
