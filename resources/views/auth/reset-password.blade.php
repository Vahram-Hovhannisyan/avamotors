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
                <input type="hidden" name="email" value="{{ old('email', $email ?? '') }}">

                {{-- Email — только отображение, не редактируется --}}
                <div class="reset-email-block">
                    <div class="reset-email-label">Сброс пароля для</div>
                    <div class="reset-email-value">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" width="15" height="15"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        {{ old('email', $email ?? '') }}
                    </div>
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
