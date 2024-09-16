@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
<h3 class="user-title">{{$user->name}}さん</h3>
    <div class="main-content">
        <div class="booking-info">
            <h1 class="title">予約状況</h1>
            <div class="booking-details">
                @foreach($reservations as $reservation)
                <div class="booking-details-card">
                    <button class="close-btn">X</button>
                    <p>予約</p>
                    <table>
                        <tr>
                            <td><strong>Shop</strong></td>
                            <td>{{ $reservation->restaurant->restaurant_name }}</td>
                        </tr>
                        <tr>
                            <td><strong>Date</strong></td>
                            <td>{{ $reservation->date }}</td>
                        </tr>
                        <tr>
                            <td><strong>Time</strong></td>
                            <td>{{ $reservation->time }}</td>
                        </tr>
                        <tr>
                            <td><strong>Number</strong></td>
                            <td>{{ $reservation->number }}</td>
                        </tr>
                    </table>
                </div>
                @endforeach
            </div>
        </div>
        <div class="restaurant-info">
            <h1 class="title">お気に入り店舗</h1>
            <div class="restaurant-details">
                @foreach($favorites as $favorite)
                <div class="restaurant-card">
                    <img src="{{ $favorite->restaurant->image }}" alt="{{ $favorite->restaurant->restaurant_name }}" class="restaurant-card__image">
                    <div class="restaurant-card-detail">
                        <h4 class="restaurant-title">{{$favorite->restaurant->restaurant_name}}</h4>
                        @foreach($favorite->restaurant->area as $obj)
                            <span class="tag">#{{ $obj->area_name }}</span>
                        @endforeach
                        @foreach($favorite->restaurant->genre as $gen)
                            <span class="tag">#{{ $gen->genre_name }}</span>
                        @endforeach
                        <button class="details-button">詳しくみる</button>
                    <span class="heart">♥</span>
                    </div>
                    
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
