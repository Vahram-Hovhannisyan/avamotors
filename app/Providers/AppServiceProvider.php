<?php

namespace App\Providers;

use App\Interfaces\AdminServiceInterface;
use App\Interfaces\CartServiceInterface;
use App\Interfaces\CategoryServiceInterface;
use App\Interfaces\InvoiceServiceInterface;
use App\Interfaces\OrderServiceInterface;
use App\Interfaces\ProductServiceInterface;
use App\Services\AdminService;
use App\Services\CartService;
use App\Services\CategoryService;
use App\Services\InvoiceService;
use App\Services\OrderService;
use App\Services\ProductService;
use App\View\Components\AddToCartButton;
use App\View\Components\AdminTableWrap;
use App\View\Components\Badge;
use App\View\Components\FlashMessage;
use App\View\Components\ProductCard;
use App\View\Components\ProductImage;
use App\View\Components\SectionHeader;
use App\View\Components\StockBadge;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Регистрируем сервисы
        $this->app->bind(ProductServiceInterface::class, ProductService::class);
        $this->app->bind(CategoryServiceInterface::class, CategoryService::class);
        $this->app->bind(AdminServiceInterface::class, AdminService::class);
        $this->app->bind(CartServiceInterface::class, CartService::class);
        $this->app->bind(InvoiceServiceInterface::class, InvoiceService::class);

        $this->app->bind(OrderServiceInterface::class, function ($app) {
            return new OrderService($app->make(CartServiceInterface::class));
        });

    }

    public function boot(): void
    {
        Log::info('AppServiceProvider boot() method started');
        // ── Настройка локализации ──
        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        } else {
            App::setLocale('hy');
            Session::put('locale', 'hy');
        }
        Log::info('Locale set to: ' . App::getLocale());
        Log::info('Registering ResetPassword toMailUsing');
        // ── Кастомизация email уведомлений ──

        // 1. Сброс пароля
        ResetPassword::toMailUsing(function ($notifiable, $token) {
            Log::info('ResetPassword::toMailUsing CALLED!');
            // Определяем язык пользователя
            $locale = $notifiable->locale ?? 'hy';

            // Для отладки
            Log::info('=== RESET PASSWORD EMAIL DEBUG ===');
            Log::info('User email: ' . $notifiable->email);
            Log::info('User locale from DB: ' . ($notifiable->locale ?? 'null'));
            Log::info('Using locale: ' . $locale);

            // Проверяем, какие переводы доступны
            $title = Lang::get('emails.reset_password.title', [], $locale);
            Log::info('Translated title for locale ' . $locale . ': ' . $title);

            // Проверяем, что файл перевода существует
            $path = base_path("lang/{$locale}/emails.php");
            Log::info('Translation file exists: ' . (file_exists($path) ? 'YES' : 'NO') . ' - ' . $path);

            $resetUrl = url(config('app.url') . route('password.reset', [
                    'token' => $token,
                    'email' => $notifiable->getEmailForPasswordReset(),
                ], false));

            // Устанавливаем язык для шаблона
            App::setLocale($locale);

            return (new MailMessage)
                ->subject($title)
                ->view('auth.emails.reset-password', [
                    'resetUrl' => $resetUrl,
                    'userName' => $notifiable->name,
                    'locale' => $locale,
                ]);
        });
        Log::info('Registering VerifyEmail toMailUsing');
        // Подтверждение email
        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            Log::info('VerifyEmail::toMailUsing CALLED!');
            $locale = $notifiable->locale ?? 'hy';

            Log::info('=== VERIFY EMAIL DEBUG ===');
            Log::info('User email: ' . $notifiable->email);
            Log::info('User locale from DB: ' . ($notifiable->locale ?? 'null'));
            Log::info('Using locale: ' . $locale);

            $title = Lang::get('emails.verify_email.title', [], $locale);
            Log::info('Translated title for locale ' . $locale . ': ' . $title);

            App::setLocale($locale);

            return (new MailMessage)
                ->subject($title)
                ->view('auth.emails.verify-email', [
                    'verifyUrl' => $url,
                    'userName' => $notifiable->name,
                    'locale' => $locale,
                ]);
        });
        Log::info('Email notifications configured');

        Paginator::defaultView('vendor.pagination.tailwind');
        Paginator::defaultSimpleView('vendor.pagination.tailwind');

        Blade::component('flash-message', FlashMessage::class);
        Blade::component('product-card', ProductCard::class);
        Blade::component('product-image', ProductImage::class);
        Blade::component('stock-badge', StockBadge::class);
        Blade::component('add-to-cart-button', AddToCartButton::class);
        Blade::component('badge', Badge::class);
        Blade::component('section-header', SectionHeader::class);
        Blade::component('admin-table-wrap', AdminTableWrap::class);

        // Share navCategories with all views using Service
        try {
            $categoryService = app(CategoryServiceInterface::class);
            View::share('navCategories', $categoryService->getNavCategories());
        } catch (\Exception $e) {
            View::share('navCategories', collect());
            \Illuminate\Support\Facades\Log::error('Failed to load navCategories: ' . $e->getMessage());
        }
    }
}
