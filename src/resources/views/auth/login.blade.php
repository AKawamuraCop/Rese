@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
@endsection

@section('content')
@if (session('result'))
<div class="flash_message">
  {{ session('result') }}
</div>
@endif
<div class="login-form">
    <h2 class="login-form__heading content__heading">Login</h2>
    <div class="login-form__inner">
        <form class="login-form__form" action="/login" method="post">
            @csrf
            <div class="login-from__group">
                <i class="fa fa-envelope"></i><input class="login-form__input" type="email" name="email" value="{{ old('email') }}" placeholder="Email">
                <p class="login-form__error-message">
                    @error('email')
                    {{ $message }}
                    @enderror
                </p>
            </div>
            <div class="login-from__group">
                <i class="fa fa-lock"></i><input class="login-form__input" type="password" name="password" placeholder="Password">
                <p class="login-form__error-message">
                    @error('password')
                    {{ $message }}
                    @enderror
                </p>
            </div>
            <div class="form__btn">
                <input class="login-form__btn btn" type="submit" value="ログイン">
            </div>
        </form>
    </div>
</div>
@endsection
