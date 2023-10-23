<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;

class ResponseMacroServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        Response::macro('jsonSuccess', function ($response, $status = 200) {
            return Response::json([
                "result" => true,
                "response" => $response,
                "errors" => null,
            ], $status, [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        });

        Response::macro('jsonFail', function ($errors, $status = 400) {
            return Response::json([
                "result" => false,
                "response" => null,
                "errors" => $errors,
            ], $status, [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        });
    }
}
