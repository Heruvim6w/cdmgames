<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Game;
use App\Models\GameForItem;
use App\Models\GamesSellTable;
use App\Models\PageStaticContent;
use App\Models\Review;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        Cache::remember('index_blade', 240, function () {
            $reviews = Review::query()->count() + 1898;
            $allBalance = User::query()->sum('balance');
            $accounts = Account::query()->count();
            $buyInfo = PageStaticContent::query()->where('title', 'home_buy_info')->first();
            return [
                'reviews' => $reviews,
                'allBalance' => $allBalance,
                'accounts' => $accounts,
                'buyInfo' => $buyInfo,
            ];
        });
        $indexBladeData = Cache::get('index_blade');
        $games = Game::active()->get();
        $gameForItems = GameForItem::all();

        return view('index', [
            'games'      => $games,
            'buyInfo'    => $indexBladeData['buyInfo'],
            'reviews'    => $indexBladeData['reviews'],
            'allBalance' => $indexBladeData['allBalance'],
            'accounts'   => $indexBladeData['accounts'],
            'gameForItems' => $gameForItems
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Game $game
     * @return Application|Factory|View
     */
    public function show(Game $game): Application|Factory|View
    {
        return view('game', ['game' => $game]);
    }

    /**
     * @return Application|Factory|View
     */
    public function getSellDotaTable(): Application|Factory|View
    {
        $data = GamesSellTable::query()->where('game_id', 1)->first();

        return view('sell_dota', compact('data'));
    }
}
