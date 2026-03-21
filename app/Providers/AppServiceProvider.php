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
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    // ── Service bindings ───────────────────────────────

    public function register(): void
    {
        $this->app->bind(ProductServiceInterface::class, ProductService::class);
        $this->app->bind(CategoryServiceInterface::class, CategoryService::class);
        $this->app->bind(AdminServiceInterface::class, AdminService::class);
        $this->app->bind(CartServiceInterface::class, CartService::class);
        $this->app->bind(InvoiceServiceInterface::class, InvoiceService::class);

        // OrderService зависит от CartServiceInterface
        $this->app->bind(OrderServiceInterface::class, function ($app) {
            return new OrderService($app->make(CartServiceInterface::class));
        });
    }

    // ── Boot ───────────────────────────────────────────

    public function boot(): void
    {
        // Custom pagination template — used by ALL $paginator->links()
        Paginator::defaultView('vendor.pagination.tailwind');
        Paginator::defaultSimpleView('vendor.pagination.tailwind');

        // Register Blade components
        Blade::component('flash-message', FlashMessage::class);
        Blade::component('product-card', ProductCard::class);
        Blade::component('product-image', ProductImage::class);
        Blade::component('stock-badge', StockBadge::class);
        Blade::component('add-to-cart-button', AddToCartButton::class);
        Blade::component('badge', Badge::class);
        Blade::component('section-header', SectionHeader::class);
        Blade::component('admin-table-wrap', AdminTableWrap::class);

        // Share nav categories with all views
        try {
    View::share('navCategories', app(CategoryServiceInterface::class)->getNavCategories());
} catch (\Exception $e) {
    View::share('navCategories', collect());
}
    }
}
