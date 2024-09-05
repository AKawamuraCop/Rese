<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Http\Requests\LoginRequest as FortifyLoginRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Auth\RegisteredUserController;


class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Fortify にカスタムコントローラを指定
        Fortify::createUsersUsing(RegisteredUserController::class);


        // 登録ビューの設定
        Fortify::registerView(function () {
            return view('auth.register');
        });

        // ログインビューの設定
        Fortify::loginView(function () {
            return view('auth.login');
        });
    //     Fortify::createUsersUsing(CreateNewUser::class);
    //         Fortify::registerView(function () {
    //     return view('auth.register');
    // });


    RateLimiter::for('login', function (Request $request) {
        $email = (string) $request->email;

        return Limit::perMinute(10)->by($email . $request->ip());
    });

    }
}
