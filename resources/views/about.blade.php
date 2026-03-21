@extends('layouts.layout')

@section('title', 'О нас — AVAMotors')

@section('content')

    <div style="max-width:900px; margin:0 auto;">

        {{-- Hero --}}
        <div style="text-align:center; margin-bottom:3rem; padding-bottom:2rem; border-bottom:1px solid var(--border);">
            <p style="font-size:0.75rem; letter-spacing:0.12em; text-transform:uppercase; color:var(--brand); margin-bottom:0.8rem;">О компании</p>
            <h1 style="font-family:var(--font-display); font-size:3rem; letter-spacing:0.04em; color:var(--ink); margin-bottom:1rem;">AVA<span style="color:var(--muted);">Motors</span></h1>
            <p style="font-size:1rem; color:var(--muted); max-width:560px; margin:0 auto; line-height:1.8;">
                Магазин автозапчастей в Раздане — оригинальные детали и проверенные аналоги для любых марок автомобилей.
            </p>
        </div>

        {{-- Stats --}}
        <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:1px; background:var(--border); border:1px solid var(--border); margin-bottom:3rem;">
            <div style="background:var(--surface); padding:2rem; text-align:center;">
                <div style="font-family:var(--font-display); font-size:2.5rem; color:var(--brand); letter-spacing:0.04em;">15+</div>
                <div style="font-size:0.75rem; letter-spacing:0.08em; text-transform:uppercase; color:var(--muted); margin-top:0.4rem;">Ведущих брендов</div>
            </div>
            <div style="background:var(--surface); padding:2rem; text-align:center;">
                <div style="font-family:var(--font-display); font-size:2.5rem; color:var(--brand); letter-spacing:0.04em;">1 день</div>
                <div style="font-size:0.75rem; letter-spacing:0.08em; text-transform:uppercase; color:var(--muted); margin-top:0.4rem;">Доставка по Армении</div>
            </div>
            <div style="background:var(--surface); padding:2rem; text-align:center;">
                <div style="font-family:var(--font-display); font-size:2.5rem; color:var(--brand); letter-spacing:0.04em;">100%</div>
                <div style="font-size:0.75rem; letter-spacing:0.08em; text-transform:uppercase; color:var(--muted); margin-top:0.4rem;">Гарантия качества</div>
            </div>
        </div>

        {{-- About text --}}
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:3rem; margin-bottom:3rem; align-items:start;">
            <div>
                <p style="font-size:0.7rem; letter-spacing:0.1em; text-transform:uppercase; color:var(--brand); margin-bottom:0.8rem;">Кто мы</p>
                <h2 style="font-family:var(--font-display); font-size:1.8rem; letter-spacing:0.03em; margin-bottom:1.2rem;">Надёжный партнёр для вашего автомобиля</h2>
                <p style="color:var(--muted); font-size:0.88rem; line-height:1.9; margin-bottom:1rem;">
                    AVAMotors — это магазин автозапчастей в городе Раздан, Армения. Мы специализируемся на продаже оригинальных деталей и качественных аналогов для легковых автомобилей любых марок.
                </p>
                <p style="color:var(--muted); font-size:0.88rem; line-height:1.9;">
                    В нашем каталоге вы найдёте запчасти брендов Bosch, NGK, Denso, Delphi, Valeo и других ведущих производителей. Мы работаем как с частными клиентами, так и с автосервисами.
                </p>
            </div>
            <div>
                <p style="font-size:0.7rem; letter-spacing:0.1em; text-transform:uppercase; color:var(--brand); margin-bottom:0.8rem;">Почему мы</p>
                <h2 style="font-family:var(--font-display); font-size:1.8rem; letter-spacing:0.03em; margin-bottom:1.2rem;">Наши преимущества</h2>
                <div style="display:flex; flex-direction:column; gap:1rem;">
                    @foreach([
                        ['Только оригинал и проверенные аналоги', 'Работаем только с сертифицированными поставщиками'],
                        ['Быстрая доставка', 'Доставка по всей Армении в течение 1 рабочего дня'],
                        ['Гарантия на все товары', 'Официальная гарантия от производителя на каждую деталь'],
                        ['Подбор по VIN и марке авто', 'Поможем подобрать нужную деталь под ваш автомобиль'],
                    ] as [$title, $desc])
                        <div style="display:flex; gap:1rem; align-items:flex-start;">
                            <div style="width:8px; height:8px; background:var(--brand); flex-shrink:0; margin-top:5px;"></div>
                            <div>
                                <div style="font-size:0.85rem; font-weight:500; color:var(--ink); margin-bottom:0.2rem;">{{ $title }}</div>
                                <div style="font-size:0.8rem; color:var(--muted);">{{ $desc }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Contacts + Map --}}
        <div style="border:1px solid var(--border); border-top:2px solid var(--brand); margin-bottom:3rem;">
            <div style="padding:1.5rem 2rem; border-bottom:1px solid var(--border);">
                <p style="font-size:0.7rem; letter-spacing:0.1em; text-transform:uppercase; color:var(--brand);">Контакты и адрес</p>
            </div>
            <div style="display:grid; grid-template-columns:1fr 2fr;">
                <div style="padding:2rem; border-right:1px solid var(--border); display:flex; flex-direction:column; gap:1.5rem;">
                    <div>
                        <div style="font-size:0.68rem; letter-spacing:0.08em; text-transform:uppercase; color:var(--muted); margin-bottom:0.4rem;">Адрес</div>
                        <div style="font-size:0.88rem; color:var(--ink); line-height:1.6;">Раздан, Котайк<br>ул. Шагумяна 15</div>
                    </div>
                    <div>
                        <div style="font-size:0.68rem; letter-spacing:0.08em; text-transform:uppercase; color:var(--muted); margin-bottom:0.4rem;">Телефон</div>
                        <a href="tel:+37498428831" style="font-size:0.88rem; color:var(--brand); text-decoration:none;">+374 (98) 42-88-31</a>
                    </div>
                    <div>
                        <div style="font-size:0.68rem; letter-spacing:0.08em; text-transform:uppercase; color:var(--muted); margin-bottom:0.4rem;">Email</div>
                        <a href="mailto:alik.avamotors@gmail.com" style="font-size:0.88rem; color:var(--brand); text-decoration:none;">alik.avamotors@gmail.com</a>
                    </div>
                    <div>
                        <div style="font-size:0.68rem; letter-spacing:0.08em; text-transform:uppercase; color:var(--muted); margin-bottom:0.4rem;">Режим работы</div>
                        <div style="font-size:0.88rem; color:var(--ink); line-height:1.6;">Пн–Пт: 9:00–18:00<br>Сб: 10:00–15:00<br>Вс: выходной</div>
                    </div>
                </div>
                <div>
                   <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d20410.687465710176!2d44.765061206581315!3d40.495904888760805!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40403a3cc1b05d49%3A0x4b9cb91543055eb5!2sFQV6%2B78%2C%20Hrazdan!5e0!3m2!1sru!2sam!4v1773987001595!5m2!1sru!2sam" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>

    </div>

@endsection
