@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/reservationCheck.css') }}">
@endsection

@section('content')
    <div class="container qr-container">
        <ul class="qr-list">
            @if ($qrData)
                <li class="qr-item"><strong>店舗名:</strong> {{ $qrData['restaurant_name'] }}</li>
                <li class="qr-item"><strong>予約日:</strong> {{ $qrData['date'] }}</li>
                <li class="qr-item"><strong>時間:</strong> {{ $qrData['time'] }}</li>
                <li class="qr-item"><strong>人数:</strong> {{ $qrData['number'] }}</li>
                <li class="qr-item"><strong>ユーザーID:</strong> {{ $qrData['user_id'] }}</li>
            @else
                <li class="qr-item">情報がありません。</li>
            @endif
        </ul>
    </div>
@endsection