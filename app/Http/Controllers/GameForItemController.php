<?php

namespace App\Http\Controllers;

use App\Models\GameForItem;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class GameForItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|\Illuminate\View\View
     */
    public function index(): Application|Factory|View|\Illuminate\View\View
    {
        $gameForItems = GameForItem::active()->get();
        return view('game_for_item.index', compact('gameForItems'));
    }

    /**
     * Display the specified resource.
     *
     * @param GameForItem $gameForItem
     * @return Application|Factory|\Illuminate\View\View|View
     */
    public function show(GameForItem $gameForItem): Application|Factory|\Illuminate\View\View|View
    {
        return view('game_for_item.show', compact('gameForItem'));
    }
}
