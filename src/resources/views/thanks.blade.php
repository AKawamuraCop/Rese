@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')
<div class="thanks-page">
    <div class="thanks-page__inner">
        <h2 class="thanks-message">会員登録ありがとうございます</h2>
        <a href="{{ route('login') }}" class="button">ログインする</a>
    </div>
</div>
@endsection