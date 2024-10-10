<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function showEmailForm()
    {
        return view('adminEmail');
    }

    public function sendEmail(Request $request)
    {
        // バリデーション
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // 全ユーザーを取得
        $users = User::all();

        // 各ユーザーにメールを送信
        foreach ($users as $user) {
            Mail::raw($request->message, function ($message) use ($user, $request) {
                $message->to($user->email)
                        ->subject($request->subject);
            });
        }

        return redirect()->back()->with('success', 'メールが送信されました！');
    }
}

