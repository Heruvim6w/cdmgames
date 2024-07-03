<?php

namespace App\Http\Controllers;

use App\Models\GameForItem;
use App\Models\GameItem;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class GameItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param GameForItem $gameForItem
     * @return Application|Factory|View|\Illuminate\View\View
     */
    public function index(GameForItem $gameForItem): Application|Factory|View|\Illuminate\View\View
    {
        $gameItems = GameItem::query()
            ->where('game_for_item_id', $gameForItem->id)
            ->active()
            ->orderBy('sort_order')
            ->get();

        return view('game_item.index', compact('gameItems', 'gameForItem'));
    }

    /**
     * Display the specified resource.
     *
     * @param GameItem $gameItem
     * @return Application|Factory|View|\Illuminate\View\View
     */
    public function show(GameItem $gameItem): Application|Factory|View|\Illuminate\View\View
    {
        $paymentURL = 'https://unitpay.ru/pay/PUBLIC-KEY?sum&account&desc&signature';
        return view('game_item.show', compact('gameItem'));
    }
}
