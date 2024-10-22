@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/restaurantUpdate.css') }}">
@endsection

@section('content')
<form action="/restaurant/update" method="post" enctype="multipart/form-data" class="restaurant-form">
    @csrf
    <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">
    <div class="form-group">
        <h3 for="restaurant_name">Restaurant Name</label>
        <input type="text" id="restaurant_name" name="restaurant_name" value="{{ $restaurant->name }}" required>
    </div>

    <div class="form-group">
        <h3 for="description">Description</h3>
        <textarea id="description" name="description" rows="5">{{ optional($restaurant)->description }}</textarea>
    </div>

    <div class="form-group">
        <h3 for="genre">Genre</h3>
        <label>
            <input type="checkbox" name="genres[]" value='{"number": 1, "name": "イタリアン"}'@if($restaurant && $restaurant->genres->contains('number', 1)) checked @endif> イタリアン
        </label>
        <label>
            <input type="checkbox" name="genres[]" value='{"number": 2, "name": "ラーメン"}'@if($restaurant && $restaurant->genres->contains('number', 2)) checked @endif> ラーメン
        </label>
        <label>
            <input type="checkbox" name="genres[]" value='{"number": 3, "name": "居酒屋"}'@if($restaurant && $restaurant->genres->contains('number', 3)) checked @endif> 居酒屋
                </label>
        <label>
            <input type="checkbox" name="genres[]" value='{"number": 4, "name": "寿司"}'@if($restaurant && $restaurant->genres->contains('number', 4)) checked @endif> 寿司
        </label>
        <label>
            <input type="checkbox" name="genres[]" value='{"number": 5, "name": "焼肉"}'@if($restaurant && $restaurant->genres->contains('number', 5)) checked @endif> 焼肉
        </label>
    </div>

    <div class="form-group">
        <h3 for="area">Area</h3>
        <div class="area-options">
            <label>
                <input type="checkbox" name="areas[]" value='{"number": 1, "name": "東京"}'@if($restaurant && $restaurant->areas->contains('number', 1)) checked @endif>東京</label>
            <label>
            <input type="checkbox" name="areas[]" value='{"number": 2, "name": "大阪"}'@if($restaurant && $restaurant->areas->contains('number', 2)) checked @endif>大阪</label>
            <label>
                <input type="checkbox" name="areas[]" value='{"number": 3, "name": "福岡"}'@if($restaurant && $restaurant->areas->contains('number', 3)) checked @endif>福岡</label>
    </div>

    <div class="form-group">
        <h３ for="image">Image</h３>
        <input type="file" id="image" name="image" accept="image/*" >
    </div>

    <div class="button-container">
        <button type="submit" class="submit-btn">更新</button>
        <a href="/restaurant/updateList" class="submit-btn return-btn">戻る</a>
    </div>
</form>
@endsection
