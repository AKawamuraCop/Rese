@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/reservationCheck.css') }}">
@endsection

@section('content')
    <div class="container qr-container">
        @if ($qrData && is_array($qrData))
            <table class="qr-table">
                <thead>
                    <tr>
                        <th>店舗名</th>
                        <th>予約日</th>
                        <th>時間</th>
                        <th>人数</th>
                        <th>ユーザーID</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($qrData as $reservation)  {{-- 複数の予約情報をループ処理 --}}
                        <tr>
                            <td>{{ $reservation['restaurant_name'] }}</td>
                            <td>{{ $reservation['date'] }}</td>
                            <td>{{ $reservation['time'] }}</td>
                            <td>{{ $reservation['number'] }}</td>
                            <td>{{ $reservation['user_id'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>情報がありません。</p>
        @endif
    </div>
@endsection