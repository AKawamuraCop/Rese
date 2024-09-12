@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/list.css') }}">
@endsection

@section('content')
<div class="restaurant-list">
    @foreach($restaurants as $restaurant)
    <div class="restaurant-card">
        <img src="{{ $restaurant->image }}" alt="{{ $restaurant->restaurant_name }}" class="restaurant-card__image">
        <a href="/restaurant/detail/{{ $restaurant->id }}" class="details-button">詳しく見る</a>
    </div>
    @endforeach
</div>
@endsection
