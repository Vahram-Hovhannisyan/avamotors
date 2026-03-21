<?php

namespace App\View\Components;

use App\Models\Product;
use Illuminate\View\Component;
use Illuminate\View\View;

class ProductImage extends Component
{
    public readonly bool   $hasImage;
    public readonly string $src;

    public function __construct(
        public readonly Product $product,
        public readonly string  $size = 'md',  // sm | md | lg
    ) {
        $this->hasImage = $product->image
            && file_exists(public_path('storage/' . $product->image));

        $this->src = $this->hasImage
            ? asset('storage/' . $product->image)
            : '';
    }

    public function render(): View
    {
        return view('components.product-image');
    }
}
