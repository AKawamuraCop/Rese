@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/list.css') }}">
@endsection

@section('content')
<div class="search-bar">
    <div class="search-bar-box">
    <form action="/search" method="get" class="search-form" id="search-form">
        <select name="area" class="search-dropdown" onchange="submitForm()">
            <option value="">All areas</option>
            <option value="1" @if(request('area') == '1') selected @endif>東京</option>
            <option value="2" @if(request('area') == '2') selected @endif>大阪</option>
            <option value="3" @if(request('area') == '3') selected @endif>福岡</option>
        </select>
        <select name="genre" class="search-dropdown" onchange="submitForm()">
            <option value="">All genres</option>
            <option value="1" @if(request('genre') == '1') selected @endif>イタリアン</option>
            <option value="2" @if(request('genre') == '2') selected @endif>ラーメン</option>
            <option value="3" @if(request('genre') == '3') selected @endif>居酒屋</option>
            <option value="3" @if(request('genre') == '4') selected @endif>寿司</option>
            <option value="3" @if(request('genre') == '5') selected @endif>焼肉</option>
        </select>
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
                @foreach($restaurant->areas as $area)
                <span class="tag">#{{ $area->area_name }}</span>
            @endforeach
            @foreach($restaurant->genres as $genre)
                <span class="tag">#{{ $genre->genre_name }}</span>
            @endforeach
            </div>
            <div class="form-button">
                <form class="details-form" action="/restaurant/detail" method="get">
                    <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">
                    <input type="hidden" name="route" value="list">
                    <button class="details-button">詳しく見る</button>
                </form>
                <form class="favorite-form" action="/favorite" method="post"> 
                    @csrf
                    <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">
                    <input type="hidden" name="route" value="list">
                    <button class="favorite_btn">
                        <i class="fa-solid fa-heart {{ $favorites->contains('restaurant_id', $restaurant->id) ? 'favorite' : 'not-favorite' }}"></i>
                    </button>
                </form>
            </div>
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