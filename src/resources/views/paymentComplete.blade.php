@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/paymentComplete.css') }}">
@endsection

@section('content')
<div class="complete-page">
    <div class="complete-page__inner">
         <h2 class="complete-message">決済が完了しました！</h2>
         <a href="/list" class="button">戻る</a>
    </div>
</div>
@endsection
