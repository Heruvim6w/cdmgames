<?php

use App\Http\Controllers\Dialogs\DialogController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\GameItemController;
use App\Http\Controllers\LinkLayoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RequisiteController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SitemapXmlController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VkBotController;
use App\Models\Dialog;
use App\Models\LinkLayout;
use App\Models\User;
use App\Services\PaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;

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

Route::get('reviews', [ReviewController::class, 'getReviews'])->name('reviews');

Route::resource('games', GameController::class)->only([
    'show'
]);
Route::get('sell_dota', [GameController::class, 'getSellDotaTable'])->name('sell_dota');

Route::resource('posts', PostController::class)->only([
    'index', 'show'
]);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get("/profile", [ProfileController::class, 'show'])
    ->middleware("auth")
    ->middleware('verified')
    ->name("profile");

Route::get("profile_update/{id}", [UserController::class, 'edit'])
    ->middleware('auth')
    ->middleware('verified')
    ->name('profile.update');

Route::get("applications/", [UserController::class, 'getUserApplications'])
    ->middleware('auth')
    ->middleware('verified')
    ->name('profile.applications');

Route::post("profile_update/{user}", [UserController::class, 'update'])
    ->middleware('auth')
    ->name('profile.update.data');

Route::post("profile_update_pass", [ProfileController::class, 'updateTempPassword'])
    ->middleware('auth')
    ->name('profile.update.temp_password');

Route::get("chat/{user}", [DialogController::class, 'show'])->name('profile.chat');

Route::get("admin_chat/{user_id}", function ($user_id){
    $user = User::query()->findOrFail($user_id);
    $gamesLinks = LinkLayout::with('game')->get();
    $dialogId = Dialog::query()
        ->where('user_id', $user_id)
        ->value('id');

    return view('layouts.admin_chat', compact('user', 'gamesLinks', 'dialogId'));
})->middleware("auth")
    ->middleware('verified')
    ->name('admin.chat');

Route::get("layouts", [LinkLayoutController::class, 'index'])
    ->middleware("auth")
    ->middleware('verified')
    ->name('layouts');

Route::post("layouts", [LinkLayoutController::class, 'update'])
    ->middleware("auth")
    ->middleware('verified')
    ->name('update_layout');

Route::post("new_layout", [LinkLayoutController::class, 'store'])
    ->middleware("auth")
    ->middleware('verified')
    ->name('update_layout');

Route::post("replenishing_balance", [UserController::class, 'replenishingBalance'])
    ->middleware("auth")
    ->middleware('verified')
    ->name('admin.replenishing');

Route::post("ban_user", [UserController::class, 'ban'])
    ->middleware("auth")
    ->middleware('verified')
    ->name('admin.ban');

Route::post("unban_user", [UserController::class, 'unban'])
    ->middleware("auth")
    ->middleware('verified')
    ->name('admin.unban');

Route::post("withdrawal_balance", [UserController::class, 'withdrawalBalance'])
    ->middleware("auth")
    ->middleware('verified')
    ->name('withdrawal');

Route::post('/password/email', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
        ? back()->with(['status' => __($status)])
        : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

Route::prefix("dialogs")
    ->name("dialogs.")
    ->middleware("auth")
    ->group(function () {
        Route::get("/", [App\Http\Controllers\Dialogs\DialogController::class, "index"])->name("index");
        Route::get("/chat_list", [App\Http\Controllers\Dialogs\DialogController::class, "getChatList"])->name("chat_list");
        Route::get("/user/{user}/", [App\Http\Controllers\Dialogs\DialogController::class, "user"])->name("messages.user");
        Route::get("/{dialog}/messages", [App\Http\Controllers\Dialogs\MessageController::class, "index"])->name("messages.index");
        Route::post("/messages", [App\Http\Controllers\Dialogs\MessageController::class, "storeRoot"])->name("messages.storeRoot");
        Route::post("/{dialog}/messages", [App\Http\Controllers\Dialogs\MessageController::class, "store"])->name("messages.store");
        Route::get("get_zip/{messageId}", [App\Http\Controllers\Dialogs\MessageController::class, "getZip"])
            ->name("messages.get_zip");
    });

Route::get('test_bot', [VkBotController::class, 'ClassVkBot'])
    ->middleware('auth')
    ->name('test_bot');
Route::post('replenishment_bot_notification', [VkBotController::class, 'replenishmentNotification'])
    ->middleware('auth')
    ->name('replenishment_bot_notification');

Route::get('requisites', [RequisiteController::class, 'index'])
    ->middleware("auth")
    ->middleware('verified')
    ->name('user_requisites');

Route::post('requisites', [RequisiteController::class, 'store'])
    ->middleware("auth")
    ->middleware('verified')
    ->name('user_requisites');

Route::prefix('store')
    ->name('store.')
    ->group(function () {
        Route::get('/{game_for_item}', [GameItemController::class, 'index'])
            ->name('index');
        Route::get('/show/{game_item}', [GameItemController::class, 'show'])
            ->name('show');
});

Route::get('confirm/{hash}', [RequisiteController::class, 'confirm'])->name('requisite_confirm');
Route::post('replenishment_from_bot',[VkBotController::class, 'replenishmentFromBot']);
Route::post('reviews_confirm',[ReviewController::class, 'reviewsConfirm']);
Route::get('/sitemap.xml', [SitemapXmlController::class, 'index']);

Route::get('/unitpay', [PaymentService::class, 'check']);

Route::resource('orders', OrderController::class)->only([
    'index', 'store', 'show', 'update'
]);
