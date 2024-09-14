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
            <!-- Display all areas -->
            @foreach($restaurant->areas as $area)
                <span class="tag">#{{ $area->area_name }}</span>
            @endforeach
            <!-- Display all genres -->
            @foreach($restaurant->genres as $genre)
                <span class="tag">#{{ $genre->genre_name }}</span>
            @endforeach
        </div>
        <a href="/restaurant/detail/{{ $restaurant->id }}" class="details-button">詳しく見る</a>
    </div>
    @endforeach
</div>

<script>
function submitForm() {
    document.getElementById('search-form').submit();
}
</script>
@endsection
