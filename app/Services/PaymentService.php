<?php

namespace App\Services;

use App\Http\Controllers\OrderController;
use App\Models\Order;
use Daaner\UnitPay\UnitPay;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

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
     * @param $order
     * @return bool
     */
    public static function paidOrderFilter(Request $request, $order): bool
    {
        // Your code should be here:
        if (OrderController::saveOrderAsPaid($order)) {

            // Return TRUE if the order is saved as "paid" in the database or FALSE if some error occurs.
            // If you return FALSE, then you can repeat the failed paid requests on the unitpay website manually.
            return true;
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
        $unitPay = new UnitPay();
        return $unitPay->payOrderFromGate($request);
    }
}
