@extends('layouts.layout')

@section('title', __('auth.login.title') . ' — AVAMotors')

@push('styles')
    @vite(['resources/css/auth.css'])
@endpush

@section('content')

    <div class="auth-wrap">
        <div class="auth-box">
            <h1 class="auth-title">{{ __('auth.login.title') }}</h1>
            <p class="auth-sub">{{ __('auth.login.no_account') }} <a href="{{ route('register') }}">{{ __('auth.login.register') }}</a></p>

            @if(session('status'))
                <div class="flash-success">✓ {{ session('status') }}</div>
            @endif

            @if($errors->any())
                <div class="flash-error">{{ $errors->first() }}</div>
            @endif

            <form action="{{ route('login') }}" method="POST" novalidate>
                @csrf

                <div class="form-group">
                    <label for="email">{{ __('auth.login.email') }}</label>
                    <input type="email" id="email" name="email"
                           value="{{ old('email') }}"
                           placeholder="you@example.com"
                           class="{{ $errors->has('email') ? 'input-error' : '' }}"
                           required autofocus>
                </div>

                <div class="form-group">
                    <label for="password">{{ __('auth.login.password') }}</label>
                    <input type="password" id="password" name="password"
                           placeholder="••••••••"
                           required>
                </div>

                <div class="login-row">
                    <label class="form-check">
                        <input type="checkbox" name="remember">
                        {{ __('auth.login.remember_me') }}
                    </label>
                    <a href="{{ route('password.request') }}" class="form-link">{{ __('auth.login.forgot_password') }}</a>
                </div>

                <button type="submit" class="submit-btn">{{ __('auth.login.submit') }}</button>
            </form>

            <p class="register-link">
                {{ __('auth.login.no_account') }} <a href="{{ route('register') }}">{{ __('auth.login.register') }}</a>
            </p>
        </div>
    </div>

@endsection
