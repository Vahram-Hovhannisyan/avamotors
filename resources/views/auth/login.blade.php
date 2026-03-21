@extends('layouts.layout')

@section('title', 'Войти — AVAMotors')

@push('styles')
    @vite(['resources/css/auth.css'])
@endpush

@section('content')

    <div class="auth-wrap">
        <div class="auth-box">
            <h1 class="auth-title">Вход</h1>
            <p class="auth-sub">Нет аккаунта? <a href="{{ route('register') }}">Зарегистрироваться</a></p>

            @if(session('status'))
                <div class="flash-success">✓ {{ session('status') }}</div>
            @endif

            @if($errors->any())
                <div class="flash-error">{{ $errors->first() }}</div>
            @endif

            <form action="{{ route('login') }}" method="POST" novalidate>
                @csrf

                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email"
                           value="{{ old('email') }}"
                           placeholder="you@example.com"
                           class="{{ $errors->has('email') ? 'input-error' : '' }}"
                           required autofocus>
                </div>

                <div class="form-group">
                    <label for="password">Пароль</label>
                    <input type="password" id="password" name="password"
                           placeholder="••••••••"
                           required>
                </div>

                <div class="login-row">
                    <label class="form-check">
                        <input type="checkbox" name="remember">
                        Запомнить меня
                    </label>
                    <a href="{{ route('password.request') }}" class="form-link">Забыли пароль?</a>
                </div>

                <button type="submit" class="submit-btn">Войти</button>
            </form>

            <p class="register-link">
                Ещё не зарегистрированы? <a href="{{ route('register') }}">Создать аккаунт</a>
            </p>
        </div>
    </div>

@endsection
