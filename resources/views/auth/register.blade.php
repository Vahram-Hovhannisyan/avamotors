@extends('layouts.layout')

@section('title', 'Регистрация — AVAMotors')

@push('styles')
    @vite(['resources/css/auth.css'])
@endpush

@section('content')

    <div class="auth-wrap">
        <div class="auth-box">
            <h1 class="auth-title">Регистрация</h1>
            <p class="auth-sub">Уже есть аккаунт? <a href="{{ route('login') }}">Войти</a></p>

            @if($errors->any())
                <div class="flash-error">
                    <ul style="margin:0; padding:0 0 0 1rem;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST" novalidate>
                @csrf

                <div class="form-group">
                    <label for="name">Имя</label>
                    <input type="text" id="name" name="name"
                           value="{{ old('name') }}"
                           placeholder="Иван Иванов"
                           class="{{ $errors->has('name') ? 'input-error' : '' }}"
                           required autofocus>
                    @error('name')
                    <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email"
                           value="{{ old('email') }}"
                           placeholder="you@example.com"
                           class="{{ $errors->has('email') ? 'input-error' : '' }}"
                           required>
                    @error('email')
                    <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="phone">Телефон <span style="color:var(--muted); font-size:0.7rem;">(необязательно)</span></label>
                    <input type="tel" id="phone" name="phone"
                           value="{{ old('phone') }}"
                           placeholder="+374 (99) 00-00-00"
                           class="{{ $errors->has('phone') ? 'input-error' : '' }}">
                    @error('phone')
                    <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Пароль</label>
                    <input type="password" id="password" name="password"
                           placeholder="••••••••"
                           class="{{ $errors->has('password') ? 'input-error' : '' }}"
                           required>
                    <p class="form-hint">Минимум 8 символов</p>
                    @error('password')
                    <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Повторите пароль</label>
                    <input type="password" id="password_confirmation"
                           name="password_confirmation"
                           placeholder="••••••••"
                           required>
                </div>

                <div class="form-check-wrap">
                    <label class="form-check">
                        <input type="checkbox" name="agree" {{ old('agree') ? 'checked' : '' }}>
                        <p>Я согласен с <a href="/privacy">политикой конфиденциальности</a> и <a href="/terms">условиями использования</a></p>
                    </label>
                    @error('agree')
                    <div class="form-error" style="margin-top:0.3rem;">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="submit-btn">Создать аккаунт</button>
            </form>

            <p class="login-link">Уже зарегистрированы? <a href="{{ route('login') }}">Войти</a></p>
        </div>
    </div>

@endsection
