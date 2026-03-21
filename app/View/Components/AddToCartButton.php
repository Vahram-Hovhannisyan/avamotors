<?php

namespace App\View\Components;

use App\Models\Product;
use Illuminate\View\Component;
use Illuminate\View\View;

class AddToCartButton extends Component
{
    public function __construct(
        public readonly Product $product,
        public readonly int     $quantity  = 1,
        public readonly string  $size      = 'sm',   // sm | md | lg
        public readonly string  $label     = 'В корзину',
        public readonly bool    $fullWidth  = false,
    ) {}

    public function render(): View
    {
        return view('components.add-to-cart-button');
    }
}
