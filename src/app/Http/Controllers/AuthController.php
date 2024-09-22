<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

class AuthController extends Controller
{
    public function getRegister()
    {
        return view('auth.register');
    }

    public function postRegister(RegisterRequest $request)
    {
        try {
            $user = User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'email_verified_at' => null,
            ]);

            // イベントを発行して、確認メールを送信
            event(new Registered($user));

            return redirect()->route('verification.notice');
        } catch (\Throwable $th) {

            return redirect('register')->with('result', 'エラーが発生しました' . $th->getMessage());
        }
    }

    public function verification(){
        return view('thanks');
    }

    public function verificationVerify($id, $hash)
{
    $user = User::find($id);

    // ユーザーの確認処理
    if (! $user || ! hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
        return redirect('login')->with('result', '無効な確認リンクです。');
    }

    if (!$user->hasVerifiedEmail()) {
        $user->markEmailAsVerified();
    }

    return redirect('login')->with('result', 'メールアドレスが確認されました。');
}

    public function getLogin()
    {
        if(Auth::check())
        {
            return redirect('/list');
        }
        else
        {
            return view('auth.login');
        }
    }

    public function postLogin(LoginRequest $request)
    {
        if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
            return redirect('list');
        } else {
            return redirect('login')->with('result', 'メールアドレスまたはパスワードが間違っております');
        }
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect("login");
    }
}
