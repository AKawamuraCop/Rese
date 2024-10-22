@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/adminEmail.css') }}">
@endsection

@section('content')
<div class="container">
        <h1>ユーザーへの一斉メール送信</h1>
        <form class= "email-form" action="/admin/email" method="post">
            @csrf
            <div class="form-group">
                <label for="subject">件名:</label>
                <input type="text" name="subject" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="message">メッセージ:</label>
                <textarea name="message" class="form-control" rows="20" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">送信</button>
        </form>
    </div>
@endsection
