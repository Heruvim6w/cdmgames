<?php

namespace App\Http\Controllers;

use App\Models\LinkLayout;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LinkLayoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|RedirectResponse
     */
    public function index(): Application|Factory|View|RedirectResponse
    {
        $user = auth()->user();
        if ($user && $user->role === 1) {
            return redirect()->route('home');
        }
        $layouts = LinkLayout::get();

        return view('link_layout', ['layouts' => $layouts]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request): void
    {
        $layout = new LinkLayout();
        $layout->title = $request->title;
        $layout->content = $request->content;
        $layout->save();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function update(Request $request): Response
    {
        $layout = LinkLayout::query()->find($request->id);

        $layout->title = $request->title;
        $layout->content = $request->content;
        $layout->save();

        return response()->jsonSuccess([
            "linkLayout" => $layout,
        ], Response::HTTP_OK);
    }
}
