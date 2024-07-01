<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\StripePaymentsController;

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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/', [AuthController::class, 'index']);

Route::get('/', [ShopController::class, 'index'])->name('shop.index');
Route::post('/favorite', [FavoriteController::class, 'flip']);
Route::get('/detail/{shop_id}', [ShopController::class, 'detail'])->middleware(['verified'])->middleware('auth');

Route::post('/reserve', [ReservationController::class, 'store'])->name('reserve');
Route::get('/reserve/done', [ReservationController::class, 'show'])->name('reserve.done');
Route::post('/reserve/delete', [ReservationController::class, 'destroy'])->middleware('auth');
Route::post('/reserve/update', [ReservationController::class, 'update'])->middleware('auth');
Route::get('/reserve/qr_code_update/{reservation_id}', [ReservationController::class, 'QrCodeUpdate'])->name('reserve.qr_code_update')->middleware(['verified']);

Route::get('/my_page', [MyPageController::class, 'create'])->middleware(['verified'])->middleware('auth');
Route::get('/qr_code', [MyPageController::class, 'showQrCode'])->middleware(['verified']);


//Review機能の追加
Route::get('/review/add/{shop_id}', [ReviewController::class, 'create'])->middleware(['verified']);
Route::get('/review/store', [ReviewController::class, 'store'])->middleware(['verified']);
Route::post('/review/store', [ReviewController::class, 'store'])->middleware(['verified']);
Route::get('/review/shop_index/{shop_id}', [ReviewController::class, 'shopIndex']);
Route::post('/review/delete', [ReviewController::class, 'destroy']);
Route::get('/review/edit/{shop_id}', [ReviewController::class, 'edit'])->middleware(['verified']);
Route::post('/review/update', [ReviewController::class, 'update'])->middleware(['verified']);


// Route::get('/feedback/{reservation_id}', [FeedbackController::class, 'create'])->middleware(['verified']);
// Route::post('/feedback/store', [FeedbackController::class, 'store'])->middleware(['verified']);

// Route::middleware('auth')->group(function () {
//     Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
//         ->name('verification.notice');

//     Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
//         ->middleware(['signed', 'throttle:6,1'])
//         ->name('verification.verify');
// });

// Route::get('/', [StripePaymentsController::class,'index'])->name('index');

// Route::get('/payment',  [StripePaymentsController::class, 'payment'])->name('payment');

// Route::get('/complete', [StripePaymentsController::class, 'complete'])->name('complete');

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/checkout', function () {
    return view('checkout');
});
Route::get('success', function () {
    return view('success');
})->name('success');
Route::get('cancel', function () {
    return view('cancel');
})->name('cancel');
Route::get('/checkout-payment', 'App\Http\Controllers\StripeController@checkout')->name('checkout.session'); // Stripeフォームへ遷移する処理
