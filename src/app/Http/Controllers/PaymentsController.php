<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;

class PaymentsController extends Controller
{
    public function getPayment()
    {
        return view('paymentForm');
    }

    public function postPayment(Request $request)
    {
        try
        {
            Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

            $user = auth()->user();

            // ユーザーがすでにStripeの顧客IDを持っているか確認
            if (!$user->stripe_id) {
            // 顧客IDがない場合、新しい顧客を作成し、そのIDを保存
            $customer = Customer::create([
                'email' => $user->email,
                'source' => $request->stripeToken,
            ]);

            // 顧客IDをデータベースに保存
            $user->stripe_id = $customer->id;
            $user->save();
        } else {
        $customer = Customer::retrieve($user->stripe_id); // 既存の顧客IDを使用
        }

            $charge = Charge::create(array(
                'customer' => $customer->id,
                'amount' => 1000,
                'currency' => 'jpy'
            ));

            return view('paymentComplete');

        }
        catch(Exception $e)
        {
            return redirect('payment')->with('result', 'エラーが発生しました' . $e->getMessage());
        }
    }

    public function completePayment()
    {
        return view('paymentComplete');
    }


}
