<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ReservationController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/', [AuthController::class, 'index']);


Route::get('/', [ShopController::class, 'index'])->name('shop.index');
// Route::post('/favorite', [FavoriteController::class, 'flip']);
Route::get('/detail/{shop_id}', [ShopController::class, 'detail'])->middleware('auth');
Route::post('/reserve', [ReservationController::class, 'store'])->name('reserve');
Route::get('/reserve/done', [ReservationController::class, 'show'])->name('reserve.done');
// Route::get('/reserve/edit', [ReserveController::class, 'edit'])->middleware(['verified']);
// Route::post('/reserve/update', [ReserveController::class, 'update'])->middleware(['verified']);
// Route::post('/reserve/delete', [ReserveController::class, 'destroy'])->middleware(['verified']);
// Route::get('/reserve/cancel', [ReserveController::class, 'showCancel'])->middleware(['verified']);
// Route::get('/my_page', [MyPageController::class, 'create'])->middleware(['verified']);
// Route::get('/qr_code', [MyPageController::class, 'showQrCode'])->middleware(['verified']);
// Route::get('/feedback/{reservation_id}', [FeedbackController::class, 'create'])->middleware(['verified']);
// Route::post('/feedback/store', [FeedbackController::class, 'store'])->middleware(['verified']);


