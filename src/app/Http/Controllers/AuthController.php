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
                'auth' => $request['auth'], //3
                'email_verified_at' => null,
            ]);

            // イベントを発行して、確認メールを送信
            event(new Registered($user));

            return redirect()->route('verification.notice');
        } catch (\Throwable $th) {

            return redirect('register')->with('result', 'エラーが発生しました' . $th->getMessage());
        }
    }

    //店舗代表登録
    public function getManagerRegister()
    {
        return view('managerRegister');
    }

    public function postManagerRegister(RegisterRequest $request)
    {
        try {
            $user = User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'auth' => $request['auth'], //2
                'email_verified_at' => null,
            ]);

            // 2(店舗代表)の時は自動的にメール認証を行う。
                $user->markEmailAsVerified();

            return redirect('manager/register')->with('result', '登録が完了しました');

        } catch (\Throwable $th) {

            return redirect('managerRegister')->with('result', 'エラーが発生しました' . $th->getMessage());
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
