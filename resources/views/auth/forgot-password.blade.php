@extends('layouts.layout')

@section('title', 'Восстановление пароля — AVAMotors')

@push('styles')
    @vite(['resources/css/auth.css'])
@endpush

@section('content')

    <div class="auth-wrap">
        <div class="auth-box">
            <h1 class="auth-title">Забыли пароль?</h1>
            <p class="auth-sub">Введите e-mail — пришлём ссылку для сброса пароля</p>

            @if(session('status'))
                <div class="flash-success">✓ {{ session('status') }}</div>
            @endif

            @if($errors->has('email'))
                @php
                    $msg = $errors->first('email');
                    $friendly = match($msg) {
                        'passwords.throttled' => 'Подождите немного перед повторной отправкой.',
                        'passwords.user'      => 'Пользователь с таким e-mail не найден.',
                        'passwords.sent'      => 'Ссылка уже была отправлена. Проверьте почту.',
                        default               => $msg,
                    };
                @endphp
                <div class="flash-error">{{ $friendly }}</div>
            @endif

            <form action="{{ route('password.email') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email"
                           value="{{ old('email') }}"
                           placeholder="you@example.com"
                           required autofocus>
                </div>
                <button type="submit" class="submit-btn">Отправить ссылку</button>
            </form>

            <p class="login-link">
                Вспомнили пароль? <a href="{{ route('login') }}">Войти</a>
            </p>
        </div>
    </div>

@endsection
