<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Post;
use App\Models\Review;
use Illuminate\Http\Response;

class SitemapXmlController extends Controller
{
    /**
     * @return Response
     */
    public function index(): Response
    {
        $games = Game::all();
        $posts = Post::query()->where('is_active', 1)->get();
        $reviews = Review::query()->latest()->first();

        return response()->view('sitemap', [
            'games' => $games,
            'posts' => $posts,
            'reviews' => $reviews,
        ])->header('Content-Type', 'text/xml');
    }
}
