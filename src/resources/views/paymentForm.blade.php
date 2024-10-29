@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/paymentForm.css') }}">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
@endsection

@section('content')
<script async src="https://js.stripe.com/v3/buy-button.js"></script>
<div class="payment-form">
    <stripe-buy-button buy-button-id="buy_btn_1QBRPbHvlMYyO94ep7iOwaXI"
    publishable-key="pk_test_51Q8UoSHvlMYyO94eZfhM7wpMxilCZdnAGx9KNvWNSwF82UCk7GvJrRrufPdpcWehgbUqI6vFkA5mO0mfEiDDFzhA00V0z16r2e">
    </stripe-buy-button>
</div>
@endsection
