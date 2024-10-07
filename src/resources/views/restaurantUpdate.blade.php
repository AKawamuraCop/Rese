@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/restaurantUpdate.css') }}">
@endsection

@section('content')
<form action="/restaurant/update" method="post" enctype="multipart/form-data" class="restaurant-form">
    @csrf
    <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">
    <div class="form-group">
        <label for="restaurant_name">Restaurant Name</label>
        <input type="text" id="restaurant_name" name="restaurant_name" value="{{ $restaurant->name }}" required>
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea id="description" name="description" rows="5">{{ optional($restaurant)->description }}</textarea>
    </div>

    <div class="form-group">
        <label for="genre">Genre</label>
        <select id="genre" name="genres[]" multiple>
            <option value='{"number": 1, "name": "イタリアン"}'@if($restaurant && $restaurant->genres->contains('number', 1)) selected @endif>イタリアン</option>
            <option value='{"number": 2, "name": "ラーメン"}'@if($restaurant && $restaurant->genres->contains('number', 2)) selected @endif>ラーメン</option>
            <option value='{"number": 3, "name": "居酒屋"}'@if($restaurant && $restaurant->genres->contains('number', 3)) selected @endif>居酒屋</option>
            <option value='{"number": 4, "name": "寿司"}'@if($restaurant && $restaurant->genres->contains('number', 4)) selected @endif>寿司</option>
            <option value='{"number": 5, "name": "焼肉"}'@if($restaurant && $restaurant->genres->contains('number', 5)) selected @endif>焼肉</option>
        </select>
    </div>

    <div class="form-group">
        <label for="area">Area</label>
        <select id="area" name="areas[]" multiple>
            <option value='{"number": 1, "name": "東京"}'@if($restaurant && $restaurant->areas->contains('number', 1)) selected @endif>東京</option>
            <option value='{"number": 2, "name": "大阪"}'@if($restaurant && $restaurant->areas->contains('number', 2)) selected @endif>大阪</option>
            <option value='{"number": 3, "name": "福岡"}'@if($restaurant && $restaurant->areas->contains('number', 3)) selected @endif>福岡</option>
        </select>
    </div>

    <div class="form-group">
        <label for="image">Image</label>
        <input type="file" id="image" name="image" accept="image/*" >
    </div>

    <button type="submit" class="submit-btn">登録</button>
</form>
@endsection
