@extends('layouts.layout')

@section('title', 'Мой аккаунт — AVAMotors')

@push('styles')
    @vite(['resources/css/auth.css'])
@endpush

@section('content')

    <div class="account-layout">

        <aside class="account-sidebar">
            <div class="account-avatar">
                <div class="avatar-circle">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                <div class="avatar-name">{{ $user->name }}</div>
                <div class="avatar-role">{{ $user->isAdmin() ? 'Администратор' : 'Покупатель' }}</div>

                {{-- Статус верификации --}}
                @if($user->hasVerifiedEmail())
                    <div class="email-status verified">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                        E-mail подтверждён
                    </div>
                @else
                    <div class="email-status unverified">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        E-mail не подтверждён
                    </div>
                @endif
                {{-- Статус адреса доставки --}}
                @if(!$user->city && !$user->address)
                    <div class="delivery-status unverified">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16">
                            <line x1="18" y1="6" x2="6" y2="18"/>
                            <line x1="6" y1="6" x2="18" y2="18"/>
                        </svg>
                        Адрес доставки отсуствует
                    </div>
                @endif
            </div>
            <nav>
                <a href="{{ route('account') }}" class="account-nav-link active">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    Профиль
                </a>
                <a href="{{ route('orders.index') }}" class="account-nav-link">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg>
                    Мои заказы
                </a>
                @if($user->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="account-nav-link">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
                        Панель управления
                    </a>
                @endif
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="account-nav-link">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/><polyline points="16,17 21,12 16,7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                        Выйти
                    </button>
                </form>
            </nav>
        </aside>

        <div>
            @if(session('success'))
                <div class="flash-success">✓ {{ session('success') }}</div>
            @endif

            @if(session('status') === 'verification-link-sent')
                <div class="flash-success">✓ Письмо с подтверждением отправлено на {{ $user->email }}</div>
            @endif

            {{-- Баннер верификации --}}
            @if(!$user->hasVerifiedEmail())
                <div class="verify-banner">
                    <div class="verify-banner-text">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="18" height="18"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        <span>Ваш e-mail <strong>{{ $user->email }}</strong> не подтверждён.</span>
                    </div>
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="verify-banner-btn">Отправить письмо</button>
                    </form>
                </div>
            @endif

            <div class="account-card">
                <div class="account-card-title">Личные данные</div>
                <form method="POST" action="{{ route('account.profile') }}">
                    @csrf @method('PUT')
                    <div class="profile-row">
                        <div class="account-form-group">
                            <label for="name">Имя</label>
                            <input type="text" id="name" name="name"
                                   value="{{ old('name', $user->name) }}" required>
                            @error('name') <div class="form-error">{{ $message }}</div> @enderror
                        </div>
                        <div class="account-form-group">
                            <label for="phone">Телефон</label>
                            <input type="tel" id="phone" name="phone"
                                   value="{{ old('phone', $user->phone) }}"
                                   placeholder="+374 (99) 00-00-00">
                        </div>
                    </div>
                    <div class="account-form-group">
                        <label for="email">E-mail</label>
                        <input type="email" id="email" name="email"
                               value="{{ old('email', $user->email) }}" required>
                        @error('email') <div class="form-error">{{ $message }}</div> @enderror
                    </div>
                    <div class="profile-row">
                        <div class="account-form-group">
                            <label for="city">Город</label>
                            <input type="text" id="city" name="city"
                                   value="{{ old('city', $user->city) }}"
                                   placeholder="Ереван">
                            @error('city') <div class="form-error">{{ $message }}</div> @enderror
                        </div>
                        <div class="account-form-group">
                            <label for="address">Адрес доставки</label>
                            <input type="text" id="address" name="address"
                                   value="{{ old('address', $user->address) }}"
                                   placeholder="ул. Абовяна, 12, кв. 5">
                            @error('address') <div class="form-error">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <button type="submit" class="save-btn">Сохранить</button>
                </form>
            </div>

            <div class="account-card">
                <div class="account-card-title">Изменить пароль</div>
                <form method="POST" action="{{ route('account.password') }}">
                    @csrf @method('PUT')
                    <div class="account-form-group">
                        <label for="current_password">Текущий пароль</label>
                        <input type="password" id="current_password" name="current_password"
                               placeholder="••••••••" required>
                        @error('current_password') <div class="form-error">{{ $message }}</div> @enderror
                    </div>
                    <div class="profile-row">
                        <div class="account-form-group">
                            <label for="password">Новый пароль</label>
                            <input type="password" id="password" name="password"
                                   placeholder="••••••••" required>
                            @error('password') <div class="form-error">{{ $message }}</div> @enderror
                        </div>
                        <div class="account-form-group">
                            <label for="password_confirmation">Повторите пароль</label>
                            <input type="password" id="password_confirmation"
                                   name="password_confirmation" placeholder="••••••••" required>
                        </div>
                    </div>
                    <button type="submit" class="save-btn">Изменить пароль</button>
                </form>
            </div>
        </div>

    </div>

@endsection
