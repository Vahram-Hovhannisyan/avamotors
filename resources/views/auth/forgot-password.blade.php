@extends('layouts.layout')

@section('title', __('password.title') . ' — AVAMotors')

@push('styles')
    @vite(['resources/css/auth.css'])
@endpush

@section('content')

    <div class="auth-wrap">
        <div class="auth-box">
            <h1 class="auth-title">{{ __('password.title') }}</h1>
            <p class="auth-sub">{{ __('password.subtitle') }}</p>

            @if(session('status'))
                <div class="flash-success">✓ {{__('messages.'.session('status'))}}</div>
            @endif

            @if($errors->has('email'))
                @php
                    $msg = $errors->first('email');
                    $friendly = match($msg) {
                        'password.throttled' => __('password.throttled'),
                        'password.user'      => __('password.user'),
                        'password.sent'      => __('password.sent'),
                        default               => $msg,
                    };
                @endphp
                <div class="flash-error">{{ $friendly }}</div>
            @endif

            <form action="{{ route('password.email') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="email">{{ __('password.email') }}</label>
                    <input type="email" id="email" name="email"
                           value="{{ old('email') }}"
                           placeholder="you@example.com"
                           required autofocus>
                </div>
                <button type="submit" class="submit-btn">{{ __('password.send_link') }}</button>
            </form>

            <p class="login-link">
                {{ __('password.remembered') }} <a href="{{ route('login') }}">{{ __('password.login') }}</a>
            </p>
        </div>
    </div>

@endsection
