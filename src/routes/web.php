<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ReviewController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PaymentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/register', [AuthController::class,'getRegister']);
Route::post('/register', [AuthController::class,'postRegister']);
Route::get('/email/verify',[AuthController::class,'verification'])
    ->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verificationVerify'])
    ->middleware('signed')
    ->name('verification.verify');
Route::get('/login', [AuthController::class,'getLogin'])->name('login');
Route::post('/login', [AuthController::class,'postLogin']);
Route::get('/',[AuthController::class,'getLogin']);

Route::middleware('auth','verified')->group(function(){
    Route::get('/logout', [AuthController::class,'getLogout']);
    Route::get('/list',[RestaurantController::class,'getList']);
    Route::get('/restaurant/detail',[RestaurantController::class,'getDetail']);
    Route::get('/search', [RestaurantController::class,'search']);
    Route::post('/reserve', [ReservationController::class,'store']);
    Route::get('/mypage',[MypageController::class,'show']);
    Route::post('/favorite',[FavoriteController::class, 'store']);
    Route::post('/reservation/destroy',[ReservationController::class,'destroy']);
    Route::put('/reservation/update',[ReservationController::class,'update']);
    Route::post('/review',[ReviewController::class,'store']);
    Route::get('/reservation/list',[ReservationController::class,'getList']);
    Route::get('/restaurant/register',[RestaurantController::class,'getRestaurantRegister']);
    Route::post('/restaurant/register',[RestaurantController::class,'postRestaurantRegister']);
    Route::get('/manager/register',[AuthController::class,'getManagerRegister']);
    Route::post('/manager/register',[AuthController::class,'postManagerRegister']);
    Route::get('/restaurant/updateList',[RestaurantController::class,'getUpdateList']);
    Route::get('/restaurant/update',[RestaurantController::class,'getRestaurantUpdate']);
    Route::post('/restaurant/update',[RestaurantController::class,'postRestaurantUpdate']);
    Route::get('/reservation/check',[ReservationController::class,'getReservationCheck'])->name('reservation.check');
    Route::get('/admin/email',[AdminController::class, 'showEmailForm']);
    Route::post('/admin/email',[AdminController::class, 'sendEmail']);
    Route::get('/payment',[PaymentController::class,'getPayment']);
    Route::post('/payment',[PaymentController::class,'postPayment']);
    Route::get('/payment/complete',[PaymentController::class,'completePayment']);
});

