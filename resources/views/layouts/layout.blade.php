<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <!-- Google Tag Manager -->
    <script>(function (w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start':
                    new Date().getTime(), event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-TZVW9XFB');</script>
    <!-- End Google Tag Manager -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=3">
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'AVAMotors')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@300;400;500;600&display=swap"
          rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TZVW9XFB"
            height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->
<div class="mega-overlay" id="mega-overlay" onclick="closeMega()"></div>

{{-- ── Баннер верификации email ── --}}
@auth
    @if(!auth()->user()->hasVerifiedEmail())
        <div class="verify-top-banner" id="verifyBanner">
            <div class="verify-top-inner">
                <div class="verify-top-left">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="15" height="15">
                        <circle cx="12" cy="12" r="10"/>
                        <line x1="12" y1="8" x2="12" y2="12"/>
                        <line x1="12" y1="16" x2="12.01" y2="16"/>
                    </svg>
                    <span>Подтвердите ваш e-mail <strong>{{ auth()->user()->email }}</strong> для полного доступа к сайту.</span>
                </div>
                <div class="verify-top-right">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="verify-resend-btn">Отправить письмо</button>
                    </form>
                    <a href="{{ route('account') }}" class="verify-account-link">Перейти в профиль →</a>
                </div>
            </div>
        </div>
    @endif
@endauth

<header>
    <div class="header-top">
        ⚡ {{ __('header.top_banner') }}
    </div>
    <div class="header-inner">
        <a href="{{ route('home') }}" class="logo">AVA<span>Motors</span></a>

        <form class="search-bar" action="{{ route('search') }}" method="GET">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="{{ __('header.search_placeholder') }}">
            <button type="submit">{{ __('header.search_btn') }}</button>
        </form>

        <div class="header-actions">
            @auth
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="icon-btn">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <rect x="3" y="3" width="7" height="7"/>
                            <rect x="14" y="3" width="7" height="7"/>
                            <rect x="3" y="14" width="7" height="7"/>
                            <rect x="14" y="14" width="7" height="7"/>
                        </svg>
                        {{ __('header.admin') }}
                    </a>
                @endif

                {{-- LANGUAGE SWITCHER В ШАПКЕ --}}
                <div class="lang-switcher-header">
                    <a href="{{ route('lang.switch', 'ru') }}"
                       class="lang-link-header {{ app()->getLocale() === 'ru' ? 'active' : '' }}">RU</a>
                    <span class="lang-divider-header">|</span>
                    <a href="{{ route('lang.switch', 'hy') }}"
                       class="lang-link-header {{ app()->getLocale() === 'hy' ? 'active' : '' }}">HY</a>
                </div>

                <div class="user-menu-wrap">
                    @if(!auth()->user()->hasVerifiedEmail())
                        <span class="unverified-dot" title="{{ __('header.email_unverified') }}"></span>
                    @endif
                    @if(!auth()->user()->city || !auth()->user()->address)
                        <span class="delivery-dot" title="{{ __('header.delivery_address_required') }}"></span>
                    @endif
                    <button class="icon-btn" onclick="this.parentElement.classList.toggle('open')">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/>
                            <circle cx="12" cy="7" r="4"/>
                        </svg>
                        {{ Str::limit(auth()->user()->name, 12) }}
                    </button>
                    <div class="user-dropdown">
                        <div class="user-dropdown-name">{{ auth()->user()->name }}</div>
                        <div class="user-dropdown-email">
                            {{ auth()->user()->email }}
                            @if(auth()->user()->hasVerifiedEmail())
                                <span class="email-verified-badge">✓</span>
                            @else
                                <span class="email-unverified-badge">!</span>
                            @endif

                            @if(auth()->user()->city || auth()->user()->address)
                                {{ auth()->user()->city }}, {{auth()->user()->address}}
                            @else
                                {{ __('header.enter_delivery_address') }} <span
                                    class="delivery-unverified-badge">!</span>
                            @endif
                        </div>
                        <div class="user-dropdown-divider"></div>
                        <a href="{{ route('account') }}" class="user-dropdown-link">{{ __('header.my_account') }}</a>
                        <a href="{{ route('orders.index') }}"
                           class="user-dropdown-link">{{ __('header.my_orders') }}</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                    class="user-dropdown-link user-dropdown-logout">{{ __('header.logout') }}</button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="icon-btn">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/>
                        <circle cx="12" cy="7" r="4"/>
                    </svg>
                    {{ __('header.login') }}
                </a>
                <a href="{{ route('register') }}" class="icon-btn">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <line x1="19" y1="8" x2="19" y2="14"/>
                        <line x1="22" y1="11" x2="16" y2="11"/>
                    </svg>
                    {{ __('header.register') }}
                </a>

                {{-- LANGUAGE SWITCHER ДЛЯ НЕАВТОРИЗОВАННЫХ --}}
                <div class="lang-switcher-header">
                    <a href="{{ route('lang.switch', 'ru') }}"
                       class="lang-link-header {{ app()->getLocale() === 'ru' ? 'active' : '' }}">RU</a>
                    <span class="lang-divider-header">|</span>
                    <a href="{{ route('lang.switch', 'hy') }}"
                       class="lang-link-header {{ app()->getLocale() === 'hy' ? 'active' : '' }}">HY</a>
                </div>
            @endauth
            <a href="{{ route('cart.index') }}" class="cart-btn">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="9" cy="21" r="1"/>
                    <circle cx="20" cy="21" r="1"/>
                    <path d="M1 1h4l2.68 13.39a2 2 0 002 1.61h9.72a2 2 0 002-1.61L23 6H6"/>
                </svg>
                {{ __('header.cart') }}
                <span class="cart-badge" id="cart-badge" style="display: none;">0</span>
            </a>
        </div>
    </div>
</header>

<nav class="navbar">
    <div class="navbar-inner">
        <a href="{{ route('home') }}" class="nav-link {{ request()->is('/') ? 'active' : '' }}">{{ __('nav.home') }}</a>
        <a href="{{ route('catalog') }}" class="nav-link">{{ __('nav.catalog') }}</a>
        <button class="nav-link" id="mega-btn" onclick="toggleMega()" aria-expanded="false">
            {{ __('nav.categories') }} <span class="nav-arrow">▼</span>
        </button>
        <a href="{{ route('catalog') }}?brands=1"
           class="nav-link {{ request()->is('brands*') ? 'active' : '' }}">{{ __('nav.brands') }}</a>
        <a href="/about" class="nav-link {{ request()->is('about*') ? 'active' : '' }}">{{ __('nav.about') }}</a>
    </div>

    <div class="mega-menu" id="mega-menu">
        <div class="mega-menu-inner">
            @foreach($navCategories->chunk(2) as $colGroup)
                <div class="mega-col">
                    @foreach($colGroup as $cat)
                        <div style="margin-bottom:1.4rem;">
                            <a href="{{ route('catalog.category', $cat->slug) }}" class="mega-col-title"
                               onclick="closeMega()">
                                {{ __("categories.{$cat->slug}") }}
                            </a>
                            @if($cat->children->isNotEmpty())
                                @foreach($cat->children->sortBy('sort_order') as $child)
                                    <a href="{{ route('catalog.category', $child->slug) }}" class="mega-link"
                                       onclick="closeMega()">
                                        {{ __("categories.{$child->slug}") }}
                                    </a>
                                @endforeach
                            @else
                                <a href="{{ route('catalog.category', $cat->slug) }}" class="mega-link"
                                   onclick="closeMega()">{{ __('nav.all_products') }}</a>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
        <div class="mega-footer">
            <span style="font-size:0.78rem; color:var(--muted);">
                {{ $navCategories->count() }} {{ __('nav.categories') }} &nbsp;·&nbsp;
                {{ $navCategories->sum(fn($c) => $c->children->count()) }} {{ __('nav.subcategories') }}
            </span>
            <a href="{{ route('catalog') }}" class="mega-footer-link"
               onclick="closeMega()">{{ __('nav.full_catalog') }} →</a>
        </div>
    </div>
</nav>

<main>
    @yield('content')
</main>

<footer>
    <div class="footer-grid">
        <div class="footer-brand">
            <a href="{{ route('home') }}" class="logo">AVA<span>Motors</span></a>
            <p>{{ __('footer.description') }}</p>
        </div>
        <div class="footer-col">
            <h4>{{ __('footer.catalog') }}</h4>
            @foreach($navCategories as $cat)
                <a href="{{ route('catalog.category', $cat->slug) }}">{{ __("categories.{$cat->slug}") }}</a>
            @endforeach
        </div>
        <div class="footer-col">
            <h4>{{ __('footer.for_customers') }}</h4>
            <a href="/delivery">{{ __('footer.delivery_payment') }}</a>
            <a href="/returns">{{ __('footer.returns') }}</a>
            <a href="/warranty">{{ __('footer.warranty') }}</a>
            <a href="/faq">{{ __('footer.faq') }}</a>
        </div>
        <div class="footer-col">
            <h4>{{ __('footer.contacts') }}</h4>
            <a href="tel:+37498428831">+374 (98) 42-88-31</a>
            <a href="mailto:alik.avamotors@gmail.com">alik.avamotors@gmail.com</a>
            <a href="/about">{{ __('footer.about_company') }}</a>
        </div>
    </div>
    <div class="footer-bottom">
        <span>© {{ date('Y') }} AVAMotors. {{ __('footer.all_rights') }}</span>
        <span>{{ __('footer.location') }}</span>
    </div>
</footer>

{{-- Сначала загружаем все скрипты из компонентов --}}
@stack('scripts')

{{-- Затем основной скрипт корзины --}}
@vite(['resources/js/cart.js'])

{{-- Глобальная инициализация --}}
<script>
    // Ждем загрузки всех скриптов
    document.addEventListener('DOMContentLoaded', function () {
        // Добавляем CSRF токен во все формы
        const token = document.querySelector('meta[name="csrf-token"]');
        if (token) {
            document.querySelectorAll('form').forEach(form => {
                if (!form.querySelector('input[name="_token"]')) {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = '_token';
                    input.value = token.content;
                    form.appendChild(input);
                }
            });
        }

        // Инициализируем корзину, если cartManager доступен
        if (window.cartManager && typeof window.cartManager.updateBadge === 'function') {
            window.cartManager.updateBadge();
        } else if (typeof window.updateCartBadge === 'function') {
            window.updateCartBadge();
        }
    });
</script>

</body>
</html>
