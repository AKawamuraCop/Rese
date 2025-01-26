@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/feedbackList.css') }}">
@endsection

@section('content')
@if (session('msg'))
<div class="flash_message">
    {{ session('msg') }}
</div>
@endif
    <div class="feedback-list">
        <h2>口コミ情報</h2>

        @foreach($feedbacks as $feedback)
            <div class="feedback-item">
                <div class="feedback-user">
                    <p>投稿者: {{ $feedback->user->name }}</p> <!-- ユーザー名を表示 -->
                </div>
                <div class="feedback-rating">
                    <span class="feedback-stars">
                        @for ($i = 1; $i <= 5; $i++)
                            <span class="star {{ $i <= $feedback->rating ? 'filled' : '' }}">★</span>
                        @endfor
                    </span>
                </div>
                <div class="feedback-content">
                    <p>{{ $feedback->comment }}</p>
                </div>
                <div class="feedback-image">
                    @if($feedback->image)
                    <img src="{{ preg_match('/^http/', $feedback->image) ? $feedback->image : asset($feedback->image) }}"
                    alt="feedback Image" class="feedback-image">
                    @endif
                </div>

                @if(Auth::user()->auth == 1)
                    <form action="/feedback/delete/{{ $feedback->id }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="delete-button">口コミを削除</button>
                    </form>
                @endif
            </div>
        @endforeach
    </div>
@endsection
