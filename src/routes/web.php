<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\ReservationController;
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
    ->middleware('auth')
    ->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verificationVerify'])
    ->middleware(['auth', 'signed'])
    ->name('verification.verify');
Route::get('/login', [AuthController::class,'getLogin'])->name('login');
Route::post('/login', [AuthController::class,'postLogin']);

Route::middleware('auth','verified')->group(function(){
    Route::get('/list',[RestaurantController::class,'getList']);
    Route::get('/restaurant/detail/{id}/',[RestaurantController::class,'getDetail']);
    Route::get('/search', [RestaurantController::class,'search']);
    Route::post('/reserve', [ReservationController::class,'store']);
});
// Route::get('/register', function () {
//     return view('auth.register');  // 登録フォームのビューを返す
// })->name('register');


// Route::post('/register', [RegisteredUserController::class, 'register'])->name('custom.register');

// Route::get('/thanks', function () {
//     return view('thanks');
// })->name('thanks');

// Route::get('/email/verify/{id}/{hash}', function (Request $request) {
//     // ユーザーを手動で取得
//     $user = User::findOrFail($request->route('id'));

//     // ハッシュが一致するか確認
//     if (! hash_equals(sha1($user->getEmailForVerification()), (string) $request->route('hash'))) {
//         abort(403, 'Invalid verification link.');
//     }

//     // メール確認を実行
//     if (!$user->hasVerifiedEmail()) {
//         $user->markEmailAsVerified();
//     }

//     // ログイン画面へリダイレクト
//     return redirect('/login')->with('verified', true);
// })->middleware(['signed'])->name('verification.verify');


// Route::get('/login', function () {
//     return view('auth.login');
// })->name('login');

// Route::middleware('auth','verified')->group(function () {
//     Route::get('/list', [ReservationController::class, 'search']);

// });
