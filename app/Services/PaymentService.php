<?php

namespace App\Services;

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

    public static function searchOrderFilter()
    {
        //
    }

    public static function paidOrderFilter()
    {
        //
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
}
