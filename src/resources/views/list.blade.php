@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/list.css') }}">
@endsection

@section('content')
<div class="search-bar">
    <div class="search-bar-box">
    <form action="/search" method="get" class="search-form" id="search-form">
        <!-- Area Dropdown -->
        <select name="area" class="search-dropdown" onchange="submitForm()">
            <option value="">All areas</option>
            @foreach ($areas as $area)
                <option value="{{ $area->id }}" @if( request('area')==$area->id ) selected @endif>{{ $area->area_name }}</option>
            @endforeach
        </select>

        <!-- Genre Dropdown -->
        <select name="genre" class="search-dropdown" onchange="submitForm()">
            <option value="">All genres</option>
            @foreach ($genres as $genre)
                <option value="{{ $genre->id }}" @if( request('genre')==$genre->id ) selected @endif>{{ $genre->genre_name }}</option>
            @endforeach
        </select>

        <!-- Search Input -->
        <div class="search-input-container">
                <i class="fa fa-search search-icon"></i>
                <input type="text" placeholder="Search..." name="search" class="search-input" value="{{ request('search') }}" onkeydown="if (event.keyCode == 13) { this.form.submit(); return false; }">
        </div>
    </form>
</div>
</div>
<div class="restaurant-list">
    @foreach($restaurants as $restaurant)
    <div class="restaurant-card">
        <img src="{{ $restaurant->image }}" alt="{{ $restaurant->restaurant_name }}" class="restaurant-card__image">
        <div class="restaurant-info">
            <h2 class="restaurant-title">{{ $restaurant->restaurant_name }}</h2>
            <div class="restaurant-tag">
                 @foreach($restaurant->area as $obj)
                <span class="tag">#{{ $obj->area_name }}</span>
            @endforeach
            @foreach($restaurant->genre as $gen)
                <span class="tag">#{{ $gen->genre_name }}</span>
            @endforeach
            </div>
            <div class="form-button">
                <a href="/restaurant/detail/{{ $restaurant->id }}" class="details-button">詳しく見る</a>
            <form class="favorite-form" action="/favorite" method="post">
            @csrf
            <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">
            <button class="favorite_btn">
                <i class="fa-solid fa-heart {{ $favorites->contains('restaurant_id', $restaurant->id) ? 'favorite' : 'not-favorite' }}"></i>
            </button>
            </div>
        </form>
        </div>
        
    </div>
    @endforeach
</div>

<script>
function submitForm() {
    document.getElementById('search-form').submit();
}
</script>
@endsection
