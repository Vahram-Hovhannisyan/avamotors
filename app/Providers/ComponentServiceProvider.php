<?php

namespace App\Providers;

use App\View\Components\AddToCartButton;
use App\View\Components\AdminTableWrap;
use App\View\Components\Badge;
use App\View\Components\FlashMessage;
use App\View\Components\ProductCard;
use App\View\Components\ProductImage;
use App\View\Components\SectionHeader;
use App\View\Components\StockBadge;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class ComponentServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Blade::component('product-card',       ProductCard::class);
        Blade::component('product-image',      ProductImage::class);
        Blade::component('stock-badge',        StockBadge::class);
        Blade::component('add-to-cart-button', AddToCartButton::class);
        Blade::component('badge',              Badge::class);
        Blade::component('flash-message',      FlashMessage::class);
        Blade::component('section-header',     SectionHeader::class);
        Blade::component('admin-table-wrap',   AdminTableWrap::class);
    }
}
