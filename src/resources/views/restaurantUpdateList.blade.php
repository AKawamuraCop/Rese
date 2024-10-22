@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/restaurantUpdateList.css') }}">
@endsection

@section('content')
<div class="restaurant-list">
    @foreach($restaurants as $restaurant)
    <div class="restaurant-card">
        <img src="{{ (preg_match('/^http/', $restaurant->image)) ? $restaurant->image : asset($restaurant->image) }}" alt="Restaurant Image" class="restaurant-card__image">
        <div class="restaurant-info">
            <h2 class="restaurant-title">{{ $restaurant->name }}</h2>
            <div class="restaurant-tag">
                @foreach($restaurant->areas as $area)
                <span class="tag">#{{ $area->name }}</span>
            @endforeach
            @foreach($restaurant->genres as $genre)
                <span class="tag">#{{ $genre->name }}</span>
            @endforeach
            </div>
            <div class="form-button">
                <form class="update-form" action="/restaurant/update" method="get">
                    <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">
                    <input type="hidden" name="route" value="list">
                    <button class="update-button">更新する</button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection