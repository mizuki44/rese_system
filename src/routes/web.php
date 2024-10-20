<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\RegisteredUserController;

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

// userページ
Route::get('/', [ShopController::class, 'index'])->name('shop.index');
Route::get('/detail/{shop_id}', [ShopController::class, 'detail'])->middleware(['verified'])->middleware('auth');
Route::post('/reserve', [ReservationController::class, 'store'])->name('reserve');
Route::post('/reserve/delete', [ReservationController::class, 'destroy'])->middleware('auth');
Route::get('/reserve/edit', [ReservationController::class, 'edit'])->middleware('auth');
Route::post('/reserve/update', [ReservationController::class, 'update'])->middleware('auth');
Route::get('/reserve/qr_code_update/{reservation_id}', [ReservationController::class, 'QrCodeUpdate'])->name('reserve.qr_code_update')->middleware(['verified']);
Route::post('/favorite', [FavoriteController::class, 'flip']);
Route::get('/my_page', [MyPageController::class, 'create'])->middleware(['verified'])->middleware('auth')->name('mypage');
Route::get('/qr_code', [MyPageController::class, 'showQrCode'])->middleware(['verified']);
Route::get('/review/add/{shop_id}', [ReviewController::class, 'create'])->middleware(['verified']);
Route::post('/review/store', [ReviewController::class, 'store'])->middleware(['verified']);
Route::post('/review/delete', [ReviewController::class, 'destroy']);
Route::get('/review/edit/{shop_id}', [ReviewController::class, 'edit'])->middleware(['verified']);
Route::post('/review/update', [ReviewController::class, 'update'])->middleware(['verified']);


// 決済処理
Route::get('/checkout', function () {
    return view('checkout');
})->name('checkout');
Route::get('success', function () {
    return view('success');
})->name('success');
Route::get('cancel', function () {
    return view('cancel');
})->name('cancel');
Route::post('/checkout-payment', 'App\Http\Controllers\StripePaymentsController@checkout')->name('checkout.session'); // Stripeフォームへ遷移する処理

// adminページ
Route::prefix('admin')->name('admin.')->group(function () {
    // ログイン・登録
    Route::view('/login', 'admin.auth.login')->middleware('guest:admin')->name('login');
    $limiter = config('fortify.limiters.login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->middleware('guest:admin');
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth:admin')->name('logout');
    Route::view('/register', 'admin.auth.register')->middleware('guest:admin')->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store'])->middleware('guest:admin');

    // トップページ
    Route::view('/index', 'admin.index')->middleware('auth:admin')->name('index');

    // 店舗代表者
    Route::group(['middleware' => ['auth:admin', 'can:admin_only']], function () {
        Route::get('/owner', [App\Http\Controllers\Admin\AdminController::class, 'index']);
        Route::get('/owner/create', [App\Http\Controllers\Admin\AdminController::class, 'create']);
        Route::post('/owner/store', [App\Http\Controllers\Admin\AdminController::class, 'store'])->name('owner_store');
        Route::get('/owner/edit', [App\Http\Controllers\Admin\AdminController::class, 'edit']);
        Route::post('/owner/update', [App\Http\Controllers\Admin\AdminController::class, 'update']);
        Route::post('/owner/delete', [App\Http\Controllers\Admin\AdminController::class, 'delete']);
        // お知らせメール
        Route::get('/mail', [App\Http\Controllers\Admin\UserController::class, 'create']);
        Route::post('/mail/send', [App\Http\Controllers\Admin\UserController::class, 'send']);
        Route::get('/review', [App\Http\Controllers\Admin\ReviewController::class, 'index']);
        Route::post('/review/delete', [App\Http\Controllers\Admin\ReviewController::class, 'delete']);
        // 店舗登録（csvインポート）
        Route::get('/shop/import', [App\Http\Controllers\Admin\ShopController::class, 'pre_import']);
        Route::post('/shop/import', [App\Http\Controllers\Admin\ShopController::class, 'import']);
    });

    // 店舗情報
    Route::group(['middleware' => ['auth:admin', 'can:owner_only']], function () {
        Route::get('/shop/index', [App\Http\Controllers\Admin\ShopController::class, 'index']);
        Route::get('/shop/create', [App\Http\Controllers\Admin\ShopController::class, 'create']);
        Route::post('/shop/store', [App\Http\Controllers\Admin\ShopController::class, 'store'])->name('shop_store');
        Route::get('/shop/edit', [App\Http\Controllers\Admin\ShopController::class, 'edit']);
        Route::post('/shop/update', [App\Http\Controllers\Admin\ShopController::class, 'update'])->name('shop_update');
        Route::post('/shop/delete', [App\Http\Controllers\Admin\ShopController::class, 'delete'])->name('shop_delete');
        // 予約一覧
        Route::get('/reserve', [App\Http\Controllers\Admin\ReservationController::class, 'index']);
    });
});
