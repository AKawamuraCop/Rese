<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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

Route::post('/register', [RegisteredUserController::class, 'register'])->name('custom.register');

Route::get('/thanks', function () {
    return view('thanks');
})->name('thanks');

Route::middleware('auth')->group(function () {
    Route::get('/restaurant_list', [ContactController::class, 'search']);

});
