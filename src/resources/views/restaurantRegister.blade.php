@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/restaurantRegister.css') }}">
@endsection

@section('content')
<form action="/restaurantRegister" method="post" enctype="multipart/form-data" class="restaurant-form">
    @csrf
    <div class="form-group">
        <label for="restaurant_name">Restaurant Name</label>
        <input type="text" id="restaurant_name" name="restaurant_name" required>
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea id="description" name="description" rows="5" ></textarea>
    </div>

    <div class="form-group">
        <label for="genre">Genre</label>
        <select id="genre" name="genres[]" multiple>
            <option value='{"id": 1, "name": "イタリアン"}'>イタリアン</option>
            <option value='{"id": 2, "name": "ラーメン"}'>ラーメン</option>
            <option value='{"id": 3, "name": "居酒屋"}'>居酒屋</option>
            <option value='{"id": 4, "name": "寿司"}'>寿司</option>
            <option value='{"id": 5, "name": "焼肉"}'>焼肉</option>
            <!-- 他のジャンルを追加 -->
        </select>
    </div>

    <div class="form-group">
        <label for="area">Area</label>
        <select id="area" name="areas[]" multiple>
            <option value='{"id": 1, "name": "東京"}'>東京</option>
            <option value='{"id": 2, "name": "大阪"}'>大阪</option>
            <option value='{"id": 3, "name": "福岡"}'>福岡</option>
            <!-- 他のエリアを追加 -->
        </select>
    </div>

    <div class="form-group">
        <label for="image">Image</label>
        <input type="file" id="image" name="image" accept="image/*" >
    </div>

    <button type="submit" class="submit-btn">Submit</button>
</form>

@endsection
