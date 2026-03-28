@extends('layouts.layout')

@section('title', __('about.title') . ' — AVAMotors')

@section('content')

    <div style="max-width:900px; margin:0 auto;">

        {{-- Hero --}}
        <div style="text-align:center; margin-bottom:3rem; padding-bottom:2rem; border-bottom:1px solid var(--border);">
            <p style="font-size:0.75rem; letter-spacing:0.12em; text-transform:uppercase; color:var(--brand); margin-bottom:0.8rem;">
                {{ __('about.hero.subtitle') }}</p>
            <h1 style="font-family:var(--font-display); font-size:3rem; letter-spacing:0.04em; color:var(--ink); margin-bottom:1rem;">
                AVA<span style="color:var(--muted);">Motors</span></h1>
            <p style="font-size:1rem; color:var(--muted); max-width:560px; margin:0 auto; line-height:1.8;">
                {{ __('about.hero.description') }}
            </p>
        </div>

        {{-- Stats --}}
        <div
            style="display:grid; grid-template-columns:repeat(3,1fr); gap:1px; background:var(--border); border:1px solid var(--border); margin-bottom:3rem;">
            <div style="background:var(--surface); padding:2rem; text-align:center;">
                <div
                    style="font-family:var(--font-display); font-size:2.5rem; color:var(--brand); letter-spacing:0.04em;">
                    15+
                </div>
                <div
                    style="font-size:0.75rem; letter-spacing:0.08em; text-transform:uppercase; color:var(--muted); margin-top:0.4rem;">
                    {{ __('about.stats.brands') }}
                </div>
            </div>
            <div style="background:var(--surface); padding:2rem; text-align:center;">
                <div
                    style="font-family:var(--font-display); font-size:2.5rem; color:var(--brand); letter-spacing:0.04em;">
                    1 {{ __('about.stats.day') }}
                </div>
                <div
                    style="font-size:0.75rem; letter-spacing:0.08em; text-transform:uppercase; color:var(--muted); margin-top:0.4rem;">
                    {{ __('about.stats.delivery') }}
                </div>
            </div>
            <div style="background:var(--surface); padding:2rem; text-align:center;">
                <div
                    style="font-family:var(--font-display); font-size:2.5rem; color:var(--brand); letter-spacing:0.04em;">
                    100%
                </div>
                <div
                    style="font-size:0.75rem; letter-spacing:0.08em; text-transform:uppercase; color:var(--muted); margin-top:0.4rem;">
                    {{ __('about.stats.warranty') }}
                </div>
            </div>
        </div>

        {{-- About text --}}
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:3rem; margin-bottom:3rem; align-items:start;">
            <div>
                <p style="font-size:0.7rem; letter-spacing:0.1em; text-transform:uppercase; color:var(--brand); margin-bottom:0.8rem;">
                    {{ __('about.who_we_are.subtitle') }}</p>
                <h2 style="font-family:var(--font-display); font-size:1.8rem; letter-spacing:0.03em; margin-bottom:1.2rem;">
                    {{ __('about.who_we_are.title') }}</h2>
                <p style="color:var(--muted); font-size:0.88rem; line-height:1.9; margin-bottom:1rem;">
                    {{ __('about.who_we_are.text_1') }}
                </p>
                <p style="color:var(--muted); font-size:0.88rem; line-height:1.9;">
                    {{ __('about.who_we_are.text_2') }}
                </p>
            </div>
            <div>
                <p style="font-size:0.7rem; letter-spacing:0.1em; text-transform:uppercase; color:var(--brand); margin-bottom:0.8rem;">
                    {{ __('about.why_we.subtitle') }}</p>
                <h2 style="font-family:var(--font-display); font-size:1.8rem; letter-spacing:0.03em; margin-bottom:1.2rem;">
                    {{ __('about.why_we.title') }}</h2>
                <div style="display:flex; flex-direction:column; gap:1rem;">
                    @foreach([
                        ['title' => 'about.advantages.original.title', 'desc' => 'about.advantages.original.desc'],
                        ['title' => 'about.advantages.delivery.title', 'desc' => 'about.advantages.delivery.desc'],
                        ['title' => 'about.advantages.warranty.title', 'desc' => 'about.advantages.warranty.desc'],
                    ] as $advantage)
                        <div style="display:flex; gap:1rem; align-items:flex-start;">
                            <div
                                style="width:8px; height:8px; background:var(--brand); flex-shrink:0; margin-top:5px;"></div>
                            <div>
                                <div
                                    style="font-size:0.85rem; font-weight:500; color:var(--ink); margin-bottom:0.2rem;">{{ __($advantage['title']) }}</div>
                                <div style="font-size:0.8rem; color:var(--muted);">{{ __($advantage['desc']) }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Contacts + Map --}}
        <div style="border:1px solid var(--border); border-top:2px solid var(--brand); margin-bottom:3rem;">
            <div style="padding:1.5rem 2rem; border-bottom:1px solid var(--border);">
                <p style="font-size:0.7rem; letter-spacing:0.1em; text-transform:uppercase; color:var(--brand);">
                    {{ __('about.contacts.title') }}</p>
            </div>
            <div style="display:grid; grid-template-columns:1fr 2fr;">
                <div
                    style="padding:2rem; border-right:1px solid var(--border); display:flex; flex-direction:column; gap:1.5rem;">
                    <div>
                        <div
                            style="font-size:0.68rem; letter-spacing:0.08em; text-transform:uppercase; color:var(--muted); margin-bottom:0.4rem;">
                            {{ __('about.contacts.address_label') }}
                        </div>
                        <div style="font-size:0.88rem; color:var(--ink); line-height:1.6;">{{ __('about.contacts.address') }}</div>
                    </div>
                    <div>
                        <div
                            style="font-size:0.68rem; letter-spacing:0.08em; text-transform:uppercase; color:var(--muted); margin-bottom:0.4rem;">
                            {{ __('about.contacts.phone_label') }}
                        </div>
                        <a href="tel:+37498428831" style="font-size:0.88rem; color:var(--brand); text-decoration:none;">+374
                            (98) 42-88-31</a>
                    </div>
                    <div>
                        <div
                            style="font-size:0.68rem; letter-spacing:0.08em; text-transform:uppercase; color:var(--muted); margin-bottom:0.4rem;">
                            {{ __('about.contacts.email_label') }}
                        </div>
                        <a href="mailto:alik.avamotors@gmail.com"
                           style="font-size:0.88rem; color:var(--brand); text-decoration:none;">alik.avamotors@gmail.com</a>
                    </div>
                    <div>
                        <div
                            style="font-size:0.68rem; letter-spacing:0.08em; text-transform:uppercase; color:var(--muted); margin-bottom:0.4rem;">
                            {{ __('about.contacts.working_hours_label') }}
                        </div>
                        <div style="font-size:0.88rem; color:var(--ink); line-height:1.6;">{{ __('about.contacts.working_hours') }}</div>
                    </div>
                </div>
                {{--                <div>--}}
                {{--                    <iframe--}}
                {{--                        src="https://maps.google.com/maps?q=Раздан+Котайк+Шагумяна+15+Армения&output=embed&hl=ru"--}}
                {{--                        width="100%"--}}
                {{--                        height="350"--}}
                {{--                        style="border:0; display:block;"--}}
                {{--                        allowfullscreen=""--}}
                {{--                        loading="lazy">--}}
                {{--                    </iframe>--}}
                {{--                </div>--}}
            </div>
        </div>

    </div>

@endsection
