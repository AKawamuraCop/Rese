@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/done.css') }}">
@endsection

@section('content')
<div class="done-page">
    <div class="done-page__inner">
         <h2 class="done-message">ご予約ありがとうございます</h2>
         @if($route == 'mypage')
                <a href="/mypage" class="button">戻る</a>
            @else
                <a href="/list" class="button">戻る</a>
            @endif
    </div>
</div>
@endsection