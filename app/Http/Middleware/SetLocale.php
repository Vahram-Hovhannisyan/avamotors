<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        // Проверяем язык в сессии
        if (Session::has('locale')) {
            $locale = Session::get('locale');
            if (in_array($locale, ['ru', 'hy'])) {
                App::setLocale($locale);
            } else {
                App::setLocale('ru');
                Session::put('locale', 'ru');
            }
        } else {
            // Устанавливаем язык по умолчанию
            App::setLocale('ru');
            Session::put('locale', 'ru');
        }

        return $next($request);
    }
}
