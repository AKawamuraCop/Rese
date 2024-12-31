@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/list.css') }}">
@endsection

@section('content')
<div class="search-bar">
    <form action="/search" method="get" class="search-form" id="search-form">
        <select name="rate" class="order-dropdown" onchange="submitForm()">
            <option value="" disabled selected>並び替え：評価高/低</option>
            <option value="1" @if(request('rate') == '1') selected @endif>ランダム</option>
            <option value="2" @if(request('rate') == '2') selected @endif>高い</option>
            <option value="3" @if(request('rate') == '3') selected @endif>低い</option>
        </select>
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
            <option value="4" @if(request('genre') == '4') selected @endif>寿司</option>
            <option value="5" @if(request('genre') == '5') selected @endif>焼肉</option>
        </select>
        <!-- キーワード検索 -->
        <div class="search-input-container">
            <i class="fa fa-search search-icon"></i>
            <input type="text" placeholder="Search..." name="search" class="search-input"
                value="{{ request('search') }}" 
                onkeydown="if (event.keyCode == 13) { submitForm(); return false; }">
        </div>
    </form>
</div>

<div class="restaurant-list-container">
    <div class="restaurant-list">
        @foreach($restaurants as $restaurant)
        <div class="restaurant-card">
            @if($restaurant->image)
                <img src="{{ preg_match('/^http/', $restaurant->image) ? $restaurant->image : asset($restaurant->image) }}"
                    alt="Restaurant Image" class="restaurant-card__image">
            @else
            <div class="image-default">
                <i class="fa-solid fa-image"></i>
            </div>
            @endif
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
                    <form class="details-form" action="/restaurant/detail" method="get">
                        <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">
                        <input type="hidden" name="route" value="list">
                        <button class="details-button">詳しくみる</button>
                    </form>
                    <form class="favorite-form" action="/favorite" method="post"> 
                        @csrf
                        <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">
                        <button class="favorite_btn">
                            <i class="fa-solid fa-heart {{ $favorites->contains('restaurant_id', $restaurant->id) ? 'favorite' : 'not-favorite' }}"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<script>
function submitForm() {
    document.getElementById('search-form').submit();
}
</script>
@endsection
