@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')

<div class="contact__alert">
    @if(session('message'))
    <div class="contact__alert--success">
        {{ session('message') }}
    </div>
    @endif
    @if ($errors->any())
    <div class="contact__alert--danger">
        <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
    @endif
</div>]

{{ route('login') }}
<br />
{{ route('logout') }}

<?php
echo'<br />Auth check =';
var_dump(Auth::check());
?>

<div class="login-form__content">
    <div class="login-form__heading">
        <h2>Login</h2>
    </div>
    <form class="form" action="/login" method="post">
    @csrf
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">メールアドレス</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="email" name="email" value="{{ old('email') }}" />
                </div>
                <div class="form__error">
                    @error('email')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">パスワード</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="password" name="password" />
                </div>
                <div class="form__error">
                    @error('password')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit">ログイン</button>
        </div>
    </form>
    <div class="register__link">
        <a class="register__button-submit" href="/register">会員登録の方はこちら</a>
    </div>
</div>
@endsection
