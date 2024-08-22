<?php

namespace App\Services;

use App\Http\Controllers\OrderController;
use App\Jobs\SendEmailNotification;
use App\Managers\MessagesManager;
use App\Models\Order;
use App\Models\User;
use Daaner\UnitPay\UnitPay;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Log;

class PaymentService
{
    public function check(Request $request)
    {
        if ($request->has('method') && $request->get('method') === 'check') {
            return response()->json([
                'result' => [
                    'message' => 'Запрос успешно обработан'
                ]
            ]);
        }
        if ($request->has('method') && $request->get('method') === 'pay') {
            return $this->payOrderFromGate($request);
        }
        if ($request->has('method') && $request->get('method') === 'error') {
            return $this->markOrderAsError($request);
        }
        return response()->json([
            'error' => [
                'message' => 'Описание ошибки'
            ]
        ]);
    }

    /**
     * Search the order if the request from unitpay is received.
     * Return the order with required details for the unitpay request verification.
     *
     * @param Request $request
     * @param $orderId
     * @return mixed
     */
    public static function searchOrderFilter(Request $request, $orderId) {

        // If the order with the unique order ID exists in the database
        $order = Order::query()->where('id', $orderId)->first();

        if ($order) {
            $order['UNITPAY_orderSum'] = $order->price; // from your database
            $order['UNITPAY_orderCurrency'] = config('unitpay.currency', 'RUB');  // from your database

            // if the current_order is already paid in your database, return strict "paid";
            // if not, return something else
            $order['UNITPAY_orderStatus'] = $order->status; // from your database
            return $order;
        }

        return false;
    }

    /**
     * When the payment of the order is received from unitpay, you can process the paid order.
     * !Important: don't forget to set the order status as "paid" in your database.
     *
     * @param Request $request
     * @param Order $order
     * @return bool
     */
    public static function paidOrderFilter(Request $request, Order $order): bool
    {
        // Your code should be here:
        if (OrderController::saveOrderAsPaid($request, $order)) {
            try {
                $toUser = User::query()->findOrFail(1);
                $fromUser = User::query()->findOrFail($order->user_id);
                $text = 'Оплачен заказ № ' . $order->id . ' "' . $order->gameItem->title . '". Стоимость: ' . $order->price . 'руб.';

                $messagesManager = app()->make(MessagesManager::class);
                [$dialog, $message] = $messagesManager->sendToUser(
                    $fromUser,
                    $toUser,
                    [
                        'text' => $text
                    ]
                );

                SendEmailNotification::dispatch($toUser, $fromUser, $message);
            } catch (Exception $exception) {
                Log::error('Ошибка отправки сообщения: ' . $exception->getMessage());
            } finally {
                return true;
            }
        }

        return false;
    }

    public static function buy(
        float $paymentAmount,
        int $orderId,
        string $userEmail,
        string $itemName,
        string $currency
    ): Factory|View
    {
        $unitPay = new UnitPay();
        return $unitPay->generatePaymentForm($paymentAmount, $orderId, $userEmail, $itemName, $currency);
    }

    public function payOrderFromGate(Request $request): bool|array
    {
        return (new UnitPay())->payOrderFromGate($request);
    }

    /**
     */
    public function markOrderAsError(Request $request): JsonResponse
    {
        $order = Order::query()->findOrFail($request->get('params')['account']);

        if ($order) {
            $order->status = Order::ERROR;
            $order->error = $request->get('params')['errorMessage'];
            $order->external_id = $request->get('params')['unitpayId'];
            $order->save();
        }

        return response()->json([
            'error' => [
                'message' => $request->get('params')['errorMessage']
            ]
        ]);
    }
}
