<?php

namespace App\View\Components;

use App\Models\Product;
use Illuminate\View\Component;
use Illuminate\View\View;

class StockBadge extends Component
{
    public readonly string $status;  // in | low | out
    public readonly string $label;

    public function __construct(public readonly Product $product)
    {
        if ($product->quantity > 5) {
            $this->status = 'in';
            $this->label  = "В наличии ({$product->quantity} шт.)";
        } elseif ($product->quantity > 0) {
            $this->status = 'low';
            $this->label  = "Осталось мало ({$product->quantity} шт.)";
        } else {
            $this->status = 'out';
            $this->label  = 'Нет в наличии';
        }
    }

    public function render(): View
    {
        return view('components.stock-badge');
    }
}
