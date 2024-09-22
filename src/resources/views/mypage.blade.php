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
                @if($reservations && $reservations->isNotEmpty())
                    @foreach($reservations as $reservation)
                        <div class="booking-details-card">
                            <form class="reservation-form" action="/destroy" method="post">
                                @csrf
                                <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">
                                <button class="close-btn"><i class="fa-solid fa-circle-xmark"></i></button>
                            </form>
                            <p><i class="fa-solid fa-clock"></i>予約 {{ $loop->iteration }}</p>
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
                            <form class="reservation-form" action="/update" method="get">
                                @csrf
                                <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">
                                <input type="hidden" name="route" value="update">
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
                        <img class="restaurant-card__image" src="{{ $favorite->restaurant->image }}" alt="{{ $favorite->restaurant->restaurant_name }}" />
                        <div class="restaurant-info">
                            <h4 class="restaurant-title">{{$favorite->restaurant->restaurant_name}}</h4>
                            <div class="restaurant-tag">
                                @foreach($favorite->restaurant->areas as $area)
                                    <span class="tag">#{{ $area->area_name }}</span>
                                @endforeach
                                @foreach($favorite->restaurant->genres as $genre)
                                    <span class="tag">#{{ $genre->genre_name }}</span>
                                @endforeach
                            </div>
                            <div class="form-button">
                                <form class="details-form" action="/restaurant/detail" method="get">
                                    <input type="hidden" name="restaurant_id" value="{{ $favorite->restaurant->id }}">
                                    <input type="hidden" name="route" value="mypage">
                                    <button class="details-button">
                                        詳しく見る
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
