<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class FlashMessage extends Component
{
    public function render(): View
    {
        return view('components.flash-message');
    }
}
