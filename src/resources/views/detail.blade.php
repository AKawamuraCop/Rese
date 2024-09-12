@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
<div class="detail-container">
    <div class="restaurant-image">
        <img src="{{ $restaurant->image }}" alt="Image of {{ $restaurant->restaurant_name }}">
    </div>
    <div class="restaurant-info">
        <h1>{{ $restaurant->restaurant_name }}</h1>
        <p>{{ $restaurant->description }}</p>
    </div>
    <div class="reservation-form">
        <h2>予約</h2>
        <form action="/reserve" method="POST">
            @csrf
            <input type="date" name="date" required>
            <input type="time" name="time" required>
            <select name="number" required>
                <option value="">人数を選択</option>
                <option value="1">1人</option>
                <option value="2">2人</option>
                <option value="3">3人</option>
                <!-- Add more options as needed -->
            </select>
            <button type="submit">予約する</button>
        </form>
    </div>
</div>
@endsection
