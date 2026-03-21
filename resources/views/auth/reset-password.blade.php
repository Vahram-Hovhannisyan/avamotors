@extends('layouts.layout')

@section('title', 'Сброс пароля — AVAMotors')

@push('styles')
    @vite(['resources/css/auth.css'])
@endpush

@section('content')

    <div class="auth-wrap">
        <div class="auth-box">
            <h1 class="auth-title">Новый пароль</h1>
            <p class="auth-sub">Придумайте надёжный пароль для вашего аккаунта</p>

            @if($errors->has('email'))
                @php
                    $msg = $errors->first('email');
                    $friendly = match($msg) {
                        'passwords.token'     => 'Ссылка устарела или недействительна. Запросите новую.',
                        'passwords.user'      => 'Пользователь с таким e-mail не найден.',
                        'passwords.throttled' => 'Подождите немного перед повторной попыткой.',
                        default               => $msg,
                    };
                @endphp
                <div class="flash-error">{{ $friendly }}</div>
            @endif

            <form action="{{ route('password.update') }}" method="POST">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email"
                           value="{{ old('email', $email ?? '') }}"
                           placeholder="you@example.com"
                           required>
                    @error('email') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="password">Новый пароль</label>
                    <input type="password" id="password" name="password"
                           placeholder="Минимум 8 символов" required>
                    @error('password') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Повторите пароль</label>
                    <input type="password" id="password_confirmation"
                           name="password_confirmation"
                           placeholder="Повторите пароль" required>
                </div>

                <button type="submit" class="submit-btn">Сохранить пароль</button>
            </form>
        </div>
    </div>

@endsection
