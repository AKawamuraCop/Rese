<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\FavoriteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\AuthController;

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

Route::middleware('auth','verified')->group(function(){
    Route::get('/logout', [AuthController::class,'getLogout']);
    Route::get('/list',[RestaurantController::class,'getList']);
    Route::get('/restaurant/detail',[RestaurantController::class,'getDetail']);
    Route::get('/search', [RestaurantController::class,'search']);
    Route::post('/reserve', [ReservationController::class,'store']);
    Route::get('/mypage',[MypageController::class,'show']);
    Route::post('/favorite',[FavoriteController::class, 'store']);
    Route::post('/destroy',[ReservationController::class,'destroy']);
});

