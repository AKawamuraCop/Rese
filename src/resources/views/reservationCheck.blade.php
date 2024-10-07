@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/reservationCheck.css') }}">
@endsection

@section('content')
<div class="reservation-check-container">
    <h1>予約情報</h1>

    @foreach($qrData as $reservation)
        <div class="reservation-info">
            <div class="reservation-details">
                <h1 class="title">予約詳細</h1>
                <p>レストラン名: {{ $reservation['restaurant_name'] }}</p>
                <p>日付: {{ $reservation['date'] }}</p>
                <p>時間: {{ \Carbon\Carbon::parse($reservation['time'])->format('H:i') }}</p>
                <p>人数: {{ $reservation['number'] }}人</p>
                <p>ユーザーID: {{ $reservation['user_id'] }}</p>
            </div>
        </div>
    @endforeach
</div>
@endsection