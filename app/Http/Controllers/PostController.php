<?php

namespace App\Http\Controllers;

use App\Events\PostHasViewed;
use App\Models\Post;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostController extends Controller
{
    public const PUBLISHED = 1;
    public const NOT_PUBLISHED = 0;
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): Application|Factory|View
    {
        $posts = Post::query()->where('is_active', self::PUBLISHED)->get();
        return view('post', ['posts' => $posts]);
    }

    /**
     * Display the specified resource.
     *
     * @param Post $post
     * @return Application|Factory|View
     */
    public function show(Post $post): Application|Factory|View
    {
        if ($post->is_active) {
            event(new PostHasViewed($post));

            return view('post_item', ['post' => $post]);
        }
    }
}
