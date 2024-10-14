@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/paymentForm.css') }}">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
@endsection

@section('content')
<form action="/payment" method="POST" id="payment-form">
    @csrf
    <button id="customButton" class="btn btn-primary mt-5">
        支払い手続きへ進む
    </button>
</form>

<script src="https://checkout.stripe.com/checkout.js"></script>
<script>
    var stripeHandler = StripeCheckout.configure({
        key: "{{ env('STRIPE_PUBLIC_KEY') }}",  // 公開鍵
        amount: 1000,  // 金額（単位は最小通貨単位、ここでは10円）
        name: 'Stripe Demo',
        description: 'これはStripeのデモです。',
        image: 'https://stripe.com/img/documentation/checkout/marketplace.png',
        locale: 'auto',
        currency: 'JPY',
        token: function(token) {
            // サーバーへトークンを送信して支払いを処理
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);

            // フォーム送信
            form.submit();
        }
    });

    document.getElementById('customButton').addEventListener('click', function(e) {
        // Stripeの決済ウィンドウを開く
        stripeHandler.open({
            name: 'Stripe Demo',
            description: 'これはStripeのデモです。',
            amount: 1000, // 決済額を設定
        });
        e.preventDefault();  // ボタンのデフォルト動作を防止
    });

    // Stripeのチェックアウトが閉じられたときの処理
    window.addEventListener('popstate', function() {
        stripeHandler.close();
    });
</script>
@endsection