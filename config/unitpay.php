<?php

return [

    /*
     * unitpay.ru PUBLIC KEY for project
     */
    'UNITPAY_PUBLIC_KEY' => env('UNITPAY_PUBLIC_KEY', '442916-974e7'),

    /*
     * unitpay.ru SECRET KEY for project
     */
    'UNITPAY_SECRET_KEY' => env('UNITPAY_SECRET_KEY', 'f7aa4c38be9e68649f58d7298fa06baf'),

    /*
     * locale for payment form
     */
    'locale' => 'ru',  // ru || en

    /*
     * Hide other payment methods
     */
    'hideOtherMethods' => 'false',

    /*
     * Currency for payment
     * RUB, UAH, BYN, EUR, USD
     */
    'currency' => 'RUB',

    /*
     *  SearchOrderFilter
     *  Search order in the database and return order details
     *  Must return array with:
     *
     *  orderStatus
     *  orderCurrency
     *  orderSum
     */
    'searchOrderFilter' => \App\Services\PaymentService::searchOrderFilter(), //  'App\Http\Controllers\ExampleController::searchOrderFilter',

    /*
     *  PaidOrderFilter
     *  If current orderStatus from DB != paid then call PaidOrderFilter
     *  update order into DB & other actions
     */
    'paidOrderFilter' => \App\Services\PaymentService::paidOrderFilter(), //  'App\Http\Controllers\ExampleController::paidOrderFilter',

    'payment_forms' => [
        'cards' => true,
        'yandex' => true,
        'qiwi' => true,
        'cash' => true,
        'webmoney' => true,
    ],

    // Allowed ip's http://help.unitpay.ru/article/67-ip-addresses
    'allowed_ips' => [
        '31.186.100.49',
        '178.132.203.105',
        '52.29.152.23',
        '52.19.56.234',
    ],

    /*
     * Использование Cloudflare для проверки IP адреса отправителя запроса
     */
    'cloudflare' => env('UNITPAY_CLOUDFLARE', false),

    /*
     * The notification that will be send when payment request received.
     */
    'notification' => \Daaner\UnitPay\UnitPayNotification::class,

    /*
     * The notifiable to which the notification will be sent. The default
     * notifiable will use the mail and slack configuration specified
     * in this config file.
     */
    'notifiable' => \Daaner\UnitPay\UnitPayNotifiable::class,

    /*
     * By default notifications are sent always. You can pass a callable to filter
     * out certain notifications. The given callable will receive the notification. If the callable
     * return false, the notification will not be sent.
     */
    'notificationFilter' => null,

    /*
     * The channels to which the notification will be sent.
     */
    'channels' => ['mail'],

    'mail' => [
        'to' => 'heruvim.6w@gmail.com',  // your email
    ],

    'slack' => [
        'webhook_url' => '', // slack web hook to send notifications
    ],
];
