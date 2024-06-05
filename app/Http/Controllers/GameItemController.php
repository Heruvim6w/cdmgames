<?php

namespace App\Http\Controllers;

use App\Models\GameItem;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class GameItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|\Illuminate\View\View
     */
    public function index(): Application|Factory|View|\Illuminate\View\View
    {
        $gameItems = GameItem::all();
        return view('gameItems.index', compact('gameItems'));
    }

    /**
     * Display the specified resource.
     *
     * @param GameItem $gameItem
     * @return Application|Factory|View|\Illuminate\View\View
     */
    public function show(GameItem $gameItem): Application|Factory|View|\Illuminate\View\View
    {
        return view('gameItems.show', compact('gameItem'));
    }
}
