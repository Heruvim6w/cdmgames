<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Request;

class RequestMacroServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        Request::macro('sendToGate', function () {
            return app(\App\SDK\Gateway\Api::class)->sendToGate($this);
        });
    }
}
