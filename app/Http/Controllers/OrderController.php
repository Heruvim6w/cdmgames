<?php

namespace App\Http\Controllers;

use App\Http\Requests\Order\OrderStoreRequest;
use App\Models\GameItem;
use App\Models\Order;
use App\Services\PaymentService;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class OrderController extends Controller
{
    public static function saveOrderAsPaid($order): bool
    {
        try {
            $order->status = Order::PAID;
            $order->save();

            return true;
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
        }
        return false;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|\Illuminate\Contracts\View\View|View
     */
    public function index(): Application|Factory|\Illuminate\Contracts\View\View|View
    {
        $orders = Order::query()->where('user_id', auth()->id())->get();
        $statuses = [
            Order::NEW => 'Новый',
            Order::PAID => 'Оплачен',
            Order::COMPLETED => 'Завершён',
            Order::CANCELLED => 'Отменён',
            Order::ERROR => 'Ошибка',
        ];

        return view('order.index', compact('orders', 'statuses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param OrderStoreRequest $request
     * @return Factory|View|RedirectResponse
     */
    public function store(OrderStoreRequest $request): Factory|View|RedirectResponse
    {
        $data = $request->validated();
        $user = auth()->user();
        $currency = config('unitpay.currency', 'RUB');
        $gameItemId = GameItem::query()->findOrFail($data['game_item'])->id;

        try {
            $order = new Order();
            $order->user_id = $user->id;
            $order->user_game_nickname = $data['user_game_nickname'];
            $order->game_item_id = $gameItemId;
            $order->status = 0;
            $order->price = $data['price'];
            $order->save();

            return PaymentService::buy($order->price, $order->id, $user->email, $order->gameItem->title, $currency);
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param Order $order
     * @return Application|Factory|View
     */
    public function show(Order $order): Application|Factory|View
    {
        dd($order);
        return view('order::show', ['order' => $order]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Order $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    public function cancel(Request $request): JsonResponse
    {
        try {
            $order = Order::query()->findOrFail($request->get('order'));

            $order->status = Order::CANCELLED;
            $order->save();
        } catch (Exception $exception) {
            return response()->jsonFail($exception->getMessage());
        }

        return response()->jsonSuccess($order);
    }

    public function deliver(Request $request): JsonResponse
    {
        try {
            $order = Order::query()->findOrFail($request->get('order'));

            $order->status = Order::COMPLETED;
            $order->save();
        } catch (Exception $exception) {
            return response()->jsonFail($exception->getMessage());
        }

        return response()->jsonSuccess($order);
    }
}
