@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/done.css') }}">
@endsection

@section('content')
<div class="done-page">
    <div class="done-page__inner">
        <h2 class="done-message">ご予約ありがとうございます</h2>
        <form class="return-btn" action="/restaurant/detail" method="get">
            @csrf
            <input type="hidden" name="restaurant_id" value="{{ $restaurantId }}">
            <input type="hidden" name="route" value="{{ $route }}">
            <button type="submit" class="button">戻る</button>
        </form>
    </div>
</div>
@endsection