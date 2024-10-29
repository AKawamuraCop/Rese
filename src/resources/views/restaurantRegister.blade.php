@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/restaurantRegister.css') }}">
@endsection

@section('content')
@if (session('result'))
    <div class="flash_message">
        {{ session('result') }}
    </div>
@endif
<div class="form-header">
    <a href="/restaurant/updateList" class="update-btn">更新はこちらから</a>
</div>
<form action="/restaurant/register" method="post" enctype="multipart/form-data" class="restaurant-form">
    @csrf
    <div class="form-group">
        <h3 for="restaurant_name">Restaurant Name</h3>
        <input type="text" id="name" name="name">
    </div>
    <p class="error-message">
        @error('name')
            {{ $message }}
        @enderror
    </p>
    <div class="form-group">
        <h3 for="description">Description</h3>
        <textarea id="description" name="description" rows="5" ></textarea>
    </div>
    <p class="error-message">
        @error('description')
            {{ $message }}
        @enderror
    </p>
    <div class="form-group">
        <h3 for="genre">Genre</h3>
        <label><input type="checkbox" name="genres[]" value='{"number": 1, "name": "イタリアン"}'> イタリアン</label>
        <label><input type="checkbox" name="genres[]" value='{"number": 2, "name": "ラーメン"}'> ラーメン</label>
        <label><input type="checkbox" name="genres[]" value='{"number": 3, "name": "居酒屋"}'> 居酒屋</label>
        <label><input type="checkbox" name="genres[]" value='{"number": 4, "name": "寿司"}'> 寿司</label>
        <label><input type="checkbox" name="genres[]" value='{"number": 5, "name": "焼肉"}'> 焼肉</label>
    </div>
    <div class="form-group">
        <h3 for="area">Area</h3>
        <div class="area-options">
            <label><input type="checkbox" name="areas[]" value='{"number": 1, "name": "東京"}'>東京</label>
            <label><input type="checkbox" name="areas[]" value='{"number": 2, "name": "大阪"}'>大阪</label>
            <label><input type="checkbox" name="areas[]" value='{"number": 3, "name": "福岡"}'>福岡</label>
        </div>
    </div>
    <div class="form-group">
        <h3 for="image">Image</h3>
        <input type="file" id="image" name="image" accept="image/*" >
    </div>
    <p class="error-message">
        @error('image')
            {{ $message }}
        @enderror
    </p>
    <button type="submit" class="submit-btn">登録</button>
</form>

@endsection