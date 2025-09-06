<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Game;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('layouts.header', function ($view) {
            $games = Game::query()->active()->get();
            $view->with('games', $games);
        });
    }
}

