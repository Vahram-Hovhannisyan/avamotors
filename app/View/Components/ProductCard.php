<?php

namespace App\View\Components;

use App\Models\Product;
use Illuminate\View\Component;
use Illuminate\View\View;

class ProductCard extends Component
{
    public function __construct(
        public readonly Product $product,
        public readonly bool    $showCategory = true,
        public readonly bool    $compact      = false,
    ) {}

    public function render(): View
    {
        return view('components.product-card');
    }
}
