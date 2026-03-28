@extends('layouts.layout')

@section('title', __('auth.register.title') . ' — AVAMotors')

@push('styles')
    @vite(['resources/css/auth.css'])
@endpush

@section('content')

    <div class="auth-wrap">
        <div class="auth-box">
            <h1 class="auth-title">{{ __('auth.register.title') }}</h1>
            <p class="auth-sub">{{ __('auth.register.already_have_account') }} <a href="{{ route('login') }}">{{ __('auth.register.login') }}</a></p>

            @if($errors->any())
                <div class="flash-error">
                    <ul style="margin:0; padding:0 0 0 1rem;">
                        @foreach($errors->all() as $error)
                            <li>{{ __($error) }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST" novalidate>
                @csrf

                <div class="form-group">
                    <label for="name">{{ __('auth.register.name') }}</label>
                    <input type="text" id="name" name="name"
                           value="{{ old('name') }}"
                           placeholder="{{ __('auth.register.name_placeholder') }}"
                           class="{{ $errors->has('name') ? 'input-error' : '' }}"
                           required autofocus>
                    @error('name')
                    <div class="form-error">{{ __($message) }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">{{ __('auth.register.email') }}</label>
                    <input type="email" id="email" name="email"
                           value="{{ old('email') }}"
                           placeholder="you@example.com"
                           class="{{ $errors->has('email') ? 'input-error' : '' }}"
                           required>
                    @error('email')
                    <div class="form-error">{{ __($message) }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="phone">{{ __('auth.register.phone') }} <span style="color:var(--muted); font-size:0.7rem;">({{ __('auth.register.optional') }})</span></label>
                    <input type="tel" id="phone" name="phone"
                           value="{{ old('phone') }}"
                           placeholder="{{ __('auth.register.phone_placeholder') }}"
                           class="{{ $errors->has('phone') ? 'input-error' : '' }}">
                    @error('phone')
                    <div class="form-error">{{ __($message) }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">{{ __('auth.register.password') }}</label>
                    <input type="password" id="password" name="password"
                           placeholder="••••••••"
                           class="{{ $errors->has('password') ? 'input-error' : '' }}"
                           required>
                    <p class="form-hint">{{ __('auth.register.password_hint') }}</p>
                    @error('password')
                    <div class="form-error">{{ __($message) }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">{{ __('auth.register.confirm_password') }}</label>
                    <input type="password" id="password_confirmation"
                           name="password_confirmation"
                           placeholder="••••••••"
                           required>
                    @error('password_confirmation')
                    <div class="form-error">{{ __($message) }}</div>
                    @enderror
                </div>

                <div class="form-check-wrap">
                    <label class="form-check">
                        <input type="checkbox" name="agree" {{ old('agree') ? 'checked' : '' }}>
                        <p>{{ __('auth.register.agree_text') }} <a href="/privacy">{{ __('auth.register.privacy_policy') }}</a> {{ __('auth.register.and') }} <a href="/terms">{{ __('auth.register.terms_of_use') }}</a></p>
                    </label>
                    @error('agree')
                    <div class="form-error" style="margin-top:0.3rem;">{{ __($message) }}</div>
                    @enderror
                </div>

                <button type="submit" class="submit-btn">{{ __('auth.register.submit') }}</button>
            </form>

            <p class="login-link">{{ __('auth.register.already_have_account') }} <a href="{{ route('login') }}">{{ __('auth.register.login') }}</a></p>
        </div>
    </div>

@endsection
