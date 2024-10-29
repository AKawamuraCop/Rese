@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
@if (session('result'))
<div class="flash_message">
    {{ session('result') }}
</div>
@endif
<h3 class="user-title">{{$user->name}}さん</h3>
<div class="main-content">
    <div class="booking-info">
        <h1 class="title">予約状況</h1>
        <div class="booking-details">
            @if($reservations && $reservations->isNotEmpty())
                @foreach($reservations as $reservation)
                    <div class="booking-details-card">
                        <form class="reservation-form" action="/reservation/destroy" method="post">
                            @csrf
                            <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">
                            <button class="close-btn"><i class="fa-solid fa-circle-xmark"></i></button>
                        </form>
                        <p><i class="fa-solid fa-clock"></i>予約 {{ $loop->iteration }}</p>
                        <form class="reservation-form" action="/reservation/update" method="post">
                            @csrf
                            <input type="hidden" name="_method" value="put">
                            <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">
                            <table>
                                <tr>
                                    <td><strong>Shop</strong></td>
                                    <td>{{ $reservation->restaurant->name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Date</strong></td>
                                    <td><input type="date" id="dateInput" name="date" value="{{ $reservation->date }}"></td>
                                </tr>
                                <tr>
                                    <td><strong>Time</strong></td>
                                    <td>
                                        <select name="time" id="timeInput" >
                                            <option value="">時間を選択</option>
                                                @foreach (range(9, 23) as $hour)
                                                    @foreach (range(0, 1) as $half)
                                                        @php
                                                            $hourFormatted = str_pad($hour, 2, '0', STR_PAD_LEFT);
                                                            $minuteFormatted = $half * 30;
                                                            $time = "{$hourFormatted}:" . str_pad($minuteFormatted, 2, '0', STR_PAD_LEFT);
                                                            $reservationTime = isset($reservation) ? \Carbon\Carbon::parse($reservation->time)->format('H:i') : '';
                                                        @endphp
                                                        <option value="{{ $time }}" {{ $reservationTime == $time ? 'selected' : '' }}>{{ $time }}</option>
                                                    @endforeach
                                                @endforeach
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Number</strong></td>
                                    <td>
                                        <select id="numberInput" name="number" >
                                            <option value="">人数を選択</option>
                                                @foreach (range(1, 10) as $number)
                                                    <option value="{{ $number }}"{{ $reservation->number == $number ? 'selected' : '' }}>{{ $number }}人</option>
                                                @endforeach
                                        </select>
                                    </td>
                                </tr>
                            </table>
                            <button class="update-button">予約を変更する</i></button>
                        </form>
                    </div>
                @endforeach
            @else
                <p>予約はありません</p>
            @endif
        </div>
    </div>
    <div class="restaurant-list">
        <h1 class="title">お気に入り店舗</h1>
        <div class="restaurant-details">
            @foreach($favorites as $favorite)
                <div class="restaurant-card">
                    <img class="restaurant-card__image" src="{{ $favorite->restaurant->image }}" alt="{{ $favorite->restaurant->name }}" />
                    <div class="restaurant-info">
                        <h4 class="restaurant-title">{{$favorite->restaurant->name}}</h4>
                        <div class="restaurant-tag">
                            @foreach($favorite->restaurant->areas as $area)
                                <span class="tag">#{{ $area->name }}</span>
                            @endforeach
                            @foreach($favorite->restaurant->genres as $genre)
                                <span class="tag">#{{ $genre->name }}</span>
                            @endforeach
                        </div>
                        <div class="form-button">
                            <form class="details-form" action="/restaurant/detail" method="get">
                                <input type="hidden" name="restaurant_id" value="{{ $favorite->restaurant->id }}">
                                <input type="hidden" name="route" value="mypage">
                                <button class="details-button">
                                    詳しくみる
                                </button>
                            </form>
                            <form class="favorite-form" action="/favorite" method="post">
                                @csrf
                                <input type="hidden" name="restaurant_id" value="{{ $favorite->restaurant->id }}">
                                <input type="hidden" name="route" value="mypage">
                                <button class="favorite_btn">
                                    <i class="fa-solid fa-heart favorite"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
