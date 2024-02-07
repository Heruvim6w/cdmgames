<?php

namespace App\Nova\Metrics;

use App\Models\WithdrawalApplication;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Value;

class NewWithdrawals extends Value
{
    public $name = 'Количество заявок на вывод';

    /**
     * Calculate the value of the metric.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {
        return $this->count($request, WithdrawalApplication::class);
    }

    /**
     * Get the ranges available for the metric.
     *
     * @return array
     */
    public function ranges()
    {
        return [
            30 => __('30 Дней'),
            60 => __('60 Дней'),
            365 => __('365 Дней'),
            'TODAY' => __('Сегодня'),
            'MTD' => __('С начала месяца'),
            'QTD' => __('С начала квартала'),
            'YTD' => __('С начала года'),
        ];
    }

    /**
     * Determine for how many minutes the metric should be cached.
     *
     * @return  \DateTimeInterface|\DateInterval|float|int
     */
    public function cacheFor()
    {
        // return now()->addMinutes(5);
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'new-withdrawals';
    }
}
