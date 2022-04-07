<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;
use App\Http\Controllers\PostController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [GameController::class, 'index']);

Route::get('about', function () {
    return view('about');
})->name('about');

Route::get('reviews', [\App\Http\Controllers\ReviewController::class, 'getReviews'])->name('reviews');

Route::resource('games', GameController::class)->only([
    'show'
]);

Route::resource('posts', PostController::class)->only([
    'index', 'show'
]);
