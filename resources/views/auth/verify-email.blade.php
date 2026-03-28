@extends('layouts.layout')

@section('title', __('verify.title') . ' — AVAMotors')

@push('styles')
    @vite(['resources/css/auth.css'])
@endpush

@section('content')
    <div class="auth-wrap">
        <div class="auth-box">
            <h1 class="auth-title">{{ __('verify.title') }}</h1>
            <p class="auth-sub">
                {{ __('verify.message_text', ['email' => Auth::user()->email]) }}
            </p>

            @if(session('status') === 'verification-link-sent')
                <div class="flash-success">✓ {{ __('verify.resent') }}</div>
            @endif

            @if(session('status'))
                <div class="flash-success">✓ {{__('messages.'.session('status'))}}</div>
            @endif

            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="submit-btn">{{ __('verify.resend_button') }}</button>
            </form>

            <form method="POST" action="{{ route('logout') }}" style="margin-top:1rem;">
                @csrf
                <button type="submit"
                        style="background:none; border:none; color:var(--muted); font-size:0.82rem; cursor:pointer; padding:0;">
                    {{ __('verify.logout') }}
                </button>
            </form>
        </div>
    </div>
@endsection
