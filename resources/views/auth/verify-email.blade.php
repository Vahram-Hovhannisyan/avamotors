@extends('layouts.layout')

@section('title', 'Подтверждение e-mail — AVAMotors')

@push('styles')
    @vite(['resources/css/auth.css'])
@endpush

@section('content')
    <div class="auth-wrap">
        <div class="auth-box">
            <h1 class="auth-title">Подтвердите e-mail</h1>
            <p class="auth-sub">
                Мы отправили ссылку для подтверждения на <strong>{{ Auth::user()->email }}</strong>.<br>
                Проверьте почту и нажмите на ссылку в письме.
            </p>

            @if(session('status') === 'verification-link-sent')
                <div class="flash-success">✓ Новое письмо отправлено. Проверьте почту.</div>
            @endif

            @if(session('status'))
                <div class="flash-success">✓ {{ session('status') }}</div>
            @endif

            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="submit-btn">Отправить письмо повторно</button>
            </form>

            <form method="POST" action="{{ route('logout') }}" style="margin-top:1rem;">
                @csrf
                <button type="submit"
                        style="background:none; border:none; color:var(--muted); font-size:0.82rem; cursor:pointer; padding:0;">
                    Выйти из аккаунта
                </button>
            </form>
        </div>
    </div>
@endsection
