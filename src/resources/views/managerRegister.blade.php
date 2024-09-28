@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/managerRegister.css') }}">
@endsection

@section('content')
@if (session('result'))
<div class="flash_message">
  {{ session('result') }}
</div>
@endif
<div class="register-form">
    <h2 class="register-form__heading content__heading">Manager Registration</h2>
    <div class="register-form__inner">
        <form class="register-form__form" action="/managerRegister" method="post">
            @csrf
            <input type="hidden" name="auth" value="2">
            <div class="register-from__group">
                <i class="fa fa-user"></i><input class="register-form__input" type="text" name="name" value="{{ old('name') }}" placeholder="Username">
                <p class="register-form__error-message">
                    @error('name')
                    {{ $message }}
                    @enderror
                </p>
            </div>
            <div class="register-from__group">
                <i class="fa fa-envelope"></i><input class="register-form__input" type="mail" name="email" value="{{ old('email') }}" placeholder="Email">
                <p class="register-form__error-message">
                    @error('email')
                    {{ $message }}
                    @enderror
                </p>
            </div>
            <div class="register-from__group">
                <i class="fa fa-lock"></i><input class="register-form__input" type="password" name="password" placeholder="Password">
                <p class="register-form__error-message">
                    @error('password')
                    {{ $message }}
                    @enderror
                </p>
            </div>
            <div class="register-from__group">
                <input class="register-form__input" type="password" name="password_confirmation" placeholder="Confirmed">
            </div>
            <div class="form__btn">
                <input class="register-form__btn btn" type="submit" value="登録">
            </div>
        </form>
    </div>
</div>
@endsection
